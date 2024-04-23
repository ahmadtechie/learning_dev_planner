<?php

namespace App\Controllers\DevelopmentContracting;

use App\Controllers\BaseController;
use App\Helpers\EmailHelper;
use App\Models\DevelopmentContractingModel;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use CodeIgniter\HTTP\RedirectResponse;

helper(['form', 'url']);

class DevelopmentRatingController extends BaseController
{
    public array $data;
    public DevelopmentContractingModel $developmentContractingModel;
    public EmailTemplateModel $emailTemplateModel;
    public DevelopmentCycleModel $cycleModel;
    public EmployeeModel $employeeModel;
    public EmailHelper $emailHelper;
    public array $validation = [
        'cycle_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'Cycle must be selected',
            ]
        ],
    ];

    function __construct()
    {
        $this->employeeModel = model(EmployeeModel::class);
        $this->cycleModel = model(DevelopmentCycleModel::class);
        $this->emailTemplateModel = new EmailTemplateModel();
        $this->developmentContractingModel = model(DevelopmentContractingModel::class);
        $this->emailHelper = model(EmailHelper::class);
        $loggedInUserId = session()->get('loggedInUser');
        $loggedInUserFullName = session()->get('first_name') . " " . session()->get('last_name');
        $employee = $this->employeeModel->where('user_id', $loggedInUserId)->first();
        $competencies = $this->employeeModel->getCompetenciesForEmployeeJob($employee['id']);

        $this->data = [
            'title' => $loggedInUserFullName . " Development Rating | LD Planner",
            'employee' => $employee,
            'line_manager' => $this->employeeModel->find($employee['line_manager_id']),
            'competencies' => $competencies,
            'cycles' => $this->cycleModel->where('is_active', true)->findAll(),
            'page_name' => 'Self-Rating',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/self_rate', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        $employee_id = session()->get('loggedInEmployee');
        $employeeData = $this->employeeModel->getEmployeeDetailsWithUser($employee_id);
        $lineManagerData = $this->employeeModel->getEmployeeDetailsWithUser($employee_id);
        $this->data['my_ratings'] = $this->developmentContractingModel->where('employee_id', $employee_id)->findAll();
        $this->developmentContractingModel->where('employee_id', $employee_id)->findAll();
        $cycle_id = $this->request->getPost('cycle_id');
        $cycle = $this->cycleModel->find($cycle_id);

        $is_cycle_rated = $this->developmentContractingModel
                    ->where('cycle_id', $cycle['id'])
                    ->where('employee_id', $employee_id)
                    ->countAllResults();
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('auth/self_rate', array_merge($this->data, $validation)) .
                view('includes/footer');
        } elseif ($is_cycle_rated) {
            return redirect('ldm.rating.self')->withInput()->with('error', "You can only carry out development rating for " . $cycle['cycle_year'] . " cycle year once.");
        }

        for ($idx_competency = 1; $idx_competency <= $cycle['max_competencies']; $idx_competency++) {
            $this->developmentContractingModel->insert([
                'employee_id' => $employee_id,
                'competency_id' => $this->request->getPost("competency" . $idx_competency),
                'self_rating' => $this->request->getPost("rating" . $idx_competency),
                'cycle_id' => $cycle_id,
            ]);
        }

        // send email notification to the employee line-manager
        $emailData = $this->emailTemplateModel->where('email_type', 'validate_rating_notify')->first();
        $validation_url = url_to("ldm.rating.validate");

        $find = ['{line_manager_name}', '{employee_name}', '{cycle_year}', '{validation_url}',];
        $replace = [$lineManagerData['first_name'], $employeeData['first_name'] . " " . $employeeData['last_name'], $cycle['cycle_year'], $validation_url];
        $emailBody = str_replace($find, $replace, $emailData['email_body']);

        $subjectFind = ['{first_name} {last_name}'];
        $subjectReplace = [$employeeData['first_name'], $employeeData['last_name']];
        $emailSubject = str_replace($subjectFind, $subjectReplace, $emailData['email_subject']);

        $this->emailHelper->send_email($lineManagerData['email'], $emailData["email_from"], $emailData['email_from_name'], $emailSubject, $emailBody);
        return redirect('ldm.rating.self')->with('success', "You've successfully rated your competencies for the " . $cycle['cycle_year'] . " cycle year.");
    }

    public function validateRating(): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['page_name'] = 'Validate-Rating';
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/validate_ratings', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function updateLineManagerRating(): RedirectResponse
    {
        $line_manager_ratings = $this->request->getPost("line_manager_ratings");
        $competency_ids = $this->request->getPost("competency_ids");
        $employee_ids = $this->request->getPost("employee_ids");
        $active_cycle = $this->cycleModel->where('is_active', 1)->first();

        for ($i = 0; $i < count($competency_ids); $i++) {
            $competency_id = $competency_ids[$i];
            $line_manager_rating = $line_manager_ratings[$i];
            $employee_id = $employee_ids[$i];
            $this->developmentContractingModel->updateLineManagerRating($active_cycle['id'], $employee_id, $competency_id, $line_manager_rating);
        }
        return redirect('ldm.rating.validate')
            ->with('success', "You've successfully validated your employee ratings for the " .
                $active_cycle['cycle_year'] . " cycle year.");
    }
}

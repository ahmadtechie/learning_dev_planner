<?php

namespace App\Controllers\DevelopmentContracting;

use App\Controllers\BaseController;
use App\Models\DevelopmentContractingModel;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use App\Models\JobCompetencyModel;
use App\Models\SiteSettingsModel;

helper(['form', 'url']);

class DevelopmentRatingController extends BaseController
{
    public array $data;
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
        $employeeModel = model(EmployeeModel::class);
        $cycleModel = model(DevelopmentCycleModel::class);
        $loggedInUserId = session()->get('loggedInUser');
        $loggedInUserFullName = session()->get('first_name') . " " . session()->get('last_name');
        $employee = $employeeModel->where('user_id', $loggedInUserId)->first();
        $competencies = $employeeModel->getCompetenciesForEmployeeJob($employee['id']);

        $this->data = [
            'title' => $loggedInUserFullName . " Development Rating | LD Planner",
            'employee' => $employee,
            'line_manager' => $employeeModel->find($employee['line_manager_id']),
            'competencies' => $competencies,
            'cycles' => $cycleModel->where('is_active', true)->findAll(),
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
        $ratingModel = model(DevelopmentContractingModel::class);
        $employeeModel = model(EmployeeModel::class);
        $employee_id = session()->get('loggedInEmployee');
        $employeeData = $employeeModel->getEmployeeDetailsWithUser($employee_id);
        $lineManagerData = $employeeModel->getEmployeeDetailsWithUser($employee_id);
        $this->data['my_ratings'] = $ratingModel->where('employee_id', $employee_id)->findAll();
        $ratingModel->where('employee_id', $employee_id)->findAll();

        $cycle_id = $this->request->getPost('cycle_id');
        $cycleModel = model(DevelopmentCycleModel::class);
        $cycle = $cycleModel->find($cycle_id);

        $is_cycle_rated = $ratingModel
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
            $ratingModel->insert([
                'employee_id' => $employee_id,
                'competency_id' => $this->request->getPost("competency" . $idx_competency),
                'self_rating' => $this->request->getPost("rating" . $idx_competency),
                'cycle_id' => $cycle_id,
            ]);
        }

        // send email notification to the employee line-manager
        $emailTemplateModel = new EmailTemplateModel();
        $emailData = $emailTemplateModel->where('email_type', 'validate_rating_notify')->first();
        $validation_url = url_to("ldm.rating.validate");

        $find = ['{line_manager_name}', '{employee_name}', '{cycle_year}', '{validation_url}',];
        $replace = [$lineManagerData['first_name'], $employeeData['first_name'] . " " . $employeeData['last_name'], $cycle['cycle_year'], $validation_url];
        $emailBody = str_replace($find, $replace, $emailData['email_body']);

        $subjectFind = ['{first_name} {last_name}'];
        $subjectReplace = [$employeeData['first_name'], $employeeData['last_name']];
        $emailSubject = str_replace($subjectFind, $subjectReplace, $emailData['email_subject']);

        $email = \Config\Services::email();
        $email->setTo($lineManagerData['email']);
        $email->setFrom($emailData["email_from"], $emailData["email_from_name"]);
        $email->setSubject($emailSubject);
        $email->setMessage($emailBody);

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
    public function updateLineManagerRating(): \CodeIgniter\HTTP\RedirectResponse
    {
        $cycleModel = new DevelopmentCycleModel();
        $developmentContractModel = new DevelopmentContractingModel();
        $line_manager_ratings = $this->request->getPost("line_manager_ratings");
        $competency_ids = $this->request->getPost("competency_ids");
        $employee_ids = $this->request->getPost("employee_ids");
        $active_cycle = $cycleModel->where('is_active', 1)->first();

        for ($i = 0; $i < count($competency_ids); $i++) {
            $competency_id = $competency_ids[$i];
            $line_manager_rating = $line_manager_ratings[$i];
            $employee_id = $employee_ids[$i];
            $developmentContractModel->updateLineManagerRating($active_cycle['id'], $employee_id, $competency_id, $line_manager_rating);
        }
        return redirect('ldm.rating.validate')
            ->with('success', "You've successfully validated your employee ratings for the " .
                $active_cycle['cycle_year'] . " cycle year.");
    }
}

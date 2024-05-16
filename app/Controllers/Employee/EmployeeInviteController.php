<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Helpers\EmailHelper;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailLogModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use App\Models\SiteSettingsModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use Couchbase\User;

helper(['form', 'url']);


class EmployeeInviteController extends BaseController
{
    public array $data;
    public UserModel $userModel;
    public DevelopmentCycleModel $devCycleModel;
    public EmployeeModel $employeeModel;
    public EmailLogModel $emailLogsModel;
    public EmailTemplateModel $emailTemplateModel;
    public array $validation = [
        'employee_ids' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'At least one employee must be selected for invite.',
            ]
        ],
        'cycle_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'Cycle to send invite for is not selected.',
            ],
        ]
    ];

    function __construct() {
        $this->devCycleModel = model(DevelopmentCycleModel::class);
        $this->employeeModel = model(EmployeeModel::class);
        $this->emailLogsModel = model(EmailLogModel::class);
        $this->userModel = model(UserModel::class);
        $this->emailTemplateModel = model(EmailTemplateModel::class);

        $this->data = [
            'title' => 'Dev Cycle Invite | LD Planner',
            'page_name' => 'Dev Cycle Invite',
            'cycles' => array($this->devCycleModel->orderBy('created_at', 'DESC')->where('is_active', true)->first()),
            'employees' => $this->employeeModel->getAllEmployeesWithUserDetails(),
            'email_logs' => $this->emailLogsModel->where('type', 'cycle_invite')->findAll(),
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/employees_invite', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $employee_emails = $this->request->getPost('employee_emails');
        $cycle_id = $this->request->getPost('cycle_id');
        $cycleData = $this->devCycleModel->find($cycle_id);
        $selfRatingUrl = url_to('ldm.rating.self');

        $emailData = $this->emailTemplateModel->where('email_type', 'sef_rating_invite')->first();
        $find = ['{employee_name}', '{cycle_year}', '{self_rating_url}'];

        $emailHelper = new EmailHelper();
        foreach($employee_emails as $email) {
            $employeeUserData = $this->userModel->where('email', $email)->first();
            if (!$employeeUserData) {
                continue;
            }
            $replace = [$employeeUserData['first_name'], $cycleData['cycle_year'], $selfRatingUrl];
            $emailBody = str_replace($find, $replace, $emailData['email_body']);
            $emailSubjectFind = ['{first_name}', '{last_name}'];
            $emailSubjectReplace = [$employeeUserData['first_name'], $employeeUserData['last_name']];
            $emailSubject = str_replace($emailSubjectFind, $emailSubjectReplace, $emailData['email_subject']);
            $is_email_sent = $emailHelper->send_email($email, $emailData["email_from"], $emailData['email_from_name'], $emailSubject, $emailBody);

            if ($is_email_sent) {
                $this->emailLogsModel->insert(['email' => $email, 'type' => 'cycle_invite', 'status' => 'success']);
            } else {
                $this->emailLogsModel->insert(['email' => $email, 'type' => 'cycle_invite', 'status' => 'failed']);
            }
        }

        return redirect('ldm.employee.invite')->with('success', 'Email invites sent successfully.');
    }
}

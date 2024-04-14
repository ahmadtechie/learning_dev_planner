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
use Couchbase\User;

helper(['form', 'url']);


class EmployeeInviteController extends BaseController
{
    public array $data;
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
        $devCycleModel = model(DevelopmentCycleModel::class);
        $employeeModel = model(EmployeeModel::class);
        $emailLogsModel = model(EmailLogModel::class);

        $this->data = [
            'title' => 'Dev Cycle Invite | LD Planner',
            'page_name' => 'Dev Cycle Invite',
            'cycles' => array($devCycleModel->orderBy('created_at', 'DESC')->where('is_active', true)->first()),
            'employees' => $employeeModel->getAllEmployeesWithUserDetails(),
            'email_logs' => $emailLogsModel->where('type', 'cycle_invite')->findAll(),
        ];
    }

    public function index()
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/employees_invite', $this->data) .
            view('includes/footer');
    }

    public function create() {
        $devCycleModel = new DevelopmentCycleModel();
        $userModel = new UserModel();
        $emailLogModel = new EmailLogModel();
        $employee_emails = $this->request->getPost('employee_emails');
        $cycle_id = $this->request->getPost('cycle_id');
        $cycleData = $devCycleModel->find($cycle_id);
        $selfRatingUrl = url_to('ldm.rating.self');

        $emailTemplateModel = new EmailTemplateModel();
        $emailData = $emailTemplateModel->where('email_type', 'sef_rating_invite')->first();
        $find = ['{employee_name}', '{cycle_year}', '{self_rating_url}'];

        $emailHelper = new EmailHelper();
        foreach($employee_emails as $email) {
            $employeeUserData = $userModel->where('email', $email)->first();
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
                $emailLogModel->insert(['email' => $email, 'type' => 'cycle_invite', 'status' => 'success']);
            } else {
                $emailLogModel->insert(['email' => $email, 'type' => 'cycle_invite', 'status' => 'failed']);
            }
        }
        return redirect('ldm.employee.invite');
    }
}

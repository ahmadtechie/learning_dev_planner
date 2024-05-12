<?php

namespace App\Controllers\Trainer;

use App\Controllers\BaseController;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailLogModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use App\Models\LearningInterventionModel;
use App\Models\UserModel;

helper(['form', 'url']);

class ParticipantFeedbackController extends BaseController
{
    public array $data;
    public UserModel $userModel;
    public DevelopmentCycleModel $devCycleModel;
    public EmployeeModel $employeeModel;
    public LearningInterventionModel $learningInterventionModel;
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
        ],
        'intervention_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'Select Intervention to send invite for',
            ],
        ]
    ];

    function __construct() {
        $this->devCycleModel = model(DevelopmentCycleModel::class);
        $this->employeeModel = model(EmployeeModel::class);
        $this->learningInterventionModel = model(LearningInterventionModel::class);
        $this->emailLogsModel = model(EmailLogModel::class);
        $this->userModel = model(UserModel::class);
        $this->emailTemplateModel = model(EmailTemplateModel::class);

        $this->data = [
            'title' => 'Feedback Capturing Invite | LD Planner',
            'page_name' => 'Feedback Capturing Invite',
            'cycles' => array($this->devCycleModel->orderBy('created_at', 'DESC')->where('is_active', true)->first()),
            'employees' => $this->employeeModel->getAllEmployeesWithUserDetails(),
            'interventions' => $this->learningInterventionModel->orderBy('created_at', 'DESC')->findAll(),
            'email_logs' => $this->emailLogsModel->where('type', 'feedback_invite')->findAll(),
        ];
    }
    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/feedback_invite', $this->data) .
            view('includes/footer');
    }


    public function show($slug = null)
    {

    }

    public function new()
    {

    }

    public function create()
    {

    }

    public function edit($slug)
    {

    }

    public function update($slug)
    {

    }

    public function delete($slug)
    {

    }
}

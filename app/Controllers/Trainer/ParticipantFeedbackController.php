<?php

namespace App\Controllers\Trainer;

use App\Controllers\BaseController;
use App\Helpers\EmailHelper;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailLogModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use App\Models\LearningInterventionModel;
use App\Models\ParticipantFeedbackModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

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
    public ParticipantFeedbackModel $participantFeedbackModel;
    public array $validation = [
        'employee_emails' => [
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

    function __construct()
    {
        $this->devCycleModel = model(DevelopmentCycleModel::class);
        $this->employeeModel = model(EmployeeModel::class);
        $this->learningInterventionModel = model(LearningInterventionModel::class);
        $this->emailLogsModel = model(EmailLogModel::class);
        $this->userModel = model(UserModel::class);
        $this->emailTemplateModel = model(EmailTemplateModel::class);
        $this->participantFeedbackModel = model(ParticipantFeedbackModel::class);

        $this->data = [
            'title' => 'Feedback Capturing Invite | LD Planner',
            'page_name' => 'Feedback Capturing Invite',
            'cycles' => $this->devCycleModel->orderBy('created_at', 'DESC')->findAll(),
            'employees' => [],
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

    public function sendEmailInvite(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $employee_emails = $this->request->getPost('employee_emails');
        $cycle_id = $this->request->getPost('cycle_id');
        $intervention_id = $this->request->getPost('intervention_id');
        $interventionData = $this->learningInterventionModel->find($intervention_id);
        $feedbackFormUrl = url_to('ldm.feedback.form') . '?cycle_id=' . $cycle_id . '&intervention_id=' . $intervention_id;

        $emailData = $this->emailTemplateModel->where('email_type', 'feedback_invite')->first();
        $find = ['{participant_name}', '{intervention_name}', '{feedback_form_url}'];

        $emailHelper = new EmailHelper();
        foreach ($employee_emails as $email) {
            $employeeUserData = $this->userModel->where('email', $email)->first();
            if (!$employeeUserData) {
                continue;
            }
            $replace = [$employeeUserData['first_name'], $interventionData['intervention_name'], $feedbackFormUrl];
            $emailBody = str_replace($find, $replace, $emailData['email_body']);
            $emailSubject = $emailData['email_subject'];
            $is_email_sent = $emailHelper->send_email($email, $emailData["email_from"], $emailData['email_from_name'], $emailSubject, $emailBody);

            if ($is_email_sent) {
                $this->emailLogsModel->insert(['email' => $email, 'type' => 'feedback_invite', 'status' => 'success']);
            } else {
                $this->emailLogsModel->insert(['email' => $email, 'type' => 'feedback_invite', 'status' => 'failed']);
            }
        }

        return redirect('ldm.feedback.invite')->with('success', 'Email invites sent successfully');
    }

    public function feedbackForm(): string
    {
        $this->data['userData'] = $this->request->userData;
        $cycle_id = $this->request->getVar('cycle_id');
        $intervention_id = $this->request->getVar('intervention_id');
        $loggedInEmployeeId = session()->get('loggedInEmployee');
        $hasEmployeeSubmitFeedback = $this->participantFeedbackModel
            ->where('employee_id', $loggedInEmployeeId)
            ->where('cycle_id', $cycle_id)
            ->where('intervention_id', $intervention_id)
            ->countAllResults();
        $this->data['hasEmployeeSubmitFeedback'] = $hasEmployeeSubmitFeedback;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_feedback', $this->data) .
            view('includes/footer');
    }

    public function feedbackList(): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['feedbacks']  = $this->participantFeedbackModel->groupBy('intervention_id')->findAll();
        $this->data['page_name']  = 'Feedback Data';
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('tables/feedback_table', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function submitFeedback(): RedirectResponse
    {
        $cycle_id = $this->request->getVar('cycle_id');
        $intervention_id = $this->request->getVar('intervention_id');
        $validation = [
            'feedback_text' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The feedback message can not be blank',
                ]
            ],
        ];

        if (!$this->validate($validation)) {
            $validation = ['validation' => $this->validator];
            return redirect('ldm.feedback.form')->with('error', $validation);
        }
        $loggedInEmployeeId = session()->get('loggedInEmployee');
        $feedbackText = $this->request->getPost('feedback_text');
        $this->participantFeedbackModel->insert([
            'cycle_id' => $cycle_id,
            'intervention_id' => $intervention_id,
            'employee_id' => $loggedInEmployeeId,
            'feedback_text' => $feedbackText
        ]);
        return redirect('ldm.feedback.form')->with('success', 'Successful!. Thanks for the feedback.');
    }

    public function fetchEmployeesForFeedback()
    {
        $interventionId = $this->request->getVar('intervention_id');
        $cycleId = $this->request->getVar('cycle_id');
        $feedbackEmployees = $this->employeeModel->getEmployeeWithInterventionForFeedback($interventionId, $cycleId);

        $options = '';
        foreach ($feedbackEmployees as $feedbackEmployee) {
            $options .= '<option value="' . $feedbackEmployee['email'] . '">' . $feedbackEmployee['first_name'] . ' ' . $feedbackEmployee['last_name'] . ' [' . $feedbackEmployee['username'] . ']' . '</option>';
        }
        echo $options;
    }
}

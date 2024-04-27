<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Helpers\EmailHelper;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailLogModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeInterventionsModel;
use App\Models\EmployeeModel;
use App\Models\InterventionAttendanceModel;
use App\Models\InterventionClassModel;
use App\Models\LearningInterventionModel;
use App\Models\SiteSettingsModel;

helper(['form', 'url']);

class EmployeeInterventionMappingController extends BaseController
{
    public array $data;
    public EmployeeModel $employeeModel;
    public LearningInterventionModel $learningInterventionModel;
    public InterventionClassModel $interventionClassModel;
    public DevelopmentCycleModel $cycleModel;
    public EmployeeInterventionsModel $employeeInterventionsModel;
    public SiteSettingsModel $siteSettingsModel;
    public EmailTemplateModel $emailTemplateModel;
    public EmailHelper $emailHelper;
    public EmailLogModel $emailLogModel;
    public InterventionAttendanceModel $interventionAttendanceModel;


    public array $validation = [
        'employee_ids' => [
            'rules' => 'required',
            'errors' => [
                'integer' => 'Employees must be selected.',
            ],
        ],
        'intervention_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A mun intervention must be selected.',
            ],
        ],
    ];

    function __construct()
    {
        $this->employeeModel = model(EmployeeModel::class);
        $this->learningInterventionModel = model(LearningInterventionModel::class);
        $this->interventionClassModel = model(InterventionClassModel::class);
        $this->cycleModel = model(DevelopmentCycleModel::class);
        $this->employeeInterventionsModel = model(EmployeeInterventionsModel::class);
        $this->siteSettingsModel = model(SiteSettingsModel::class);
        $this->emailTemplateModel = model(EmailTemplateModel::class);
        $this->emailHelper = model(EmailHelper::class);
        $this->emailLogModel = model(EmailLogModel::class);
        $this->interventionAttendanceModel = model(InterventionAttendanceModel::class);

        $this->data = [
            'title' => 'Employee Intervention Mapping | LD Planner',
            'employees' => $this->employeeModel->getAllEmployeesWithUserDetails(),
            'active_cycles' => $this->cycleModel->orderBy('cycle_year', 'DESC')->where('is_active', true)->findAll(),
            'all_cycles' => $this->cycleModel->orderBy('cycle_year', 'DESC')->findAll(),
            'interventions' => $this->learningInterventionModel->orderBy('updated_at', 'DESC')->findAll(),
            'classes' => $this->interventionClassModel->orderBy('updated_at', 'DESC')->findAll(),
            'page_name' => 'Employee-Intervention Mapping',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/employee_intervention_mapping', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/employee_intervention_mapping', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $employeeIds = $this->request->getPost('employee_ids');
        $classIds = $this->request->getPost('class_ids');
        $intervention_id = $this->request->getPost('intervention_id');
        $cycle_id = $this->request->getPost('cycle_id');
        $cycleData = $this->cycleModel->find($cycle_id);
        $intervention = $this->learningInterventionModel->find($intervention_id);
        $trainer = $this->employeeModel->getEmployeeDetailsWithUser($intervention['trainer_id']);
        $classDetails = '';

        foreach ($classIds as $classId) {
            $classDetail = $this->interventionClassModel->find($classId);
            $classDetails .= "<div class=\"class-details\">
                                    <p><strong>Class Name:</strong> {$classDetail['class_name']}</p>
                                    <p><strong>Start Date:</strong> {$classDetail['start_date']}</p>
                                    <p><strong>End Date:</strong> {$classDetail['end_date']}</p>
                                    <p><strong>Venue:</strong> {$classDetail['venue']}</p>
                                </div>";
        }

        foreach ($employeeIds as $employeeId) {
            foreach ($classIds as $classId) {
                $this->employeeInterventionsModel->insert(['employee_id' => $employeeId, 'intervention_id' => $intervention_id, 'class_id' => $classId, 'cycle_id' => $cycle_id]);
            }

            $employeeData = $this->employeeModel->getEmployeeDetailsWithUser($employeeId);
            $siteName = $this->siteSettingsModel->first()["company_name"];
            $emailData = $this->emailTemplateModel->where('email_type', 'employee_intervention_invite')->first();
            $find = ['{employee_name}', '{intervention_name}', '{class_details}', '{site_name}', '{trainer}'];
            $replace = [
                $employeeData['first_name'] . ' ' . $employeeData['last_name'],
                $intervention['intervention_name'],
                $classDetails,
                $siteName,
                $trainer['first_name'] . ' ' . $trainer['last_name']
            ];
            $emailBody = str_replace($find, $replace, $emailData['email_body']);
            $emailSubject = str_replace(['{site_name}', '{cycle_year}'], [$siteName, $cycleData['cycle_year']], $emailData['email_subject']);
            $this->emailHelper->send_email($employeeData['email'], $emailData["email_from"], $emailData['email_from_name'], $emailSubject, $emailBody);
            $this->emailLogModel->insert(['email' => $employeeData['email'], 'status' => 'success', 'type' => 'employee_intervention_invite', 'intervention_id' => $intervention_id]);

            // initiate the attendance marking for each participant
            $this->interventionAttendanceModel->insert(['intervention_id' => $intervention_id, 'employee_id' => $employeeId, 'attendance_status' => 'absent']);
        }
        $this->sendLineManagerNotification($employeeIds, $intervention, $classDetails, $cycleData, $trainer);

        return redirect('ldm.intervention.map')->with('success', 'The selected employees have been mapped to the intervention.');
    }

    /**
     * @throws \ReflectionException
     */
    public function sendLineManagerNotification($employeeIds, $intervention, $classDetails, $cycleData, $trainer)
    {
        $employeeDataByLineManager = [];
        foreach ($employeeIds as $employeeId) {
            $lineManagerId = $this->employeeModel->find($employeeId)['line_manager_id'];
            if (!$lineManagerId) {
                continue;
            }
            if (!isset($employeeDataByLineManager[$lineManagerId])) {
                $employeeDataByLineManager[$lineManagerId] = [];
            }
            $employeeDataByLineManager[$lineManagerId][] = $this->employeeModel->getEmployeeDetailsWithUser($employeeId);
        }

        foreach ($employeeDataByLineManager as $lineManagerId => $employees) {
            $lineManagerData = $this->employeeModel->getEmployeeDetailsWithUser($lineManagerId);

            $directReportsList = '';
            foreach ($employees as $employee) {
                $directReportsList .= "<li>{$employee['first_name']} {$employee['last_name']}</li>";
            }

            $siteName = $this->siteSettingsModel->first()["company_name"];
            $emailData = $this->emailTemplateModel->where('email_type', 'line_manager_intervention_notification')->first();
            $find = ['{line_manager_name}', '{intervention_name}', '{class_details}', '{direct_reports}', '{site_name}', '{cycle_year}', '{trainer}'];
            $replace = [
                $lineManagerData['first_name'] . ' ' . $lineManagerData['last_name'],
                $intervention['intervention_name'],
                $classDetails,
                $directReportsList,
                $siteName,
                $cycleData['cycle_year'],
                $trainer['first_name'] . ' ' . $trainer['last_name']
            ];
            $emailBody = str_replace($find, $replace, $emailData['email_body']);
            $emailSubject = str_replace(['{site_name}', '{cycle_year}'], [$siteName, $cycleData['cycle_year']], $emailData['email_subject']);

            $this->emailHelper->send_email($lineManagerData['email'], $emailData["email_from"], $emailData['email_from_name'], $emailSubject, $emailBody);
            $this->emailLogModel->insert(['email' => $lineManagerData['email'], 'status' => 'success', 'type' => 'line_manager_intervention_notification']);
        }
    }


    public function fetchInterventions()
    {
        $cycleId = $this->request->getPost('cycle_id');
        $interventionsData = $this->learningInterventionModel->where('cycle_id', $cycleId)->orderBy('updated_at', 'DESC')->findAll();

        $options = '<option value="">Choose Intervention</option>';
        foreach ($interventionsData as $intervention) {
            $options .= '<option value="' . $intervention['id'] . '">' . $intervention['intervention_name'] . '</option>';
        }

        echo $options;
    }

    public function fetchClasses()
    {
        $interventionId = $this->request->getPost('intervention_id');
        $classesData = $this->interventionClassModel->where('intervention_id', $interventionId)->orderBy('updated_at', 'DESC')->findAll();
        $options = '';
        foreach ($classesData as $class) {
            $options .= '<option value="' . $class['id'] . '">' . $class['class_name'] . '</option>';
        }
        echo $options;
    }

    public function fetchEligibleEmployees()
    {
        $interventionId = $this->request->getPost('intervention_id');
        $cycleId = $this->request->getPost('cycle_id');
        $eligibleEmployees = $this->employeeInterventionsModel->getEmployeesWithoutIntervention($interventionId, $cycleId);

        $employeeIds = array_column($eligibleEmployees, 'id');
        $options = '';
        foreach ($employeeIds as $employeeId) {
            $employee = $this->employeeModel->getEmployeeDetailsWithUser($employeeId);
            if ($employee) {
                $options .= '<option value="' . $employee['employee_id'] . '">' . $employee['first_name'] . ' ' . $employee['last_name'] . ' [' . $employee['username'] . ']' . '</option>';
            }
        }
        echo $options;
    }
}

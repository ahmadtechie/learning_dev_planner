<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Models\DevelopmentCycleModel;
use App\Models\EmployeeInterventionsModel;
use App\Models\EmployeeModel;
use App\Models\InterventionClassModel;
use App\Models\LearningInterventionModel;

helper(['form', 'url']);

class EmployeeInterventionMappingController extends BaseController
{
    public array $data;
    public EmployeeModel $employeeModel;
    public LearningInterventionModel $learningInterventionModel;
    public InterventionClassModel $interventionClassModel;
    public DevelopmentCycleModel $cycleModel;
    public EmployeeInterventionsModel $employeeInterventionsModel;

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

        $this->data = [
            'title' => 'Employee Intervention Mapping | LD Planner',
            'employees' => $this->employeeModel->getAllEmployeesWithUserDetails(),
            'cycles' => $this->cycleModel->orderBy('created_at', 'DESC')->findAll(),
            'interventions' => $this->learningInterventionModel->orderBy('created_at', 'DESC')->findAll(),
            'classes' => $this->interventionClassModel->orderBy('created_at', 'DESC')->findAll(),
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
        $intervention_id = $this->request->getPost('intervention_id');

        foreach ($employeeIds as $employeeId) {
            $this->employeeInterventionsModel->insert(['employee_id' => $employeeId, 'intervention_id' => $intervention_id]);
        }
        return redirect('ldm.intervention.map')->with('success', 'The selected employees have been mapped to the intervention.');
    }

    public function fetchInterventions()
    {
        $cycleId = $this->request->getPost('cycle_id');
        $interventionsData = $this->learningInterventionModel->where('cycle_id', $cycleId)->findAll();

        $options = '<option value="">Choose Intervention</option>';
        foreach ($interventionsData as $intervention) {
            $options .= '<option value="' . $intervention['id'] . '">' . $intervention['intervention_name'] . '</option>';
        }

        echo $options;
    }

    public function fetchClasses()
    {
        $interventionId = $this->request->getPost('intervention_id');
        $classesData = $this->interventionClassModel->where('intervention_id', $interventionId)->findAll();
        $options = '';
        foreach ($classesData as $class) {
            $options .= '<option value="' . $class['id'] . '">' . $class['class_name'] . '</option>';
        }
        echo $options;
    }

    public function fetchEligibleEmployees($interventionId)
    {
//        $interventionId = $this->request->getPost('intervention_id');
        $eligibleEmployees = $this->employeeInterventionsModel->whereNotIn('intervention_id', [$interventionId])->findAll();
        $employeeIds = array_column($eligibleEmployees, 'employee_id');

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

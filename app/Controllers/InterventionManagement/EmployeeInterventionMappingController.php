<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Models\EmployeeInterventionsModel;
use App\Models\EmployeeModel;
use App\Models\LearningInterventionModel;

helper(['form', 'url']);

class EmployeeInterventionMappingController extends BaseController
{
    public array $data;
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
        $employeeModel = model(EmployeeModel::class);
        $learningInterventionModel = model(LearningInterventionModel::class);

        $this->data = [
            'title' => 'Employee Intervention Mapping | LD Planner',
            'employees' => $employeeModel->getAllEmployeesWithUserDetails(),
            'interventions' => $learningInterventionModel->orderBy('created_at', 'DESC')->findAll(),
            'page_name' => 'Employee-Intervention Mapping',
        ];
    }

    public function index()
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
        $model = model(EmployeeInterventionsModel::class);

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
            $model->insert(['employee_id' => $employeeId, 'intervention_id' => $intervention_id]);
        }
        return redirect('ldm.intervention.map')->with('success', 'The selected employees have been mapped to the intervention.');
    }
}

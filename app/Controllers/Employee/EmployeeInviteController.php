<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\DevelopmentCycleModel;
use App\Models\EmployeeModel;

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

        $this->data = [
            'title' => 'Dev Cycle Invite | LD Planner',
            'page_name' => 'Dev Cycle Invite',
            'cycles' => $devCycleModel->orderBy('created_at', 'DESC')->findAll(),
            'employees' => $employeeModel->getAllEmployeesWithUserDetails(),
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

    }
}

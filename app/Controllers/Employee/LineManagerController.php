<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\UserModel;

helper(['form', 'url']);

class LineManagerController extends BaseController
{
    public array $data;
    public array $validation = [
        'line_manager_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A line manager must be selected!',
            ]
        ],
        'employee_ids' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'At least one employee must be selected',
            ],
        ]
    ];

    function __construct()
    {
        $employeeModel = model(EmployeeModel::class);

        $this->data = [
            'title' => 'Line Manager Page | LD Planner',
            'employees' => $employeeModel->getUnAssignedEmployeeDetailsWithUser(),
            'line_managers' => $employeeModel->getAllLineManagers(),
            'page_name' => 'line managers',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/assign_line_managers', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        $employeeModel = model(EmployeeModel::class);
        $session = \Config\Services::session();

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/assign_line_managers', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $line_manager_id = $this->request->getPost('line_manager_id');
        $employeeIds = $this->request->getPost('employee_ids');

        foreach ($employeeIds as $employeeId) {
            if (!$employeeModel->update($employeeId, [
                'line_manager_id' => $line_manager_id,
            ])) {
                $session->setFlashdata('error', "Failed to update employee fields.");
                return redirect()->back()->withInput();
            }
        }

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Line manager assignment completed successfully.");

        return redirect('ldm.line.manager');
    }

    public function edit($line_manager_id): string
    {
        $this->data['userData'] = $this->request->userData;
        $employeeModel = model(EmployeeModel::class);
        $lineManagerEmployees = $employeeModel->getEmployeesUnderLineManager($line_manager_id);
        $unAssignedEmployees = $employeeModel->getUnAssignedEmployeeDetailsWithUser();
        $this->data['employees'] = array_merge($lineManagerEmployees, $unAssignedEmployees);
        $this->data['line_manager_employees'] = $lineManagerEmployees;
        $this->data['selected_line_manager'] = $employeeModel->getEmployeeDetailsWithUser($line_manager_id);
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/assign_line_managers', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $employeeModel = new EmployeeModel();
        $line_manager_id = $this->request->getPost('line_manager_id');
        $employee_ids = $this->request->getPost('employee_ids');

        foreach($employee_ids as $employee_id) {
            $employeeModel->update($employee_id, ['line_manager_id' => $line_manager_id]);
        }

        $lineManagerEmployees = $employeeModel->getEmployeesUnderLineManager($line_manager_id);
        foreach ($lineManagerEmployees as $lineManagerEmployee) {
            if (!in_array($lineManagerEmployee['employee_id'], $employee_ids)) {
                $employeeModel->update($lineManagerEmployee['employee_id'], ['line_manager_id' => null]);
            }
        }

      return redirect()->to(url_to('ldm.line.manager'))->with('success', 'The line manager surbodinates updated successfully');
    }
}

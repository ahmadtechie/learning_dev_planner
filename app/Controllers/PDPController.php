<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DevelopmentContractingModel;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use CodeIgniter\HTTP\ResponseInterface;

helper(['form', 'url']);

class PDPController extends BaseController
{
    public array $data;
    public DevelopmentContractingModel $developmentContractingModel;
    public DevelopmentCycleModel $cycleModel;
    public EmployeeModel $employeeModel;
    function __construct()
    {
        $this->employeeModel = model(EmployeeModel::class);
        $this->cycleModel = model(DevelopmentCycleModel::class);
        $this->developmentContractingModel = model(DevelopmentContractingModel::class);
        $loggedInUserId = session()->get('loggedInUser');
        $loggedInEmployeeId = session()->get('loggedInEmployee');
        $loggedInUserFullName = session()->get('first_name') . " " . session()->get('last_name');
        $employee = $this->employeeModel->where('user_id', $loggedInUserId)->first();
        $line_manager = $this->employeeModel->getEmployeeDetailsWithUser($employee['line_manager_id']);
        $active_cycle = $this->cycleModel->where('is_active', true)->first();
        $employee_ratings = $this->developmentContractingModel
            ->where('employee_id', $loggedInEmployeeId)
            ->where('cycle_id', $active_cycle['id'])
            ->orderBy('updated_at', 'ASC')
            ->findAll();
        $this->data = [
            'title' => 'Personal Development Plan | LD Planner',
            'employee' => $employee,
            'line_manager' => $line_manager,
            'employee_ratings' => $employee_ratings,
            'active_cycle' => $active_cycle,
            'all_cycles' => $this->cycleModel->orderBy('updated_at', 'DESC')->findAll(),
            'loggedInUserFullName' => $loggedInUserFullName,
            'page_name' => 'Personal Development Plan',
        ];
    }

    public function index()
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/pdp', $this->data) .
            view('includes/footer');
    }
}

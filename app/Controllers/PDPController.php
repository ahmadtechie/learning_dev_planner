<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DevelopmentContractingModel;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use App\Models\PDPModel;
use CodeIgniter\HTTP\ResponseInterface;

helper(['form', 'url']);

class PDPController extends BaseController
{
    public array $data;
    public DevelopmentContractingModel $developmentContractingModel;
    public DevelopmentCycleModel $cycleModel;
    public EmployeeModel $employeeModel;
    public PDPModel $pdpModel;
    public array $employeeRatings;
    public array $activeCycle;
    function __construct()
    {
        $this->employeeModel = model(EmployeeModel::class);
        $this->cycleModel = model(DevelopmentCycleModel::class);
        $this->pdpModel = model(PDPModel::class);
        $this->developmentContractingModel = model(DevelopmentContractingModel::class);
        $loggedInEmployeeId = session()->get('loggedInEmployee');
        $loggedInUserFullName = session()->get('first_name') . " " . session()->get('last_name');
        $employee = $this->employeeModel->find($loggedInEmployeeId);
        $line_manager = $this->employeeModel->getEmployeeDetailsWithUser($employee['line_manager_id']);
        $this->activeCycle = $this->cycleModel->where('is_active', true)->first();
        $this->employeeRatings = $this->developmentContractingModel
            ->where('employee_id', $loggedInEmployeeId)
            ->where('cycle_id', $this->activeCycle['id'])
            ->orderBy('updated_at', 'ASC')
            ->findAll();
        $myPlans = $this->pdpModel->where('employee_id', $employee['id'])->orderBy('updated_at', 'DESC')->findAll();
        $this->data = [
            'title' => 'Personal Development Plan | LD Planner',
            'employee' => $employee,
            'line_manager' => $line_manager,
            'employee_ratings' => $this->employeeRatings,
            'pdpOwnerEmployeeId' => $loggedInEmployeeId,
            'active_cycle' => $this->activeCycle,
            'all_cycles' => $this->cycleModel->orderBy('updated_at', 'DESC')->findAll(),
            'loggedInUserFullName' => $loggedInUserFullName,
            'myPlans' => $myPlans,
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

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        $employee_id = session()->get('loggedInEmployee');
        $is_top_competencies_captured = $this->pdpModel->where('employee_id', $employee_id)->where('cycle_id', $this->activeCycle['id'])->countAllResults();
        if ($is_top_competencies_captured > 0) {
            for ($ratingCount = 0; $ratingCount < count($this->employeeRatings); $ratingCount++) {
                $this->pdpModel->insert([
                    'employee_id' => $employee_id,
                    'cycle_id' => $this->activeCycle['id'],
                    'competency_id' => $this->request->getPost('competency'.$ratingCount),
                    'average_rating' => $_POST['average_rating' . $ratingCount],
                ]);
            }
            return redirect('ldm.dashboard.pdp')->with('success', "Top \"n\" competencies for {$this->activeCycle['cycle_year']} captured successfully." );
        }
        return redirect()->back()->with('error', "Top 'n' competencies already captured for this cycle year");
    }
}



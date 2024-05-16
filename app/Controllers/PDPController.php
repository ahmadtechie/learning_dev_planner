<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnnualDevelopmentPlanModel;
use App\Models\DepartmentModel;
use App\Models\DevelopmentContractingModel;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use App\Models\GroupModel;
use App\Models\JobModel;
use App\Models\PDPModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

helper(['form', 'url']);

class PDPController extends BaseController
{
    public array $data;
    public DevelopmentContractingModel $developmentContractingModel;
    public DevelopmentCycleModel $cycleModel;
    public EmployeeModel $employeeModel;
    public AnnualDevelopmentPlanModel $ADPModel;
    public GroupModel $groupModel;
    public DepartmentModel $departmentModel;
    public PDPModel $pdpModel;
    public JobModel $jobModel;
    public array $employeeRatings;
    public array $activeCycle;
    public array $employee;

    function __construct()
    {
        $this->employeeModel = model(EmployeeModel::class);
        $this->cycleModel = model(DevelopmentCycleModel::class);
        $this->pdpModel = model(PDPModel::class);
        $this->developmentContractingModel = model(DevelopmentContractingModel::class);
        $this->jobModel = model(JobModel::class);
        $this->ADPModel = model(AnnualDevelopmentPlanModel::class);
        $this->groupModel = model(GroupModel::class);
        $this->departmentModel = model(DepartmentModel::class);
        $loggedInEmployeeId = session()->get('loggedInEmployee');
        $loggedInUserFullName = session()->get('first_name') . " " . session()->get('last_name');
        $this->employee = $this->employeeModel->getEmployeeDetailsWithUser($loggedInEmployeeId);
        $my_job = $this->jobModel->find($this->employee['job_id']);
        $this->activeCycle = $this->cycleModel->where('is_active', true)->first();
        $this->employeeRatings = $this->developmentContractingModel
            ->where('employee_id', $loggedInEmployeeId)
            ->where('cycle_id', $this->activeCycle['id'])
            ->orderBy('updated_at', 'ASC')
            ->findAll();
        $myPlans = $this->pdpModel->where('employee_id', $loggedInEmployeeId)->orderBy('updated_at', 'DESC')->findAll();
        $activeCycleSelectedCompetencies = $this->pdpModel->where('cycle_id', $this->activeCycle['id'])->where('employee_id', $this->employee['employee_id'])->findAll();
        $employeesWithPDPs = $this->pdpModel->getUniqueEmployeeIds();
        $isEmployeeSignedOff = $this->pdpModel->where('employee_id', $this->employee['employee_id'])->where('cycle_id', $this->activeCycle['id'])->where('employee_signed_off', true)->countAllResults();
        $isLineManagerSignedOff = $this->pdpModel->where('employee_id', $this->employee['employee_id'])->where('cycle_id', $this->activeCycle['id'])->where('line_manager_signed_off', true)->countAllResults();
        $this->data = [
            'title' => 'Personal Development Plan | LD Planner',
            'employee' => $this->employee,
            'my_job' => $my_job,
            'employeesWithPDPs' => $employeesWithPDPs,
            'employee_ratings' => $this->employeeRatings,
            'pdpOwnerEmployeeId' => $loggedInEmployeeId,
            'isEmployeeSignedOff' => $isEmployeeSignedOff,
            'isLineManagerSignedOff' => $isLineManagerSignedOff,
            'active_cycle' => $this->activeCycle,
            'all_cycles' => $this->cycleModel->orderBy('updated_at', 'DESC')->findAll(),
            'loggedInUserFullName' => $loggedInUserFullName,
            'activeCycleSelectedCompetencies' => $activeCycleSelectedCompetencies,
            'myPlans' => $myPlans,
            'page_name' => 'Personal Development Plan',
        ];
    }

    public function index(): string
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
        $n_competencies = $this->activeCycle['max_competencies'];

        $isTopCompetenciesCaptured = $this->pdpModel
            ->where('employee_id', $employee_id)
            ->where('cycle_id', $this->activeCycle['id'])
            ->countAllResults();

        if ($isTopCompetenciesCaptured === 0) {
            for ($ratingCount = 0; $ratingCount < count($this->employeeRatings); $ratingCount++) {
                $competency_id = $this->request->getPost('competency' . $ratingCount);
                if ($competency_id) {
                    $this->pdpModel->insert([
                        'employee_id' => $employee_id,
                        'cycle_id' => $this->activeCycle['id'],
                        'competency_id' => $competency_id,
                        'average_rating' => $_POST['average_rating' . $ratingCount],
                    ]);
                }
            }
            return redirect('ldm.dashboard.pdp')->with('success', "Top {$n_competencies} competencies for {$this->activeCycle['cycle_year']} captured successfully.");
        }
        return redirect()->back()->with('error', "Top {$n_competencies} competencies already captured for {$this->activeCycle['cycle_year']} cycle year");
    }

    /**
     * @throws \ReflectionException
     */
    public function signoff($cycle_id): RedirectResponse
    {
        $employee_id = session()->get('loggedInEmployee');
        $employee_signed_off = $this->request->getPost('employee_signed_off') ? 1 : 0;
        $recordsToUpdate = $this->pdpModel
            ->where('cycle_id', $cycle_id)
            ->where('employee_id', $employee_id);
        $recordsToUpdate->set([
                'employee_signed_off' => $employee_signed_off,
            ])
            ->update();

        // consolidate the PDP into ADP
        $cycleApprovedCompetencies = $this->pdpModel
            ->where('cycle_id', $cycle_id)
            ->where('employee_id', $employee_id)
            ->where('employee_signed_off', 1)
            ->findAll();
        $employee = $this->employeeModel->find($employee_id);
        foreach ($cycleApprovedCompetencies as $cycleApprovedCompetency) {
            $this->ADPModel->insert([
                'employee_id' => $employee_id,
                'cycle_id' => $cycleApprovedCompetency['cycle_id'],
                'competency_id' => $cycleApprovedCompetency['competency_id'],
                'job_id' => $employee['job_id'],
                'line_manager_id' => $cycleApprovedCompetency['line_manager_id']
            ]);
        }

        if ($recordsToUpdate->countAllResults() > 0) {
            return redirect()->back()->with('success', 'Sign-off status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update sign-off status.');
        }
    }

    public function getPlans()
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['page_name'] = 'Direct Reports PDPs';
        $this->data['title'] = 'Personal Development Plan Module | LD Planner';
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_pdps', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function createPlans()
    {
        $loggedInEmployeeID = session()->get('loggedInEmployee');
        $lineManagerEmployees = $this->employeeModel->getEmployeesUnderLineManager($loggedInEmployeeID);
        $n_competencies = $this->activeCycle['max_competencies'];

        foreach ($lineManagerEmployees as $lineManagerEmployee) {
            $employee_id = $lineManagerEmployee['employee_id'];

            $isTopCompetenciesCaptured = $this->pdpModel
                ->where('employee_id', $employee_id)
                ->where('cycle_id', $this->activeCycle['id'])
                ->countAllResults();

            if ($isTopCompetenciesCaptured === 0) {
                $employeeRatings = $this->developmentContractingModel
                    ->where('employee_id', $employee_id)
                    ->where('cycle_id', $this->activeCycle['id'])
                    ->orderBy('updated_at', 'ASC')
                    ->findAll();
                for ($ratingCount = 0; $ratingCount < count($employeeRatings); $ratingCount++) {
                    $competency_id = $this->request->getPost('competency_' . $employee_id . '_' . $ratingCount);
                    if ($competency_id) {
                        $this->pdpModel->insert([
                            'employee_id' => $employee_id,
                            'line_manager_id' => $loggedInEmployeeID,
                            'cycle_id' => $this->activeCycle['id'],
                            'competency_id' => $competency_id,
                            'average_rating' => $_POST['average_rating' . $ratingCount],
                            'line_manager_signed_off' => 1,
                        ]);
                    }
                }
            }
        }

        return redirect('ldm.rating.pdp')->with('success', "Top {$n_competencies} competencies for {$this->activeCycle['cycle_year']} captured successfully.");
    }
}



<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DevelopmentContractingModel;
use App\Models\DevelopmentCycleModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
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
        $myPlans = $this->pdpModel->where('employee_id', $loggedInEmployeeId)->orderBy('updated_at', 'DESC')->findAll();
        $activeCycleSelectedCompetencies = $this->pdpModel->where('cycle_id', $this->activeCycle['id'])->where('employee_id', $employee['id'])->findAll();
        $this->data = [
            'title' => 'Personal Development Plan | LD Planner',
            'employee' => $employee,
            'line_manager' => $line_manager,
            'employee_ratings' => $this->employeeRatings,
            'pdpOwnerEmployeeId' => $loggedInEmployeeId,
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

        $line_manager_signed_off = $this->request->getPost('line_manager_signed_off') ? 1 : 0;

        $affectedRows = $this->pdpModel
            ->where('cycle_id', $cycle_id)
            ->where('employee_id', $employee_id)
            ->set([
                'employee_signed_off' => $employee_signed_off,
                'line_manager_signed_off' => $line_manager_signed_off,
            ])
            ->update();

        if ($affectedRows > 0) {
            return redirect()->back()->with('success', 'Sign-off status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update sign-off status.');
        }
    }

    public function getPlans()
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['page_name'] = 'Direct Reports PDPs';
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
    public function createPlans() {
        $employee_id = session()->get('loggedInEmployee');
        $lineManagerEmployees = $this->employeeModel->getEmployeesUnderLineManager($employee_id);
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
            }
        }

        return redirect('ldm.rating.pdp')->with('success', "Top {$n_competencies} competencies for {$this->activeCycle['cycle_year']} captured successfully.");
    }
}



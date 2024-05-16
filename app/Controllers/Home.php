<?php

namespace App\Controllers;

use App\Models\AnnualDevelopmentPlanModel;
use App\Models\CompetencyModel;
use App\Models\DepartmentModel;
use App\Models\DevelopmentContractingModel;
use App\Models\DevelopmentCycleModel;
use App\Models\DivisionModel;
use App\Models\EmployeeInterventionsModel;
use App\Models\EmployeeModel;
use App\Models\GroupModel;
use App\Models\JobCompetencyModel;
use App\Models\JobModel;
use App\Models\PDPModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Home extends BaseController
{
    public function index(): string
    {
        $employeeModel = model(EmployeeModel::class);
        $cycleModel = model(DevelopmentCycleModel::class);
        $pdpModel = model(PDPModel::class);
        $jobModel = model(JobModel::class);
        $groupModel = model(GroupModel::class);
        $departmentModel = model(DepartmentModel::class);
        $jobCompetencyModel = model(JobCompetencyModel::class);
        $employeeInterventionsModel = model(EmployeeInterventionsModel::class);
        $competencyModel = model(CompetencyModel::class);
        $userModel = model(UserModel::class);
        $divisionModel = model(DivisionModel::class);
        $unitModel = model(UnitModel::class);
        $developmentCycleModel = model(DevelopmentCycleModel::class);
        $activeCycle = $cycleModel->where('is_active', true)->first();

        $loggedInEmployeeId = session()->get('loggedInEmployee');
        $employee = $employeeModel->getEmployeeDetailsWithUser($loggedInEmployeeId);
        $user_job = $jobModel->find($employee['job_id']);
        $user_department = $departmentModel->where('id', $employee['department_id'])->first();
        $user_unit = $unitModel->where('id', $employee['unit_id'])->first();
        $user_line_manager = $employeeModel->getEmployeeDetailsWithUser($employee['line_manager_id']);
        $user_completed_cycles = $pdpModel->completedCyclesCount($loggedInEmployeeId);
        $user_total_job_competencies = $jobCompetencyModel->where('job_id', $employee['job_id'])->countAllResults();
        $user_total_interventions = $employeeInterventionsModel->where('employee_id', $employee['employee_id'])->countAllResults();
        $total_competencies = $competencyModel->countAllResults();
        $total_users = $userModel->countAllResults();
        $total_divisions = $divisionModel->countAllResults();
        $total_groups = $groupModel->countAllResults();
        $total_departments = $departmentModel->countAllResults();
        $total_units = $unitModel->countAllResults();
        $total_line_managers = count($employeeModel->getAllLineManagers());
        $total_development_cycles = $developmentCycleModel->countAllResults();
        $total_active_cycle_completed_ratings = $pdpModel->activeCycleCompletedRatingsCount($activeCycle['id']);

        $data = [
            'title' => 'Dashboard | LD Planner',
            'user_job' => $user_job,
            'employee' => $employee,
            'user_department' => $user_department,
            'user_unit' => $user_unit,
            'user_line_manager' => $user_line_manager,
            'user_completed_cycles' => $user_completed_cycles,
            'user_total_job_competencies' => $user_total_job_competencies,
            'user_total_assigned_interventions' => $user_total_interventions,
            'total_competencies' => $total_competencies,
            'total_users' => $total_users,
            'total_divisions' => $total_divisions,
            'total_groups' => $total_groups,
            'total_departments' => $total_departments,
            'total_units' => $total_units,
            'total_line_managers' => $total_line_managers,
            'total_development_cycles' => $total_development_cycles,
            'total_active_cycle_completed_ratings' => $total_active_cycle_completed_ratings,
        ];
        $data['userData'] = $this->request->userData;
        return view('includes/head', $data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $data) .
            view('includes/dashboard', $data) .
            view('includes/footer');
    }

    public function accessDenied(): string
    {
        $data = [
            'title' => 'Access Denied | LD Planner',
        ];
        $data['userData'] = $this->request->userData;
        return view('includes/head', $data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/403') .
            view('includes/footer');
    }
}

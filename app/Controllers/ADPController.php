<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnnualDevelopmentPlanModel;
use App\Models\CompetencyModel;
use App\Models\DepartmentModel;
use App\Models\DevelopmentContractingModel;
use App\Models\DevelopmentCycleModel;
use App\Models\DivisionModel;
use App\Models\EmployeeModel;
use App\Models\GroupModel;
use App\Models\JobCompetencyModel;
use App\Models\JobModel;
use App\Models\PDPModel;
use App\Models\UnitModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use http\Client\Curl\User;

helper(['form', 'url']);

class ADPController extends BaseController
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
    public CompetencyModel $competencyModel;
    public UnitModel $unitModel;
    public DivisionModel $divisionModel;
    public JobCompetencyModel $jobCompetencyModel;
    public UserModel $userModel;
    public array $activeCycle;
    public array $employees;
    public array $jobs;
    public array $line_managers;

    function __construct()
    {
        $this->employeeModel = model(EmployeeModel::class);
        $this->cycleModel = model(DevelopmentCycleModel::class);
        $this->pdpModel = model(PDPModel::class);
        $this->developmentContractingModel = model(DevelopmentContractingModel::class);
        $this->jobModel = model(JobModel::class);
        $this->ADPModel = model(AnnualDevelopmentPlanModel::class);
        $this->groupModel = model(GroupModel::class);
        $this->competencyModel = model(CompetencyModel::class);
        $this->unitModel = model(UnitModel::class);
        $this->departmentModel = model(DepartmentModel::class);
        $this->divisionModel = model(DivisionModel::class);
        $this->jobCompetencyModel = model(JobCompetencyModel::class);
        $this->userModel = model(UserModel::class);
        $this->jobs = $this->jobModel->findAll();
        $this->employees = $this->employeeModel->getAllActiveEmployeesWithUserDetails();
        $this->activeCycle = $this->cycleModel->where('is_active', true)->first();
        $this->line_managers = $this->employeeModel->getAllLineManagers();

        $this->data = [
            'title' => 'Annual Development Plan | LD Planner',
            'employees' => $this->employees,
            'line_managers' => $this->line_managers,
            'jobs' => $this->jobs,
            'units' => $this->unitModel->orderBy('unit_name')->findAll(),
            'departments' => $this->departmentModel->orderBy('department_name')->findAll(),
            'groups' => $this->groupModel->orderBy('group_name')->findAll(),
            'divisions' => $this->divisionModel->orderBy('division_name')->findAll(),
            'all_competencies' => $this->competencyModel->findAll(),
            'active_cycle' => $this->activeCycle,
            'all_cycles' => $this->cycleModel->orderBy('updated_at', 'DESC')->findAll(),
            'page_name' => 'Annual Development Plan: (Year ' . $this->activeCycle['cycle_year'] . ')',
        ];
    }

    public function index(): string
    {
        $competency_id = $this->request->getVar('competency');
        $line_manager_id = $this->request->getVar('line_manager');
        $employee_id = $this->request->getVar('employee');
        $division_id = $this->request->getVar('division');
        $group_id = $this->request->getVar('group');
        $department_id = $this->request->getVar('department');
        $unit_id = $this->request->getVar('unit');
        $this->data['userData'] = $this->request->userData;


        if ($competency_id) {
            $competencyData = $this->competencyModel->find($competency_id);
            $employeesWithCompetencyNeed = $this->ADPModel->where('competency_id', $competency_id)->where('cycle_id', $this->activeCycle['id'])->findAll();
            $employeeIds = array_column($employeesWithCompetencyNeed, 'employee_id');

            $employeesDetails = [];
            foreach ($employeeIds as $employeeId) {
                $employeesDetails[] = $this->employeeModel->getEmployeeDetailsWithUser($employeeId);
            }
            $this->data['table_type'] = 'employee_table';
            $this->data['title'] = "Employees with {$competencyData['competency_name']} Competency Need";
            $this->data['employeesWithCompetency'] = $employeesDetails;
        }

        if ($employee_id) {
            $employeeData = $this->employeeModel->getEmployeeDetailsWithUser($employee_id);
            $employeeCompetencyIDsForActiveCycle = $this->ADPModel
                ->where('employee_id', $employee_id)
                ->where('cycle_id', $this->activeCycle['id'])
                ->groupBy('competency_id')
                ->findAll();
            $competency_ids = array_column($employeeCompetencyIDsForActiveCycle, 'competency_id');

            $competencies = [];
            foreach ($competency_ids as $competency_id) {
                $competency = $this->competencyModel->find($competency_id);
                if ($competency) {
                    $competencies[] = $competency;
                }
            }
            $this->data['table_type'] = 'competency_table';
            $this->data['thisEmployee'] = $employeeData;
            $this->data['title'] = "Competency Needs for {$employeeData['first_name']} {$employeeData['last_name']}";
            $this->data['competencies'] = $competencies;
        }

        if ($line_manager_id) {
            $lineManagerData = $this->employeeModel->getEmployeeDetailsWithUser($line_manager_id);
            $lineManagerEmployeeCompetencyNeeds = $this->ADPModel->where('line_manager_id', $line_manager_id)->groupBy('competency_id')->findAll();
            $competency_ids = array_column($lineManagerEmployeeCompetencyNeeds, 'competency_id');
            $competencies = [];
            foreach ($competency_ids as $competency_id) {
                $competency = $this->competencyModel->find($competency_id);
                if ($competency) {
                    $competencies[] = $competency;
                }
            }
            $this->data['table_type'] = 'competency_table';
            $this->data['thisLineManager'] = $lineManagerData;
            $this->data['title'] = "Competency Needs of {$lineManagerData['first_name']} {$lineManagerData['last_name']} Direct Reports";
            $this->data['competencies'] = $competencies;
        }

        if ($unit_id) {
            $unit = $this->unitModel->find($unit_id);

            if ($unit) {
                $allEmployeesInUnit = $this->employeeModel->where('unit_id', $unit_id)->groupBy('job_id')->findAll();

                if ($allEmployeesInUnit) {
                    $uniqueJobIDs = array_column($allEmployeesInUnit, 'job_id');

                    if (!empty($uniqueJobIDs)) {
                        $jobsCompetencies = $this->jobCompetencyModel->whereIn('job_id', $uniqueJobIDs)->groupBy('competency_id')->findAll();
                        $competency_ids = array_column($jobsCompetencies, 'competency_id');
                        $competencies = [];

                        foreach ($competency_ids as $competency_id) {
                            $competency = $this->competencyModel->find($competency_id);
                            if ($competency) {
                                $competencies[] = $competency;
                            }
                        }

                        $this->data['table_type'] = 'competency_table';
                        $this->data['thisUnit'] = $unit;
                        $this->data['title'] = "Competency Needs of Employees in Unit: {$unit['unit_name']}";
                        $this->data['competencies'] = $competencies;
                        $this->data['uniqueJobIDs'] = $uniqueJobIDs;
                    }
                }
            }
        }

        if ($department_id) {
            $department = $this->departmentModel->find($department_id);

            if ($department) {
                $allEmployeesInDepartment = $this->employeeModel->where('department_id', $department_id)->groupBy('job_id')->findAll();

                if ($allEmployeesInDepartment) {
                    $uniqueJobIDs = array_column($allEmployeesInDepartment, 'job_id');

                    if (!empty($uniqueJobIDs)) {
                        $jobsCompetencies = $this->jobCompetencyModel->whereIn('job_id', $uniqueJobIDs)->groupBy('competency_id')->findAll();
                        $competency_ids = array_column($jobsCompetencies, 'competency_id');
                        $competencies = [];

                        foreach ($competency_ids as $competency_id) {
                            $competency = $this->competencyModel->find($competency_id);

                            // Check if competency exists
                            if ($competency) {
                                $competencies[] = $competency;
                            }
                        }

                        $this->data['table_type'] = 'competency_table';
                        $this->data['thisDepartment'] = $department;
                        $this->data['title'] = "Competency Needs of Employees in Department: {$department['department_name']}";
                        $this->data['competencies'] = $competencies;
                    }
                }
            }
        }



        if ($group_id) {
            $groupDepartments = $this->departmentModel->where('group_id', $group_id)->findAll();
            if ($groupDepartments) {
                $departmentIds = array_column($groupDepartments, 'id');
                if (!empty($departmentIds)) {
                    $allEmployeesInDepartments = $this->employeeModel->whereIn('department_id', $departmentIds)->findAll();
                    $uniqueJobIDs = array_unique(array_column($allEmployeesInDepartments, 'job_id'));

                    if (!empty($uniqueJobIDs)) {
                        $jobsCompetencies = $this->jobCompetencyModel->whereIn('job_id', $uniqueJobIDs)->findAll();
                        $competencyIds = array_unique(array_column($jobsCompetencies, 'competency_id'));
                        $competencies = $this->competencyModel->whereIn('id', $competencyIds)->findAll();

                        $this->data['table_type'] = 'competency_table';
                        $this->data['thisGroup'] = $this->groupModel->find($group_id);
                        $this->data['title'] = "Competency Needs of Employees in Group: {$this->data['thisGroup']['group_name']}";
                        $this->data['competencies'] = $competencies;
                    }
                }
            }
        }

        if ($division_id) {
            $division = $this->divisionModel->find($division_id);
            $divisionGroups = $this->groupModel->where('division_id', $division_id)->findAll();

            if ($divisionGroups) {
                $groupIds = array_column($divisionGroups, 'id');

                // Retrieve all departments belonging to the division's groups
                $groupDepartments = $this->departmentModel->whereIn('group_id', $groupIds)->findAll();

                if ($groupDepartments) {
                    $departmentIds = array_column($groupDepartments, 'id');

                    if (!empty($departmentIds)) {
                        // Fetch all employees within these departments
                        $allEmployeesInDepartments = $this->employeeModel->whereIn('department_id', $departmentIds)->findAll();
                        $uniqueJobIDs = array_unique(array_column($allEmployeesInDepartments, 'job_id'));

                        if (!empty($uniqueJobIDs)) {
                            // Fetch job competencies associated with these unique job IDs
                            $jobsCompetencies = $this->jobCompetencyModel->whereIn('job_id', $uniqueJobIDs)->findAll();
                            $competencyIds = array_unique(array_column($jobsCompetencies, 'competency_id'));

                            // Retrieve competency details for each competency ID
                            $competencies = $this->competencyModel->whereIn('id', $competencyIds)->findAll();

                            // Pass the competency details to the view for display
                            $this->data['table_type'] = 'competency_table';
                            $this->data['thisDivision'] = $division;
                            $this->data['title'] = "Competency Needs of Employees in Division: {$division['division_name']}";
                            $this->data['competencies'] = $competencies;
                        }
                    }
                }
            }
        }


        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/adp', $this->data) .
            view('includes/footer');
    }
}

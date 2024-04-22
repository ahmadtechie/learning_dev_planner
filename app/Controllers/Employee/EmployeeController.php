<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Helpers\EmailHelper;
use App\Models\DepartmentModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use App\Models\EmployeeRolesModel;
use App\Models\JobModel;
use App\Models\SiteSettingsModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use ReflectionException;

helper(['form']);

class EmployeeController extends BaseController
{
    public array $data;
    use ResponseTrait;

    public EmployeeModel $employeeModel;
    public UserModel $userModel;
    public UserRoleModel $userRoleModel;
    public EmployeeRolesModel $employeeRolesModel;
    public DepartmentModel $departmentModel;
    public UnitModel $unitModel;
    public JobModel $jobModel;
    public EmailTemplateModel $emailTemplateModel;
    public SiteSettingsModel $siteSettingsModel;
    public EmailHelper $emailHelper;

    public int $employee_role_id;
    public array $validation = [
        'email' => [
            'rules' => 'required|valid_email|is_unique[user.email]',
            'errors' => [
                'required' => 'Email must be provided',
                'valid_email' => 'A valid email is required.',
                'is_unique' => 'A user with this email already registered'
            ]
        ],
        'first_name' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'First Name is required!',
                'min_length' => 'First Name must be at least 3 characters.'
            ],
        ],
        'last_name' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Last Name is required!',
                'min_length' => 'Last Name must be at least 3 characters.'
            ],
        ],
        'job_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A job must be selected!',
            ],
        ],
    ];

    function __construct()
    {
        $this->employeeModel = model(EmployeeModel::class);
        $this->userRoleModel = model(UserRoleModel::class);
        $this->employeeRolesModel = model(EmployeeRolesModel::class);
        $this->departmentModel = model(DepartmentModel::class);
        $this->unitModel = model(UnitModel::class);
        $this->jobModel = model(JobModel::class);
        $this->userModel = model(UserModel::class);
        $this->emailTemplateModel = new EmailTemplateModel();
        $this->siteSettingsModel = new SiteSettingsModel();
        $this->emailHelper = new EmailHelper();

        $jobs = $this->jobModel->orderBy('job_title')->findAll();
        $this->employee_role_id = $this->userRoleModel->where('name', 'Employee')->first()['id'];

        $this->data = [
            'title' => 'Employee Page | LD Planner',
            'employees' => $this->employeeModel->getAllEmployeesWithUserDetails(),
            'roles' => $this->userRoleModel->findAll(),
            'line_managers' => $this->employeeRolesModel->getAllLineManagersWithUser(),
            'jobs' => $jobs,
            'page_name' => 'employees',
            'departments' => $this->departmentModel->findAll(),
            'units' => $this->unitModel->findAll(),
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('auth/register_employee', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        $password = $this->userModel->generateRandomPassword();
        $username = $this->userModel->generateUniqueRandomUsername();
        $login_url = url_to('ldm.login');

        $roles = [];

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('auth/register_employee', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $user_email = $this->request->getPost('email');
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $job_id = $this->request->getPost('job_id');
        $role_ids = $this->request->getPost('role_ids');
        $line_manager_id = $this->request->getPost('line_manager_id');

        $userId = $this->userModel->insert([
            'username' => $username,
            'email' => $user_email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        $employeeId = $this->employeeModel->insert([
            'user_id' => $userId,
            'job_id' => $job_id,
            'line_manager_id' => $line_manager_id,
        ]);

        foreach ($role_ids as $role_id) {
            $roles[] = $this->userRoleModel->find($role_id)['name'];
            $this->employeeRolesModel->insert([
                'user_id' => $userId,
                'role_id' => $role_id,
                'employee_id' => $employeeId,
            ]);
        }
        $siteName = $this->siteSettingsModel->first()["company_name"];
        $emailData = $this->emailTemplateModel->where('email_type', 'staff_created')->first();
        $userRoles = implode(', ', $roles);
        $find = ['{first_name}', '{username}', '{user_roles}', '{email}', '{password}', '{login_url}'];
        $replace = [$firstName, $username, $userRoles, $user_email, $password, $login_url];
        $emailBody = str_replace($find, $replace, $emailData['email_body']);
        $emailSubject = str_replace('{siteName}', $siteName, $emailData['email_subject']);


        $email = $this->emailHelper->send_email($user_email, $emailData["email_from"], $emailData['email_from_name'], $emailSubject, $emailBody);

        if ($email) {
            return redirect()->to(url_to('ldm.employee'))->with('success', "Email sent to new user $firstName successfully.");
        }
        return redirect()->to(url_to('ldm.employee'))->with('error', "Email failed!")->withInput();
    }

    public function edit($employeeId): string
    {
        $this->data['userData'] = $this->request->userData;
        $employee = $this->employeeModel->getEmployeeDetailsWithUser($employeeId);
        $this->data['employee'] = $employee;
        $this->data['selected_roles'] = $this->employeeModel->where('employee_id', $employeeId)->findAll();

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('auth/register_employee', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws ReflectionException
     */
    public function update($employeeId)
    {
        $this->data['userData'] = $this->request->userData;
        $this->validation['email']['rules'] = 'required|min_length[3]';

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('auth/register_employee', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $employeeData = $this->employeeModel->find($employeeId);
        $userId = $employeeData['user_id'];
        $roleIds = $this->request->getPost('role_ids');

        if (!$this->employeeRolesModel->updateRoles($employeeId, $userId, $roleIds)) {
            return redirect()->back()->with('error', "Failed to update user roles.");
        }

        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name')
        ];
        if (!$this->userModel->update($userId, $userData)) {
            return redirect()->back()->with('error', "Failed to update user fields.")->withInput();
        }

        $employeeData = [
            'job_id' => $this->request->getPost('job_id'),
            'line_manager_id' => $this->request->getPost('line_manager_id')
        ];
        if (!$this->employeeModel->update($employeeId, $employeeData)) {
            return redirect()->back()->with('error', "Failed to update employee fields.")->withInput();
        }
        return redirect('ldm.employee')->with('success', "Staff data updated successfully!");
    }


    public function delete()
    {
        $this->data['userData'] = $this->request->userData;
        $employeeId = $this->request->getVar('employee_id');
        $employeeData = $this->employeeModel->find($employeeId);
        if (!$employeeData) {
            return redirect()->back()->with('error', "Employee not found!");
        }

        $userId = $employeeData['user_id'];
        if (!$this->employeeRolesModel->deleteRoles($employeeId)) {
            return redirect()->back()->with('error', "Failed to delete user roles.");
        }

        if (!$this->userModel->delete($userId)) {
            return redirect()->back()->with('error', "Failed to delete user.");
        }

        if (!$this->employeeModel->delete($employeeId)) {
            return redirect()->back()->with('error', "Failed to delete employee.");
        }
        return redirect('ldm.employee')->with('success', "Staff data deactivated successfully!");
    }

    /**
     * @throws ReflectionException
     */
    public function activate($employeeId)
    {
        $this->data['userData'] = $this->request->userData;
        $employeeData = $this->employeeModel->withDeleted()->find($employeeId);
        if (!$employeeData) {
            return redirect()->back()->with('error', "Employee not found!");
        }
        $userId = $employeeData['user_id'];
        if (!$this->employeeModel->withDeleted()->restoreEmployee($employeeId)) {
            return redirect()->back()->with('error', "Failed to activate employee.");
        }
        if (!$this->userModel->withDeleted()->restoreUser($userId)) {
            return redirect()->back()->with('error', "Failed to activate user.");
        }
        return redirect('ldm.employee')->with('success', "Employee activated successfully!");
    }

    public function getEmployeeLineManager(): ResponseInterface
    {
        $lineManagerId = $this->request->getPost('line_manager_id');
        $employeeLineManagerId = $this->employeeModel->find($lineManagerId)['line_manager_id'];
        return $this->response->setJSON(['subordinate_line_manager_id' => $employeeLineManagerId]);
    }

    public function map(): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['page_name'] = 'Employee-Org Mapping';

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/employee_dept_mapping', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws ReflectionException
     */
    public function createMapping()
    {
        $this->data['userData'] = $this->request->userData;
        $employeeIds = $this->request->getPost('employee_ids');
        $department_id = $this->request->getPost('department_id');
        $unit_id = $this->request->getPost('unit_id');

        $validation = [
            'employee_ids' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'At least one employee must be selected',
                ]
            ],
            'department_id' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Department must be selected.',
                    'min_length' => 'First Name must be at least 3 characters.'
                ],
            ],
        ];

        if (!$this->validate($validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('auth/employee_dept_mapping', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        foreach ($employeeIds as $employeeId) {
            $this->employeeModel->update($employeeId, ['department_id' => $department_id, 'unit_id' => $unit_id]);
        }
        return redirect('ldm.map.org.create')->with('success', 'Employees mapped to respective dept/unit successfully');
    }
}

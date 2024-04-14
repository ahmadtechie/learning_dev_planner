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
use Config\Email;
use ReflectionException;

helper(['form']);

class EmployeeController extends BaseController
{
    public array $data;
    use ResponseTrait;

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

    public function generateRandomPassword($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    public function generateRandomUsername(): string
    {
        $randomNumber = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        return 'LD' . $randomNumber;
    }

    function __construct()
    {
        $employeeModel = model(EmployeeModel::class);
        $userRoleModel = model(UserRoleModel::class);
        $employeeRolesModel = model(EmployeeRolesModel::class);
        $departmentModel = new DepartmentModel();
        $unitModel = new UnitModel();

        $jobModel = model(JobModel::class);
        $jobs = $jobModel->orderBy('job_title')->findAll();
        $this->employee_role_id = $userRoleModel->where('name', 'Employee')->first()['id'];

        $this->data = [
            'title' => 'Employee Page | LD Planner',
            'employees' => $employeeModel->getAllEmployeesWithUserDetails(),
            'roles' => $userRoleModel->findAll(),
            'line_managers' => $employeeRolesModel->getAllLineManagersWithUser(),
            'jobs' => $jobs,
            'page_name' => 'employees',
            'departments' => $departmentModel->findAll(),
            'units' => $unitModel->findAll(),
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

        $userModel = new UserModel();
        $employeeModel = new EmployeeModel();
        $employeeRoleModel = new EmployeeRolesModel();
        $userRoleModel = new UserRoleModel();
        $password = $this->generateRandomPassword();
        $username = $this->generateRandomUsername();
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

        $userId = $userModel->insert([
            'username' => $username,
            'email' => $user_email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        $employeeId = $employeeModel->insert([
            'user_id' => $userId,
            'job_id' => $job_id,
            'line_manager_id' => $line_manager_id,
        ]);

        // create employee role(s)
        foreach ($role_ids as $role_id) {
            $roles[] = $userRoleModel->find($role_id)['name'];
            $employeeRoleModel->insert([
                'user_id' => $userId,
                'role_id' => $role_id,
                'employee_id' => $employeeId,
            ]);
        }

        $emailTemplateModel = new EmailTemplateModel();
        $siteSettingsModel = new SiteSettingsModel();
        $siteName = $siteSettingsModel->first()["company_name"];
        $emailData = $emailTemplateModel->where('email_type', 'staff_created')->first();
        $userRoles = implode(', ', $roles);
        $find = ['{first_name}', '{username}', '{user_roles}', '{email}', '{password}', '{login_url}'];
        $replace = [$firstName, $username, $userRoles, $user_email, $password, $login_url];
        $emailBody = str_replace($find, $replace, $emailData['email_body']);
        $emailSubject = str_replace('{siteName}', $siteName, $emailData['email_subject']);

        $emailHelper = new EmailHelper();
        $email = $emailHelper->send_email($user_email, $emailData["email_from"], $emailData['email_from_name'], $emailSubject, $emailBody);

        $session = \Config\Services::session();
        if ($email) {
            $session->setFlashdata('success', "Email sent to new user $firstName successfully.");
            return redirect()->to(url_to('ldm.employee'));
        }
        $session->setFlashdata('error', "Email failed!");
        return redirect()->to(url_to('ldm.employee'))->withInput();
    }

    public function edit($employeeId)
    {
        $this->data['userData'] = $this->request->userData;

        $model = new EmployeeModel();
        $employeeRoleModel = new EmployeeRolesModel();
        $employee = $model->getEmployeeDetailsWithUser($employeeId);
        $this->data['employee'] = $employee;
        $this->data['selected_roles'] = $employeeRoleModel->where('employee_id', $employeeId)->findAll();

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
        $session = \Config\Services::session();

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('auth/register_employee', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        // Fetch user ID
        $employeeModel = new EmployeeModel();
        $employeeData = $employeeModel->find($employeeId);
        $userId = $employeeData['user_id'];

        $roleIds = $this->request->getPost('role_ids');

        // Update employee roles
        $empRoleModel = new EmployeeRolesModel();
        if (!$empRoleModel->updateRoles($employeeId, $userId, $roleIds)) {
            $session->setFlashdata('error', "Failed to update user roles.");
        }

        // Update user data
        $userModel = new UserModel();
        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name')
        ];
        if (!$userModel->update($userId, $userData)) {
            $session->setFlashdata('error', "Failed to update user fields.");
            return redirect()->back()->withInput();
        }

        // Update employee data
        $employeeData = [
            'job_id' => $this->request->getPost('job_id'),
            'line_manager_id' => $this->request->getPost('line_manager_id')
        ];
        if (!$employeeModel->update($employeeId, $employeeData)) {
            $session->setFlashdata('error', "Failed to update employee fields.");
            return redirect()->back()->withInput();
        }

        // Success message
        $session->setFlashdata('success', "Staff data updated successfully!");
        return redirect('ldm.employee');
    }


    public function delete($employeeId)
    {
        $this->data['userData'] = $this->request->userData;

        $session = \Config\Services::session();

        // Fetch user ID
        $employeeModel = new EmployeeModel();
        $employeeData = $employeeModel->find($employeeId);
        if (!$employeeData) {
            $session->setFlashdata('error', "Employee not found!");
            return redirect()->back();
        }
        $userId = $employeeData['user_id'];

        // Delete employee roles
        $empRoleModel = new EmployeeRolesModel();
        if (!$empRoleModel->deleteRoles($employeeId)) {
            $session->setFlashdata('error', "Failed to delete user roles.");
        }

        // Delete user data
        $userModel = new UserModel();
        if (!$userModel->delete($userId)) {
            $session->setFlashdata('error', "Failed to delete user.");
            return redirect()->back();
        }

        // Delete employee data
        if (!$employeeModel->delete($employeeId)) {
            $session->setFlashdata('error', "Failed to delete employee.");
            return redirect()->back();
        }

        // Success message
        $session->setFlashdata('success', "Staff data deactivated successfully!");
        return redirect('ldm.employee');
    }

    /**
     * @throws ReflectionException
     */
    public function activate($employeeId)
    {
        $this->data['userData'] = $this->request->userData;

        $session = \Config\Services::session();

        // Fetch user ID
        $employeeModel = new EmployeeModel();
        $employeeData = $employeeModel->withDeleted()->find($employeeId); // Include soft-deleted records
        if (!$employeeData) {
            $session->setFlashdata('error', "Employee not found!");
            return redirect()->back();
        }
        $userId = $employeeData['user_id'];

        // Restore employee data
        if (!$employeeModel->withDeleted()->restoreEmployee($employeeId)) {
            $session->setFlashdata('error', "Failed to activate employee.");
            return redirect()->back();
        }

        // Restore user data
        $userModel = new UserModel();
        if (!$userModel->withDeleted()->restoreUser($userId)) {
            $session->setFlashdata('error', "Failed to activate user.");
            return redirect()->back();
        }

        // Success message
        $session->setFlashdata('success', "Employee activated successfully!");
        return redirect('ldm.employee');
    }

    public function getEmployeeLineManager(): \CodeIgniter\HTTP\ResponseInterface
    {
        $lineManagerId = $this->request->getPost('line_manager_id');

        $employeeModel = new EmployeeModel();
        $employeeLineManagerId = $employeeModel->find($lineManagerId)['line_manager_id'];
        return $this->response->setJSON(['subordinate_line_manager_id' => $employeeLineManagerId]);
    }

    public function map()
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
        $employeeIds = $this->request->getPost('employee_ids');
        $department_id = $this->request->getPost('department_id');
        $unit_id = $this->request->getPost('unit_id');

        $this->data['userData'] = $this->request->userData;

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

        $session = \Config\Services::session();

        if (!$this->validate($validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('auth/employee_dept_mapping', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        // Fetch user ID
        $employeeModel = new EmployeeModel();

        try {
            foreach ($employeeIds as $employeeId) {
                $employeeModel->update($employeeId, ['department_id' => $department_id, 'unit_id' => $unit_id]);
            }

            return redirect('ldm.map.org.create')->with('success', 'Employees mapped to respective dept/unit successfully');
        } catch (\Exception $e) {
            if ($e->getCode() == 1062) {
                $validation = ['validation' =>$this->validator];
                $session->setFlashdata('error', "Failed to map employees.");
                return view('includes/head') .
                    view('includes/navbar') .
                    view('includes/sidebar') .
                    view('includes/mini_navbar', $this->data) .
                    view('forms/employee_dept_mapping', array_merge($this->data, $validation)) .
                    view('includes/footer');
            } else {
                throw $e;
            }
        }
    }
}

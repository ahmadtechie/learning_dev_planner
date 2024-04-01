<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Helpers\EmailHelper;
use App\Models\EmployeeModel;
use App\Models\EmployeeRolesModel;
use App\Models\JobModel;
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

    public function generateRandomPassword($length = 8) {
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

        // Retrieve form data
        $user_email = $this->request->getPost('email');
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $job_id = $this->request->getPost('job_id');
        $role_ids = $this->request->getPost('role_ids');
        $line_manager_id = $this->request->getPost('line_manager_id');

        // Create a user account for the employee
        $userId = $userModel->insert([
            'username' => $username,
            'email' => $user_email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        // Create an employee record
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

        $emailHelper = new EmailHelper();
        $subject = 'Welcome to Learning and Development Planner App';
        $user_roles = implode(',', $roles);
        $message = $emailHelper->welcomeMessage($username, $password, $user_email, $login_url, $user_roles);
        $from = 'aas1800216.com@buk.edu.ng';

        $email = \Config\Services::email();
        $email->setTo($user_email);
        $email->setFrom($from, 'Ahmad Sharafudeen');
        $email->setSubject($subject);
        $email->setMessage($message);

        $session = \Config\Services::session();
        if($email->send()) {
            $session->setFlashdata('success', "Email sent to new user $firstName successfully.");
            return redirect()->to(url_to('ldm.employee'));
        }
        $session->setFlashdata('error', "Email failed!");
        echo $email->printDebugger();
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

    public function getEmployeeLineManager()
    {
        $lineManagerId = $this->request->getPost('line_manager_id');

        $employeeModel = new EmployeeModel();
        $employeeLineManagerId = $employeeModel->find($lineManagerId)['line_manager_id'];
        return $this->response->setJSON(['subordinate_line_manager_id' => $employeeLineManagerId]);
    }

    public function map($id)
    {

    }
}

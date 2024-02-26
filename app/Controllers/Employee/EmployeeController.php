<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\EmployeeRolesModel;
use App\Models\JobModel;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use ReflectionException;

helper(['form']);

class EmployeeController extends BaseController
{
    public array $data;
    public int $employee_role_id;
    public array $validation = [
        'email' => [
            'rules' => 'required|valid_email|validateUserUnique[user.email]',
            'errors' => [
                'required' => 'Email must be provided',
                'valid_email' => 'A valid email is required.',
                'validateUserUnique' => 'A user with this email already registered'
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
        $employeeModel = model(EmployeeModel::class);
        $userRoleModel = model(UserRoleModel::class);
        $employeeRolesModel = model(EmployeeRolesModel::class);

        $jobModel = model(JobModel::class);
        $jobs = $jobModel->orderBy('job_title')->findAll();
        $this->employee_role_id = $userRoleModel->where('name', 'Employee')->first()['id'];

        $this->data = [
            'title' => 'Department Page | LD Planner',
            'employees' => $employeeModel->getAllEmployeesWithUserDetails(),
            'roles' => $userRoleModel->findAll(),
            'line_managers' => $employeeRolesModel->getAllLineManagersWithUser(),
            'jobs' => $jobs,
            'page_name' => 'employees',
        ];
    }

    public function index(): string
    {

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/register_employee', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws ReflectionException
     */
    public function create()
    {
        $userModel = new UserModel();
        $employeeModel = new EmployeeModel();
        $employeeRoleModel = new EmployeeRolesModel();

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/register_employee', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        // Retrieve form data
        $email = $this->request->getPost('email');
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $job_id = $this->request->getPost('job_id');
        $role_ids = $this->request->getPost('role_ids');
        // $line_manager_id = $this->request->getPost('line_manager_id');

        // Create a user account for the employee
        $userId = $userModel->insert([
            'username' => strstr($email, '@', true),
            'email' => $email,
            'password' => password_hash('LIM@1000', PASSWORD_DEFAULT),
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        // Create an employee record
        $employeeId =  $employeeModel->insert([
            'user_id' => $userId,
            'job_id' => $job_id,
            // 'line_manager_id' => $line_manager_id,
        ]);

        // create employee role(s)
        foreach ($role_ids as $role_id) {
            $employeeRoleModel->insert([
                'user_id' => $userId,
                'role_id' => $role_id,
                'employee_id' => $employeeId,
            ]);
        }

        // Email the employee with login credentials
        $email = \Config\Services::email();

        $email->setFrom('aas1800216.com@buk.edu.ng', 'Ahmad Sharafudeen');
        $email->setTo('ahmad.sharafudeenlim@gmail.com');

        $email->setSubject('Welcome to LD Planner');
        $email->setMessage('Testing the email class.');

        $email->send();

        // Redirect to a success page or the employee list page
        return redirect()->to(url_to('ldm.employee'))->with('success', 'Employee registered successfully.');
    }

    public function edit($slug)
    {

    }

    public function update($slug)
    {

    }

    public function delete($slug)
    {

    }
}

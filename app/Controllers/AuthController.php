<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\EmployeeRolesModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

helper('form');

class AuthController extends Controller
{
    public array $data;
    public UserModel $userModel;
    function __construct()
    {
        $this->data = [];
        $this->userModel = model(UserModel::class);
    }

    public function index(): string
    {
        return view('auth/login');
    }

    public function login()
    {
        $validated = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email must be provided',
                    'valid_email' => 'A valid email is required.',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required'
                ]
            ]
        ]);

        if (!$validated) {
            return view('auth/login', ['validation' => $this->validator]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $employeeModel = new EmployeeModel();
        $employeeRoleModel = new EmployeeRolesModel();
        $userInfo = $userModel->where('email', $email)->first();
        if ($userInfo) {
            $employeeInfo = $employeeModel->where('user_id', $userInfo['id'])->first();
            $employeeRoles = $employeeRoleModel->getEmployeeRoleIds($employeeInfo['id']);
            $checkPassword = password_verify($password, $userInfo['password']);
            if (!$checkPassword) {
                session()->setFlashdata('fail', 'Incorrect password provided');
                return redirect()->to(url_to('ldm.login.auth'))->with('error', 'Incorrect email or password provided');
            }
            session()->set('loggedInUser', $userInfo['id']);
            session()->set('loggedInEmployee', $employeeInfo['id']);
            session()->set('first_name', $userInfo['first_name']);
            session()->set('last_name', $userInfo['last_name']);
            session()->set('employeeRoles', $employeeRoles);

            $redirect_url = session()->get('redirect_url');
            if (!empty($redirect_url)) {
                return redirect()->to($redirect_url);
            }
            return redirect()->to(url_to('ldm.home'));

        }
        return redirect()->to(url_to('ldm.login.auth'))->with('error', 'Incorrect email or password provided');
    }

    public function forgotPassword(): string
    {
        return view('auth/forgot_password');
    }

    /**
     * @throws \Exception
     */
    public function handleForgotPassword()
    {
        $rules = [
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) return redirect()->back()->withInput()->with('error', $this->validator->getErrors());

        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) return redirect()->back()->withInput()->with('error', 'Email address not found.');

        $token = bin2hex(random_bytes(32));

        // Save the token in the database along with the user's email and a timestamp
        $passwordResetModel = new \App\Models\PasswordResetModel();
        $passwordResetModel->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Send an email to the user with a link to reset the password
        $resetLink = site_url('reset-password?token=' . $token);
        $emailSubject = 'Password Reset Link';
        $emailBody = 'Click the following link to reset your password: ' . $resetLink;

        // You can use your preferred email sending library or helper function here
        // For example, using CodeIgniter's Email class:
        $email = \Config\Services::email();
        $email->setTo($user['email']);
        $email->setSubject($emailSubject);
        $email->setMessage($emailBody);
        $email->send();

        // Redirect the user with a success message
        return redirect()->to('login')->with('success', 'Password reset link sent to your email.');
    }

    public function logout(): RedirectResponse
    {
        if (session()->has('loggedInUser')) {
            session()->set('redirect_url', previous_url());
            session()->remove('loggedInUser');
        }
        return redirect()->to(url_to('ldm.login.auth'))->with('error', "You are logged out");
    }

    public function getChangePassword(): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['title'] = 'Change Password';
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('auth/change_password', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function handleChangePassword()
    {
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[new_password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'There\'s a password mismatch. Confirm your password again');
        }

        $userId = session()->get('loggedInUser');
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $user = $this->userModel->find($userId);

        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Current password is incorrect.');
        }
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->userModel->update($userId, ['password' => $hashedPassword]);
        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}

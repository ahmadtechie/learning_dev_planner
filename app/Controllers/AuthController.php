<?php

namespace App\Controllers;

use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use App\Models\EmployeeRolesModel;
use App\Models\PasswordResetModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Helpers\EmailHelper;

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
        $passwordResetModel = new PasswordResetModel();
        $passwordResetModel->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Send an email to the user with a link to reset the password
        $resetLink = url_to('ldm.password.new') . '?token=' . $token;
        $emailTemplateModel = model(EmailTemplateModel::class);

        $emailData = $emailTemplateModel->where('email_type', 'forgot_password')->first();
        $find = ['{user_name}', '{password_reset_link}'];
        $replace = [$user['first_name'], $resetLink];
        $emailBody = str_replace($find, $replace, $emailData['email_body']);
        $emailSubject = $emailData['email_subject'];
        $emailHelper = new EmailHelper();
        $email = $emailHelper->send_email($email, $emailData["email_from"], $emailData['email_from_name'], $emailSubject, $emailBody);
        if ($email) {
            return redirect()->to(url_to('ldm.forgot.password'))->with('success', "Password reset link sent to your email.");
        } else {
            return redirect()->to(url_to('ldm.employee'))->with('error', "Email failed!")->withInput();
        }
    }

    public function resetPassword(): RedirectResponse
    {
        $token = $this->request->getVar('token');

        $passwordResetModel = model(PasswordResetModel::class);

        $expirationTime = strtotime('+15 minutes');
        $passwordResetData = $passwordResetModel->where('token', $token)->first();

        if (time() > strtotime($passwordResetData['created_at']) + $expirationTime) {
            return redirect()->to(url_to('ldm.forgot.password'))->with('error', 'Token expired.');
        }

        if ($passwordResetData == null) {
            return redirect()->to(url_to('ldm.forgot.password'))->with('error', 'Invalid or expired token.');
        }

        $rules = [
            'password' => [
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 8 characters long.',
                    'max_length' => 'Password cannot exceed 255 characters.'
                ]
            ],
            'password_confirm' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'The password confirmation does not match the password.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();

            if (isset($errors['password'])) {
                return redirect()->to(url_to('ldm.password.new') . '?token=' . $token)->with('error', $errors['password']);
            } elseif (isset($errors['password_confirm'])) {
                return redirect()->to(url_to('ldm.password.new') . '?token=' . $token)->with('error', $errors['password_confirm']);
            } else {
                return redirect()->to(url_to('ldm.password.new') . '?token=' . $token)->with('error', 'Validation error. Please try again.');
            }
        }

        $newPassword = $this->request->getPost('password');
        $userModel = new UserModel();
        $user = $userModel->where('email', $passwordResetData['email'])->first();

        $userModel->update($user['id'], ['password' => password_hash($newPassword, PASSWORD_DEFAULT)]);
        $passwordResetModel->delete($passwordResetData['id']);

        return redirect()->to(url_to('ldm.login'))->with('success', 'Password reset successfully. You can now log in with your new password.');
    }

    public function logout(): RedirectResponse
    {
        if (session()->has('loggedInUser')) {
            session()->set('redirect_url', previous_url());
            session()->remove('loggedInUser');
        }
        return redirect()->to(url_to('ldm.login.auth'))->with('error', "You are logged out");
    }

    public function passwordChangeForm(): string
    {
        return view('auth/change_password', $this->data);

    }

    public function getPasswordSubmitForm(): string
    {
        return view('auth/password_change', $this->data);
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

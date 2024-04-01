<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\EmployeeRolesModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

helper('form');

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
//        validating user input
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

        // checking user details in the DB
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        echo $email;
        echo $password;

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
            session()->set('employeeRoles', $employeeRoles);

            return redirect()->to('/');
        } else {
            return redirect()->to(url_to('ldm.login.auth'))->with('error', 'Incorrect email or password provided');
        }
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function handleForgotPassword()
    {

    }

    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (session()->has('loggedInUser')) {
            session()->remove('loggedInUser');
        }
        return redirect()->to(url_to('ldm.login.auth') . "?access=loggedOut")->with('error', "You are logged out");
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserRoleModel;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'LD Planner | LIM',
        ];

        $data['userData'] = $this->request->userData;

        if (isset($data['userData']['learningDevRoleId']) and in_array($data['userData']['learningDevRoleId'], session()->get('employeeRoles'))):
            return view('includes/head', $data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar') .
                view('forms/adp') .
                view('includes/footer');
        else:
            return view('includes/head', $data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar') .
                view('forms/adp') .
                view('includes/footer');
        endif;
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

    public function showEmailContent($emailBody)
    {
        // Load the view and pass the email body content as a variable
        return view('display_email', ['emailBody' => $emailBody]);
    }
}

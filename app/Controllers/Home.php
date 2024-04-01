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

        return view('includes/head', $data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar') .
            view('includes/dashboard') .
            view('includes/footer');
    }

}

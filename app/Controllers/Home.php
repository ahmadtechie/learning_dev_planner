<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'LD Planner | LIM'
        ];
        return view('includes/head', $data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar') .
            view('includes/dashboard') .
            view('includes/footer');
    }

}

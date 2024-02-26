<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LineManagerController extends BaseController
{
    public array $data;
    function __construct() {
        $userModel = model(UserModel::class);
        $users = $userModel->orderBy('created_at', 'DESC')->findAll();

        $this->data = [
            'title' => 'Department Page | LD Planner',
            'employees' => $users,
            'page_name' => 'line managers',
        ];
    }

    public function index(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/assign_line_managers', $this->data) .
            view('includes/footer');
    }

    public function create(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/assign_line_managers', $this->data) .
            view('includes/footer');
    }

    public function edit(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/assign_line_managers', $this->data) .
            view('includes/footer');
    }

    public function update(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/assign_line_managers', $this->data) .
            view('includes/footer');
    }

    public function delete(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/assign_line_managers', $this->data) .
            view('includes/footer');
    }
}

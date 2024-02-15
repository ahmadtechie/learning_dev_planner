<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;

class EmployeeController extends BaseController
{
    public function index(): string
    {
        return view('includes/head') .
            view('includes/sidebar') .
            view('includes/nav') .
            view('forms/division_form') .
            view('includes/footer');
    }

    public function show($slug = null)
    {

    }

    public function new()
    {

    }

    public function create()
    {

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

<?php

namespace App\Controllers\DevelopmentCycle;

use App\Controllers\BaseController;

class DevelopmentCycleController extends BaseController
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

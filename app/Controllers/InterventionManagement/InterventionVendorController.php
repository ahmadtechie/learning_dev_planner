<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;

class InterventionVendorController extends BaseController
{
    public function index(): string
    {
        return view('includes/head') .
            view('includes/sidebar') .
            view('includes/nav') .
            view('forms/create_intervention_vendor.php') .
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

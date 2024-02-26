<?php

namespace App\Controllers\DevelopmentCycle;

use App\Controllers\BaseController;
use App\Models\DevelopmentCycleModel;

class DevelopmentCycleController extends BaseController
{
    public function index(): string
    {
        $cycleModel = model(DevelopmentCycleModel::class);
        $cycles = $cycleModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Development Cycle | LD Planner',
            'page_name' => 'development cycle',
            'cycles' => $cycles,
        ];

        return view('includes/head', $data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $data) .
            view('forms/cycle_setup', $data) .
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

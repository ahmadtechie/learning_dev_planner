<?php

namespace App\Controllers\DevelopmentCycle;

use App\Controllers\BaseController;
use App\Models\DevelopmentCycleModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Services;

helper(['form']);

class DevelopmentCycleController extends BaseController
{
    public array $data;
    public array $validation = [
        'max_competencies' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A number must be specified for max competencies!',
            ]
        ],
        'cycle_year' => [
            'rules' => 'required|integer|validateCycleYearUnique[development_cycle.cycle_year]',
            'errors' => [
                'integer' => 'Cycle year must be specified!',
                'validateCycleYearUnique' => 'Development Cycle already set for selected year',

            ],
        ],
        'start_month' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'Start Month must be specified',
            ],
        ],
        'end_month' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'End Month must be specified',
            ],
        ],
    ];

    function __construct()
    {
        $cycleModel = new DevelopmentCycleModel();
        $cycles = $cycleModel->orderBy('created_at', 'DESC')->findAll();

        $this->data = [
            'title' => 'Development Cycle | LD Planner',
            'page_name' => 'development cycle',
            'cycles' => $cycles,
        ];
    }

    public function index(): string
    {
        $cycleModel = new DevelopmentCycleModel();
        $this->data['userData'] = $this->request->userData;
        $this->data['is_active_cycle_exists'] = $cycleModel->where('is_active', 1)->countAllResults();

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/cycle_setup', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $cycleModel = new DevelopmentCycleModel();
        $is_active_cycle_exists = $cycleModel->where('is_active', 1)->countAllResults();
        $this->data['userData'] = $this->request->userData;
        $this->data['is_active_cycle_exists'] = $is_active_cycle_exists;
        $is_new_active = $this->request->getPost('is_active');

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/cycle_setup', array_merge($this->data, $validation)) .
                view('includes/footer');
        } elseif ($is_active_cycle_exists > 0 and $is_new_active == 1) {
            return redirect('ldm.cycle')->withInput()->with('error', "You can only have one active development cycle at a time. Deactivate previous cycle!");
        }
        // Validation successful
        $validData = $this->validator->getValidated();

        $cycleModel->save($validData);

        $session = Services::session();
        $session->setFlashdata('success', "Development Cycle for {$validData['cycle_year']} set successfully.");
        return redirect()->to(url_to('ldm.cycle'));
    }

    public function edit($id)
    {
        $this->data['userData'] = $this->request->userData;
        $cycleModel = new DevelopmentCycleModel();
        $cycle = $cycleModel->find($id);


        if ($cycle === null) {
            throw new PageNotFoundException("Cycle with ID $id not found.");
        }

        $this->data['title'] = 'Edit Cycle | LD Planner';
        $this->data['cycle'] = $cycle;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/cycle_setup', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($id)
    {
        $this->data['userData'] = $this->request->userData;
        $cycleModel = new DevelopmentCycleModel();
        $this->validation['cycle_year']['rules'] = 'required|integer';
        $is_active_cycle_exists = $cycleModel->where('is_active', 1)->countAllResults();
        $this->data['is_active_cycle_exists'] = $is_active_cycle_exists;
        $is_new_active = $this->request->getPost('is_active');

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/cycle_setup', array_merge($this->data, $validation)) .
                view('includes/footer');
        } elseif ($is_active_cycle_exists > 0 and $is_new_active == 1) {
            return redirect('ldm.cycle')->withInput()->with('error', "You can only have one active development cycle at a time. Deactivate previous cycle!");
        }

        $validData = $this->request->getPost();
        $cycleModel->update($id, $validData);
        $session = Services::session();
        $session->setFlashdata('success', "Cycle {$validData['cycle_year']} updated successfully.");
        return redirect()->to(url_to('ldm.cycle'));
    }
}

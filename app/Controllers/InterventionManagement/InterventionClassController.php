<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;

use App\Models\InterventionClassModel;
use App\Models\InterventionVendorModel;
use App\Models\LearningInterventionModel;

helper(['form', 'url']);


class InterventionClassController extends BaseController
{
    public array $data;
    public array $validation = [
        'intervention_id' => 'permit_empty|integer',
        'class_name' => 'required|max_length[255]',
        'start_date' => 'required|valid_date',
        'end_date' => 'required|valid_date',
        'venue' => 'max_length[255]'
    ];

    function __construct()
    {
        $learningInterventionModel = model(LearningInterventionModel::class);
        $model = model(InterventionClassModel::class);

        $this->data = [
            'title' => 'Learning Intervention | LD Planner',
            'page_name' => 'Learning Intervention Classes',
            'interventions' => $learningInterventionModel->orderBy('created_at', 'DESC')->findAll(),
            'interventionClasses' => $model->findAll(),
        ];
    }

    public function index()
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_class', $this->data) .
            view('includes/footer');
    }

    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionClassModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_intervention_class', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->validator->getValidated();
        $model->save($validData);
        $session = \Config\Services::session();
        $session->setFlashdata('success', "New Intervention Class created successfully.");
        return redirect('ldm.intervention.class');
    }

    public function edit($id)
    {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionClassModel::class);
        $intervention_class = $model->find($id);
        $this->data['intervention_class'] = $intervention_class;

        $this->data['title'] = 'LD Planner | Edit Intervention Class';

        if ($intervention_class === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Intervention Class with ID $id not found.");
        }

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_class', $this->data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $this->data['userData'] = $this->request->userData;

        $model = model(InterventionClassModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_intervention_class', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $model->update($id, $validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Intervention Class updated successfully.");
        return redirect('ldm.intervention.class');
    }

    public function delete($id) {
        $this->data['userData'] = $this->request->userData;
        $model = new LearningInterventionModel();
        $model->delete($id);

        return redirect('ldm.learning.intervention')->with('error', 'Intervention Class deleted successfully.');
    }
}

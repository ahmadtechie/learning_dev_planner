<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Models\InterventionClassModel;
use App\Models\InterventionContentModel;
use App\Models\LearningInterventionModel;

helper(['form', 'url']);

class InterventionContentController extends BaseController
{
    public array $data;
    public array $validation = [
        'intervention_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'An intervention must be selected.',
            ],
        ],
        'module_title' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'A module title must.',
            ],
        ],
        'sub_topic' => [
            'rules' => 'required',
            'errors' => [
                'integer' => 'An sub-topic must is required.',
            ],
        ],
    ];

    function __construct()
    {
        $interventionContentModel = model(InterventionContentModel::class);
        $learningInterventionModel = model(LearningInterventionModel::class);

        $this->data = [
            'title' => 'Learning Intervention | LD Planner',
            'interventionContent' => $interventionContentModel->findAll(),
            'interventions' => $learningInterventionModel->orderBy('created_at', 'DESC')->findAll(),
            'page_name' => 'Learning Intervention Content',
        ];
    }

    public function index()
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_content', $this->data) .
            view('includes/footer');
    }

    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionContentModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_intervention_content', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->validator->getValidated();
        $model->save($validData);
        $session = \Config\Services::session();
        $session->setFlashdata('success', "New Intervention Content added successfully.");
        return redirect('ldm.intervention.content');
    }

    public function edit($id) {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionContentModel::class);
        $intervention_content = $model->find($id);
        $this->data['intervention_content'] = $intervention_content;

        $this->data['title'] = 'LD Planner | Edit Learning Intervention';

        if ($intervention_content === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Intervention Content with ID $id not found.");
        }

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_content', $this->data) .
            view('includes/footer');
    }

    public function update($id) {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionContentModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_intervention_content', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $model->update($id, $validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Intervention Content updated successfully.");
        return redirect('ldm.intervention.content');
    }

    public function delete($id) {
        $this->data['userData'] = $this->request->userData;
        $model = new InterventionContentModel();
        $model->delete($id);

        return redirect('ldm.intervention.content')->with('error', 'Intervention Content deleted successfully.');
    }
}

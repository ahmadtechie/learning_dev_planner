<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Models\InterventionClassModel;
use App\Models\InterventionContentModel;
use App\Models\LearningInterventionModel;
use CodeIgniter\Exceptions\PageNotFoundException;

helper(['form', 'url']);

class InterventionContentController extends BaseController
{
    public array $data;
    public InterventionContentModel $interventionContentModel;
    public LearningInterventionModel $learningInterventionModel;
    public array $validation = [
        'intervention_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'An intervention must be selected.',
            ],
        ],
        'learning_objectives' => 'permit_empty',
        'modules' => 'permit_empty',
    ];

    function __construct()
    {
        $this->interventionContentModel = model(InterventionContentModel::class);
        $this->learningInterventionModel = model(LearningInterventionModel::class);

        $this->data = [
            'title' => 'Learning Intervention | LD Planner',
            'interventionContent' => $this->interventionContentModel->findAll(),
            'interventions' => $this->learningInterventionModel->orderBy('created_at', 'DESC')->findAll(),
            'page_name' => 'Learning Intervention Content',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_content', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;
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
        $this->interventionContentModel->save($validData);
        return redirect('ldm.intervention.content')->with('success', "New Intervention Content added successfully.");
    }

    public function edit($id): string
    {
        $this->data['userData'] = $this->request->userData;
        $intervention_content = $this->interventionContentModel->find($id);
        $this->data['intervention_content'] = $intervention_content;
        $this->data['title'] = 'LD Planner | Edit Learning Intervention';

        if ($intervention_content === null) {
            throw new PageNotFoundException("Intervention Content with ID $id not found.");
        }
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_content', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($intervention_content_id) {
        $this->data['userData'] = $this->request->userData;
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
        $this->interventionContentModel->update($intervention_content_id, $validData);
        return redirect('ldm.intervention.content')->with('success', "Intervention Content updated successfully.");
    }

    public function delete() {
        $this->data['userData'] = $this->request->userData;
        $content_id = $this->request->getVar('content_id');
        $this->interventionContentModel->delete($content_id);

        return redirect('ldm.intervention.content')->with('error', 'Intervention Content deleted successfully.');
    }
}

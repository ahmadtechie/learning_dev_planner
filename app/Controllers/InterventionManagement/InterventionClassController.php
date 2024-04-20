<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;

use App\Models\InterventionClassModel;
use App\Models\InterventionVendorModel;
use App\Models\LearningInterventionModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

helper(['form', 'url']);


class InterventionClassController extends BaseController
{
    public array $data;
    public LearningInterventionModel $learningInterventionModel;
    public InterventionClassModel $interventionClassModel;


    public array $validation = [
        'intervention_id' => 'permit_empty|integer',
        'class_name' => 'required|max_length[255]',
        'start_date' => 'required|valid_date',
        'end_date' => 'required|valid_date',
        'venue' => 'max_length[255]'
    ];

    function __construct()
    {
        $this->learningInterventionModel = model(LearningInterventionModel::class);
        $this->interventionClassModel = model(InterventionClassModel::class);

        $this->data = [
            'title' => 'Learning Intervention Classes | LD Planner',
            'page_name' => 'Learning Intervention Classes',
            'interventions' => $this->learningInterventionModel->orderBy('created_at', 'DESC')->findAll(),
            'interventionClasses' => $this->interventionClassModel->findAll(),
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_class', $this->data) .
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
                view('forms/create_intervention_class', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $this->interventionClassModel->save($validData);
        return redirect('ldm.intervention.class')->with('success', "New Intervention Class created successfully.");
    }

    public function edit($id): string
    {
        $this->data['userData'] = $this->request->userData;
        $intervention_class = $this->interventionClassModel->find($id);

        $this->data['intervention_class'] = $intervention_class;
        $this->data['title'] = 'LD Planner | Edit Intervention Class';

        if ($intervention_class === null) {
            throw new PageNotFoundException("Intervention Class with ID $id not found.");
        }

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_class', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($intervention_class_id)
    {
        $this->data['userData'] = $this->request->userData;
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
        $this->interventionClassModel->update($intervention_class_id, $validData);;
        return redirect('ldm.intervention.class')->with('success', "Intervention Class updated successfully.");
    }

    public function delete(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $intervention_class_id = $this->request->getVar('intervention_class_id');
        $this->interventionClassModel->delete($intervention_class_id);
        return redirect('ldm.intervention.class')->with('error', 'Intervention Class deleted successfully.');
    }
}

<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Models\InterventionTypeModel;

helper(['form', 'url']);

class InterventionTypeController extends BaseController
{
    public array $data;
    public array $validation = [
        'name' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Intervention type name must be provided!',
                'min_length' => 'Intervention type name must be at least 3 characters.',
            ]
        ],
    ];

    function __construct()
    {
        $model = model(InterventionTypeModel::class);
        $this->data = [
            'title' => 'Intervention Types | LD Planner',
            'page_name' => 'Intervention Types',
            'interventionTypes' => $model->orderBy('created_at', 'DESC')->findAll(),
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_type', $this->data) .
            view('includes/footer');
    }

    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionTypeModel::class);
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_intervention_type', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $model->save($validData);
        $session = \Config\Services::session();
        $session->setFlashdata('success', "Intervention Type {$validData['name']} created successfully.");
        return redirect('ldm.intervention.type');
    }

    public function edit($num)
    {
        $this->data['userData'] = $this->request->userData;

        $interventionTypeModel = model(InterventionTypeModel::class);
        $intervention_type = $interventionTypeModel->find($num);
        $this->data['intervention_type'] = $intervention_type;
        $this->data['title'] = 'LD Planner | Edit Intervention Type';

        if ($intervention_type === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Intervention Type with ID $num not found.");
        }

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_type', $this->data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $this->data['userData'] = $this->request->userData;

        $model = new InterventionTypeModel();

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_intervention_type', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $model->update($id, $validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Intervention Type {$validData['name']} updated successfully.");
        return redirect('ldm.intervention.type');
    }

    public function delete($id)
    {
        $this->data['userData'] = $this->request->userData;
        $model = new InterventionTypeModel();
        $model->delete($id);

        return redirect('ldm.intervention.type')->with('error', 'Intervention type deleted successfully.');
    }
}

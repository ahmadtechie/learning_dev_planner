<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Models\InterventionTypeModel;
use CodeIgniter\Exceptions\PageNotFoundException;

helper(['form', 'url']);

class InterventionTypeController extends BaseController
{
    public array $data;
    public InterventionTypeModel $interventionTypeModel;
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
        $this->interventionTypeModel = model(InterventionTypeModel::class);
        $this->data = [
            'title' => 'Intervention Types | LD Planner',
            'page_name' => 'Intervention Types',
            'interventionTypes' => $this->interventionTypeModel->orderBy('created_at', 'DESC')->findAll(),
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
                view('forms/create_intervention_type', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $this->interventionTypeModel->save($validData);
        return redirect('ldm.intervention.type')->with('success', "Intervention Type {$validData['name']} created successfully.");
    }

    public function edit($num): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['title'] = 'LD Planner | Edit Intervention Type';
        $intervention_type = $this->interventionTypeModel->find($num);
        $this->data['intervention_type'] = $intervention_type;

        if ($intervention_type === null) {
            throw new PageNotFoundException("Intervention Type with ID $num not found.");
        }
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention_type', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($id)
    {
        $this->data['userData'] = $this->request->userData;

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
        $this->interventionTypeModel->update($id, $validData);
        return redirect('ldm.intervention.type')->with('success', "Intervention Type {$validData['name']} updated successfully.");
    }

    public function delete()
    {
        $this->data['userData'] = $this->request->userData;
        $intervention_type_id = $this->request->getVar('intervention_type_id');
        $this->interventionTypeModel->delete($intervention_type_id);
        return redirect('ldm.intervention.type')->with('error', 'Intervention type deleted successfully.');
    }
}

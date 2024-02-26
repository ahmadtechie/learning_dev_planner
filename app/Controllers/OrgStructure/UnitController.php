<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\UnitModel;
use App\Models\DepartmentModel;

helper(['form']);

class UnitController extends BaseController
{
    public array $data;
    public array $validation = [
        'unit_name' => [
            'rules' => 'required|min_length[3]|validateUnitUnique[unit.unit_name]',
            'errors' => [
                'required' => 'Unit name must be provided',
                'min_length' => 'Unit name must be at least 3 characters.',
                'validateUnitUnique' => 'A unit with this name already registered'
            ]
        ],
        'department_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A department must be selected!',
            ],
        ]
    ];

    function __construct() {
        $this->data = [
            'title' => 'Unit Page | LD Planner',
            'page_name' => 'units',
        ];
        $departmentModel = model(DepartmentModel::class);
        $unitModel = model(UnitModel::class);
        $this->data['departments'] = $departmentModel->orderBy('created_at', 'DESC')->findAll();
        $this->data['units'] = $unitModel->orderBy('created_at', 'DESC')->findAll();
    }

    public function index(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_unit', $this->data) .
            view('includes/footer');
    }

    public function create()
    {
        $model = model(UnitModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' =>$this->validator];
            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_unit', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        // Validation successful
        $validData = $this->validator->getValidated();
        $model->save($validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Unit {$validData['unit_name']} created successfully.");

        return redirect('ldm.units');
    }

    public function edit($id)
    {
        $unitModel = model(UnitModel::class);
        $unit = $unitModel->find($id);

        $this->data['unit'] = $unit;
        $this->data['title'] = 'Unit Page | Edit Unit';

        if ($unit === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Unit with ID $id not found.");
        }

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_unit', $this->data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $model = new UnitModel();
        $this->validation['unit_name']['rules'] = 'required|min_length[3]';

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_unit', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $model->update($id, $validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Unit {$validData['unit_name']} edited successfully.");
        return redirect('ldm.units.create');
    }

    public function delete($id)
    {
        $model = new UnitModel();
        $model->delete($id);

        $session = \Config\Services::session();
        $session->setFlashdata('deleted', "Unit deleted successfully.");

        return redirect('ldm.units');
    }
}

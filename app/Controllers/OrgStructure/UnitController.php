<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\UnitModel;
use App\Models\DepartmentModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;

helper(['form']);

class UnitController extends BaseController
{
    public array $data;
    public UnitModel $unitModel;
    public DepartmentModel $departmentModel;
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
        $this->departmentModel = model(DepartmentModel::class);
        $this->unitModel = model(UnitModel::class);
        $this->data['departments'] = $this->departmentModel->orderBy('created_at', 'DESC')->findAll();
        $this->data['units'] = $this->unitModel->orderBy('created_at', 'DESC')->findAll();
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_unit', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;

        if (!$this->validate($this->validation)) {
            $validation = ['validation' =>$this->validator];
            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_unit', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $this->unitModel->save($validData);

        return redirect('ldm.units')->with('success', "Unit {$validData['unit_name']} created successfully.");
    }

    public function edit($id): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['unit'] = $this->unitModel->find($id);
        $this->data['title'] = 'Unit Page | Edit Unit';

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_unit', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($id)
    {
        $this->data['userData'] = $this->request->userData;
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
        $this->unitModel->update($id, $validData);
        return redirect('ldm.units.create')->with('success', "Unit {$validData['unit_name']} edited successfully.");
    }

    public function allUnits(): ResponseInterface
    {
        $unitModel = new UnitModel();
        $department_id = $this->request->getVar('department_id');
        $units = $unitModel->where('department_id', $department_id)->findAll();

        $formattedUnits = [];
        foreach ($units as $unit) {
            $formattedUnits[] = [
                'id' => $unit['id'],
                'unit_name' => $unit['unit_name'],
            ];
        }

        return $this->response->setJSON($formattedUnits);
    }

    public function delete(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $unit_id = $this->request->getVar('unit_id');
        $this->unitModel->delete($unit_id);
        return redirect()->to(url_to('ldm.units'))->with( 'deleted', "Unit deleted successfully.");
    }
}

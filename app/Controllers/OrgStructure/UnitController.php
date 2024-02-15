<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\UnitModel;
use App\Models\DepartmentModel;

helper(['form']);

class UnitController extends BaseController
{
    public function index(): string
    {
        $unitModel = model(UnitModel::class);
        $units = $unitModel->orderBy('created_at', 'DESC')->findAll();

        $departmentModel = model(DepartmentModel::class);
        $departments = $departmentModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Unit Page | LD Planner',
            'units' => $units,
            'departments' => $departments,
        ];

        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $data) .
            view('forms/create_unit', $data) .
            view('includes/footer');
    }

    public function create()
    {
        $model = model(UnitModel::class);

        $units = $model->orderBy('created_at', 'DESC')->findAll();

        $departmentModel = model(DepartmentModel::class);
        $departments = $departmentModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Unit Page | LD Planner',
            'units' => $units,
            'departments' => $departments,
        ];

        if (!$this->validate([
            'unit_name' => 'required|min_length[3]',
            'department_id' => 'required|integer',
        ])) {
            $errors = [
                'errors' => $this->validator->getError(),
            ];
            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $data) .
                view('forms/create_unit', array_merge($data, $errors)) .
                view('includes/footer');
        }

        // Validation successful
        $validData = $this->validator->getValidated();

        $model->save([
            'unit_name' => $validData['unit_name'],
            'department_id' => $validData['department_id']
        ]);

        return redirect('ldm.units');
    }

    public function edit($id)
    {
        $unitModel = model(UnitModel::class);
        $unit = $unitModel->find($id);
        $units = $unitModel->orderBy('created_at', 'DESC')->findAll();

        $departmentModel = model(DepartmentModel::class);
        $departments = $departmentModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'unit' => $unit,
            'units' => $units,
            'departments' => $departments,
        ];

        if ($unit === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Unit with ID $id not found.");
        }

        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $data) .
            view('forms/create_unit', $data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $model = new UnitModel();

        $units = $model->orderBy('created_at', 'DESC')->findAll();

        $departmentModel = model(DepartmentModel::class);
        $departments = $departmentModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'units' => $units,
            'departments' => $departments,
        ];

        if (!$this->validate([
            'unit_name' => 'required|min_length[3]',
            'department_id' => 'required|integer',
        ])) {
            $errors = [
                'errors' => $this->validator->getError(),
            ];
            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $data) .
                view('forms/create_unit', $data) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();

        $model->update($id, $validData);

        return redirect('ldm.units.create');
    }

    public function delete($id)
    {
        $model = new UnitModel();

        $model->delete($id);

        return redirect('ldm.units');
    }
}

<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\GroupModel;

use CodeIgniter\Config\Services;

helper(['form']);

class DepartmentController extends BaseController
{
    public array $data;
    public array $validation = [
        'department_name' => [
            'rules' => 'required|min_length[3]|validateDepartmentUnique[department.department_name]',
            'errors' => [
                'required' => 'Department name must be provided',
                'min_length' => 'Division name must be at least 3 characters.',
                'is_unique' => 'A department with this name already registered'
            ]
        ],
//        'group_id' => [
//            'rules' => 'required|integer',
//            'errors' => [
//                'integer' => 'A group must be selected!',
//            ],
//        ]
    ];

    function __construct() {
        $departmentModel = model(DepartmentModel::class);
        $departments = $departmentModel->orderBy('created_at', 'DESC')->findAll();

        $groupModel = model(GroupModel::class);
        $groups = $groupModel->orderBy('created_at', 'DESC')->findAll();

        $this->data = [
            'title' => 'Department Page | LD Planner',
            'departments' => $departments,
            'groups' => $groups,
            'page_name' => 'departments',
        ];
    }

    public function index(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_department', $this->data) .
            view('includes/footer');
    }

    public function create()
    {
        $departmentModel = model(DepartmentModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' =>$this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_department', array_merge($validation, $this->data)) .
                view('includes/footer');
        }
        // Validation successful
        $validData = $this->validator->getValidated();

        try {
            $departmentModel->save($validData);
            $session = \Config\Services::session();
            $session->setFlashdata('success', "Department {$validData['department_name']} created successfully.");
            return redirect()->to(url_to('ldm.departments'));
        } catch (\Exception $e) {
            if ($e->getCode() == 1062) {
                $validation = ['validation' => $this->validator];

                return view('includes/head', $this->data) .
                    view('includes/navbar') .
                    view('includes/sidebar') .
                    view('includes/mini_navbar', $this->data) .
                    view('forms/create_department', array_merge($validation, $this->data)) .
                    view('includes/footer');
            } else {
                throw $e;
            }
        }
    }

    public function edit($id)
    {
        $departmentModel = model(DepartmentModel::class);
        $department = $departmentModel->find($id);

        $this->data['title'] = 'LD Planner | Edit Department';

        if ($department === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Department with ID $id not found.");
        }

        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data + ['department' => $department]) .
            view('forms/create_department', $this->data + ['department' => $department]) .
            view('includes/footer');
    }

    public function update($id)
    {
        $departmentModel = new DepartmentModel();

        $this->validation['department_name']['rules'] = 'required|min_length[3]';
        if (!$this->validate($this->validation)) {
            $validation = ['validation' =>$this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_department', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->request->getPost();

        try {
            $departmentModel->update($id, $validData);
            $session = \Config\Services::session();
            $session->setFlashdata('success', "Department {$validData['department_name']} edited successfully.");
            return redirect()->to(url_to('ldm.departments'));
        } catch (\Exception $e) {
            if ($e->getCode() == 1062) {
                $validation = ['validation' =>$this->validator];
                return view('includes/head') .
                    view('includes/navbar') .
                    view('includes/sidebar') .
                    view('includes/mini_navbar', $this->data) .
                    view('forms/create_department', array_merge($this->data, $validation)) .
                    view('includes/footer');
            } else {
                throw $e;
            }
        }
    }

    public function delete($id)
    {
        $model = new DepartmentModel();
        $model->delete($id);
        $session = \Config\Services::session();
        $session->setFlashdata('deleted', "Department deleted successfully.");
        return redirect()->to(url_to('ldm.departments'));
    }
}


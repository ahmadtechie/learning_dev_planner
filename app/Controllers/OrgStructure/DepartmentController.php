<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\GroupModel;

use CodeIgniter\Config\Services;

helper(['form']);

class DepartmentController extends BaseController
{
    public function index(): string
    {
        $departmentModel = model(DepartmentModel::class);
        $departments = $departmentModel->orderBy('created_at', 'DESC')->findAll();

        $groupModel = model(GroupModel::class);
        $groups = $groupModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Department Page | LD Planner',
            'departments' => $departments,
            'groups' => $groups,
        ];

        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $data) .
            view('forms/create_department', $data) .
            view('includes/footer');
    }

    public function create()
    {
        $departmentModel = model(DepartmentModel::class);
        $departments = $departmentModel->orderBy('created_at', 'DESC')->findAll();


        $groupModel = model(GroupModel::class);
        $groups = $groupModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Department Page | LD Planner',
            'departments' => $departments,
            'groups' => $groups,
        ];

        if (!$this->validate([
            'department_name' => 'required|min_length[3]|is_unique[department.department_name]',
            'group_id' => 'required|integer',
        ])) {
            // Validation failed

            // Store the user's input in the session
            $session = Services::session();
            $session->setFlashdata('old', $this->request->getPost());
            $oldInput = $session->getFlashdata('old');

            // Display custom error message and re-populate the form
            $errors = [
                'errors' => [
                    'department_name' => 'The department name has already been taken. Please choose another.',
                ],
            ];

            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $data) .
                view('forms/create_department', array_merge($errors, $oldInput, $data)) .
                view('includes/footer');
        }

        // Validation successful
        $validData = $this->validator->getValidated();

        try {
            $departmentModel->save($validData);
            return redirect()->to(url_to('ldm.departments'));
        } catch (\Exception $e) {
            if ($e->getCode() == 1062) { // MySQL duplicate entry error code
                // Duplicate entry error handling

                // Retrieve the old input from the session
                $session = Services::session();
                $oldInput = $session->getFlashdata('old');

                // Display custom error message and re-populate the form
                $errors = [
                    'errors' => [
                        'department_name' => 'The department name has already been taken. Please choose another.',
                    ],
                ];

                return view('includes/head') .
                    view('includes/sidebar') .
                    view('includes/nav') .
                    view('forms/create_department', array_merge($errors, $oldInput)) .
                    view('includes/footer');
            } else {
                // Handle other exceptions or rethrow if necessary
                throw $e;
            }
        }
    }

    public function edit($id)
    {
        $departmentModel = model(DepartmentModel::class);
        $department = $departmentModel->find($id);
        $departments = $departmentModel->orderBy('created_at', 'DESC')->findAll();

        $groupModel = model(GroupModel::class);
        $groups = $groupModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'department' => $department,
            'departments' => $departments,
            'groups' => $groups,
        ];

        if ($department === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Department with ID $id not found.");
        }

        return view('includes/head') .
            view('includes/sidebar') .
            view('includes/nav') .
            view('forms/edit_department', $data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $model = new DepartmentModel();
        $departments = $model->orderBy('created_at', 'DESC')->findAll();


        $groupModel = model(GroupModel::class);
        $groups = $groupModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Department Page | LD Planner',
            'departments' => $departments,
            'groups' => $groups,
        ];

        if (!$this->validate([
            'department_name' => "required|min_length[3]|is_unique[department.department_name,id,$id]",
            'group_id' => 'required|integer',
        ])) {

            // Store the user's input in the session
            $session = Services::session();
            $session->setFlashdata('old', $this->request->getPost());
            $oldInput = $session->getFlashdata('old');

            // Display custom error message and re-populate the form
            $errors = [
                'errors' => [
                    'department_name' => 'The department name has already been taken. Please choose another.',
                ],
            ];

            return view('includes/head') .
                view('includes/sidebar') .
                view('includes/nav') .
                view('forms/edit_department', array_merge($errors, $oldInput, $data)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();

        try {
            $model->update($id, $validData);
            return redirect()->to(url_to('ldm.departments'));
        } catch (\Exception $e) {
            if ($e->getCode() == 1062) { // MySQL duplicate entry error code
                $errors = [
                    'errors' => ['department_name' => 'The department name has already been taken. Please choose another.'],
                ];
                return view('includes/head') .
                    view('includes/sidebar') .
                    view('includes/nav') .
                    view('forms/edit_department', $errors) .
                    view('includes/footer');
            } else {
                // Handle other exceptions or rethrow if necessary
                throw $e;
            }
        }
    }

    public function delete($id)
    {
        $model = new DepartmentModel();
        $model->delete($id);
        return redirect()->to(url_to('ldm.departments'));
    }
}


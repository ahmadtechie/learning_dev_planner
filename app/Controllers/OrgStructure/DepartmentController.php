<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\GroupModel;

use CodeIgniter\Config\Services;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;

helper(['form']);

class DepartmentController extends BaseController
{
    public array $data;
    public DepartmentModel $departmentModel;
    public GroupModel $groupModel;
    public array $validation = [
        'department_name' => [
            'rules' => 'required|min_length[3]|validateDepartmentUnique[department.department_name]',
            'errors' => [
                'required' => 'Department name must be provided',
                'min_length' => 'Division name must be at least 3 characters.',
                'validateDepartmentUnique' => 'A department with this name already registered'
            ]
        ],
        'group_id' => "permit_empty|integer"
    ];

    function __construct()
    {
        $this->departmentModel = model(DepartmentModel::class);
        $this->groupModel = model(GroupModel::class);

        $this->data = [
            'title' => 'Department Page | LD Planner',
            'departments' => $this->departmentModel->orderBy('created_at', 'DESC')->findAll(),
            'groups' => $this->groupModel->orderBy('created_at', 'DESC')->findAll(),
            'page_name' => 'departments',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_department', $this->data) .
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
                view('forms/create_department', array_merge($validation, $this->data)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $this->departmentModel->save($validData);
        return redirect()->to(url_to('ldm.departments', 'success', "Department {$validData['department_name']} created successfully."));
    }

    public function edit($id): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['department'] = $this->departmentModel->find($id);
        $this->data['title'] = 'LD Planner | Edit Department';

        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_department', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($department_id)
    {
        $this->data['userData'] = $this->request->userData;

        $this->validation['department_name']['rules'] = 'required|min_length[3]';
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_department', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->request->getPost();
        $this->departmentModel->update($department_id, $validData);
        return redirect()->to(url_to('ldm.departments'))->with('success', "Department {$validData['department_name']} edited successfully.");
    }

    public function delete(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $department_id = $this->request->getVar('department_id');
        $this->departmentModel->delete($department_id);
        return redirect()->to(url_to('ldm.departments'))->with('deleted', "Department deleted successfully.");
    }

    public function allDepartments(): ResponseInterface
    {
        $group_id = $this->request->getVar('group_id');
        $departments = $this->departmentModel->where('group_id', $group_id)->findAll();

        $formattedDepartments = [];
        foreach ($departments as $department) {
            $formattedDepartments[] = [
                'id' => $department['id'],
                'department_name' => $department['department_name'],
            ];
        }

        return $this->response->setJSON($formattedDepartments);
    }
}


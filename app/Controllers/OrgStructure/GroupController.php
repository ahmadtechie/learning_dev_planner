<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\DivisionModel;
use App\Models\GroupModel;
use CodeIgniter\Config\Services;

helper(['form']);


class GroupController extends BaseController
{
    public array $data;
    public array $validation = [
        'group_name' => [
            'rules' => 'required|min_length[3]|validateGroupUnique[group.group_name]',
            'errors' => [
                'required' => 'Group name must be provided',
                'min_length' => 'Group name must be at least 3 characters.',
                'validateGroupUnique' => 'A group with this name already registered'
            ]
        ],
//        'division_id' => [
//            'rules' => 'required|integer',
//            'errors' => [
//                'integer' => 'A group must be selected!',
//            ],
//        ]
    ];

    function __construct() {
        $group_model = model(GroupModel::class);
        $groups = $group_model->orderBy('created_at', 'DESC')->findAll();

        $division_model = model(DivisionModel::class);
        $divisions = $division_model->orderBy('created_at', 'DESC')->findAll();

        $this->data = [
            'title' => 'Group Page | LD Planner',
            'groups' => $groups,
            'divisions' => $divisions,
            'page_name' => 'groups',
        ];
    }

    public function index(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_group', $this->data) .
            view('includes/footer');
    }

    public function create()
    {
        $model = model(GroupModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_group', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        // the validation was successful
        // get the validated data
        $validData = $this->validator->getValidated();

        $model->save([
            'group_name' => $validData['group_name'],
            'division_id' => $validData['division_id']
        ]);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Group {$validData['group_name']} created successfully.");
        return redirect('ldm.groups');
    }

    public function edit($id)
    {
        $model = model(GroupModel::class);
        $group = $model->find($id);

        $this->data['title'] = 'Edit Group | LD Planner';
        $this->data['group'] = $group;

        if ($group === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Group with ID $id not found.");
        }

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_group', $this->data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $model = new GroupModel();
        $this->validation['group_name']['rules'] = 'required|min_length[3]';

        // Validate the request
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_group', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        // Get the validated data
        $validData = $this->request->getPost();

        try {
            // Update the division in the database
            $session = \Config\Services::session();
            // Set the success message
            $session->setFlashdata('success', "Group {$validData['group_name']} edited successfully.");
            $model->update($id, $validData);
            return redirect()->to(url_to('ldm.groups.create'));
        } catch (\Exception $e) {
            // Handle exceptions if necessary
            throw $e;
        }
    }

    public function delete($id)
    {
        $model = new GroupModel();

        // Delete the division from the database
        $model->delete($id);
        $session = \Config\Services::session();
        $session->setFlashdata('deleted', "Group deleted successfully.");

        return redirect('ldm.groups');
    }

}

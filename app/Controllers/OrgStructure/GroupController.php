<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\DivisionModel;
use App\Models\GroupModel;
use CodeIgniter\Config\Services;

helper(['form']);


class GroupController extends BaseController
{
    public function index(): string
    {
        $group_model = model(GroupModel::class);
        $groups = $group_model->orderBy('created_at', 'DESC')->findAll();

        $division_model = model(DivisionModel::class);
        $divisions = $division_model->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Division Page | LD Planner',
            'groups' => $groups,
            'divisions' => $divisions,
        ];

        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $data) .
            view('forms/create_group', $data) .
            view('includes/footer');
    }

    public function create()
    {
        $model = model(GroupModel::class);
        $data = [
            'title' => 'Division Page | LD Planner',
            'groups' => $model->orderBy('created_at', 'DESC')->findAll(),
            'page_name' => 'groups',
        ];

        if (!$this->validate([
            'group_name' => 'required|min_length[3]|is_unique[group.group_name]',
            'division_id' => 'required|integer',
        ])) {
            $errors = [
                'errors' => $this->validator->getError(),
            ];

            // Store the user's input in the session
            $session = Services::session();
            $session->setFlashdata('old', $this->request->getPost());

            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $data) .
                view('forms/create_division', array_merge($data, $errors)) .
                view('includes/footer');
        }

        // the validation was successful

        // get the validated data
        $validData = $this->validator->getValidated();

        $model->save([
            'group_name' => $validData['group_name'],
            'division_id' => $validData['division_id']
        ]);
        return redirect('ldm.groups');
    }

    public function edit($id)
    {
        $group_model = model(GroupModel::class);
        $group = $group_model->find($id);
        $groups = $group_model->orderBy('created_at', 'DESC')->findAll();

        $model = model(DivisionModel::class);
        $divisions = $model->orderBy('created_at', 'DESC')->findAll();
        $data = [
            'group' => $group,
            'groups' => $groups,
            'divisions' => $divisions,
            'page_name' => 'group edit',
        ];

        if ($group === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Group with ID $id not found.");
        }

        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $data) .
            view('forms/create_group', $data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $model = new GroupModel();

        // Validate the request
        if (!$this->validate([
            'group_name' => 'required|min_length[3]|is_unique[group.group_name]',
            'division_id' => 'required|integer',
        ])) {
            $errors = [
                'errors' => $this->validator->getError(),
            ];
            return view('includes/head') .
                view('includes/sidebar') .
                view('includes/nav') .
                view('forms/edit_division', $errors) .
                view('includes/footer');
        }

        // Get the validated data
        $validData = $this->request->getPost();

        // Update the division in the database
        $model->update($id, $validData);

        return redirect('ldm.groups.create');
    }

    public function delete($id)
    {
        $model = new GroupModel();

        // Delete the division from the database
        $model->delete($id);

        return redirect('ldm.groups');
    }

}

<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\DivisionModel;
use CodeIgniter\Config\Services;

helper(['form']);

class DivisionController extends BaseController
{
    public function index(): string
    {
        $model = model(DivisionModel::class);
        $divisions = $model->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Division Page | LD Planner',
            'divisions' => $divisions,
            'page_name' => 'divisions',
        ];
        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $data) .
            view('forms/create_division', $data) .
            view('includes/footer');
    }

    public function create()
    {
        $model = model(DivisionModel::class);
        $divisions = $model->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Division Page | LD Planner',
            'divisions' => $divisions,
            'page_name' => 'divisions',
        ];

        if (!$this->validate([
            'division_name' => 'required|min_length[3]|is_unique[division.division_name]',
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
            'division_name' => $validData['division_name'],
        ]);
        return redirect('ldm.divisions');
    }

    public function edit($num)
    {
        $model = model(DivisionModel::class);
        $division = $model->find($num);
        $divisions = $model->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'division' => $division,
            'divisions' => $divisions,
            'page_name' => 'divisions',
        ];

        if ($division === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Division with ID $num not found.");
        }

        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $data) .
            view('forms/create_division', $data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $model = new DivisionModel();

        $data = [
            'page_name' => 'divisions',
        ];

        // Validate the request
        if (!$this->validate([
            'division_name' => 'required|min_length[3]|is_unique[division.division_name]',
        ])) {
            $errors = [
                'errors' => $this->validator->getError(),
            ];
            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $data) .
                view('forms/create_division', array_merge($data, $errors)) .
                view('includes/footer');
        }

        // Get the validated data
        $validData = $this->request->getPost();

        // Update the division in the database
        $model->update($id, $validData);

        return redirect('ldm.divisions.create');
    }

    public function delete($id)
    {
        $model = new DivisionModel();

        // Delete the division from the database
        $model->delete($id);

        return redirect('ldm.divisions.create');
    }
}

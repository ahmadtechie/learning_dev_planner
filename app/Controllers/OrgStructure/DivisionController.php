<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\DivisionModel;


helper(['form']);

class DivisionController extends BaseController
{
    public array $data;
    public array $validation = [
        'division_name' => [
            'rules' => 'required|min_length[3]|validateDivisionUnique[division.division_name]',
            'errors' => [
                'required' => 'Division name must be provided.',
                'min_length' => 'Division name must be at least 3 characters.',
                'validateDivisionUnique' => 'A division with this name already exists.'
            ]
        ],
    ];

    function __construct()
    {
        $model = model(DivisionModel::class);
        $divisions = $model->orderBy('created_at', 'DESC')->findAll();

        $this->data = [
            'title' => 'Division Page | LD Planner',
            'divisions' => $divisions,
            'page_name' => 'divisions',
        ];
    }

    public function index(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_division', $this->data) .
            view('includes/footer');
    }

    public function create()
    {
        $model = model(DivisionModel::class);
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_division', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $model->save($validData);
        $session = \Config\Services::session();
        $session->setFlashdata('success', "Division {$validData['division_name']} created successfully.");
        return redirect('ldm.divisions');
    }

    public function edit($num)
    {
        $model = model(DivisionModel::class);
        $division = $model->find($num);
        $this->data['title'] = 'LD Planner | Edit Division';

        if ($division === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Division with ID $num not found.");
        }

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_division', $this->data + ['division' => $division]) .
            view('includes/footer');
    }

    public function update($id)
    {
        $model = new DivisionModel();
        $this->validation['division_name']['rules'] = 'required|min_length[3]';

        // Validate the request
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_division', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        // Get the validated data
        $validData = $this->request->getPost();

        // Update the division in the database
        $model->update($id, $validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Division {$validData['division_name']} edited successfully.");
        return redirect('ldm.divisions.create');
    }

    public function delete($id)
    {
        $model = new DivisionModel();

        $session = \Config\Services::session();
        $session->setFlashdata('deleted', "Division deleted successfully.");

        // Delete the division from the database
        $model->delete($id);

        return redirect('ldm.divisions.create');
    }
}

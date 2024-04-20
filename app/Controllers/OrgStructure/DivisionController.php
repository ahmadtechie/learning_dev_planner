<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\DivisionModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;


helper(['form']);

class DivisionController extends BaseController
{
    public array $data;
    public DivisionModel $divisionModel;
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
        $this->divisionModel = model(DivisionModel::class);
        $divisions = $this->divisionModel->orderBy('created_at', 'DESC')->findAll();

        $this->data = [
            'title' => 'Division Page | LD Planner',
            'divisions' => $divisions,
            'page_name' => 'divisions',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_division', $this->data) .
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
                view('forms/create_division', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $this->divisionModel->save($validData);
        return redirect('ldm.divisions')->with('success', "Division {$validData['division_name']} created successfully.");
    }

    public function edit($num): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['division'] = $this->divisionModel->find($num);
        $this->data['title'] = 'LD Planner | Edit Division';

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_division', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($division_id)
    {
        $this->data['userData'] = $this->request->userData;
        $this->validation['division_name']['rules'] = 'required|min_length[3]';

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_division', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->request->getPost();
        $this->divisionModel->update($division_id, $validData);
        return redirect('ldm.divisions.create')->with('success', "Division {$validData['division_name']} edited successfully.");
    }

    public function delete(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $division_id = $this->request->getVar('division_id');
        $this->divisionModel->delete($division_id);
        return redirect('ldm.divisions.create')->with('deleted', "Division deleted successfully.");
    }
}

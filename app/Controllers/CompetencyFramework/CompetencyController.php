<?php

namespace App\Controllers\CompetencyFramework;

use App\Controllers\BaseController;
use App\Models\CompetencyModel;
use App\Models\JobModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Exceptions\PageNotFoundException;
use ReflectionException;

helper(['form']);

class CompetencyController extends BaseController
{
    public array $data;
    public array $validation = [
        'competency_name' => [
            'rules' => 'required|min_length[3]|validateCompetencyUnique[competency.competency_name]',
            'errors' => [
                'required' => 'Competency name must be provided',
                'min_length' => 'Competency name must be at least 3 characters.',
                'validateCompetencyUnique' => 'A competency with this name already registered'
            ]
        ],
        'description' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Description must be provided',
            ],
        ]
    ];

    function __construct()
    {
        $model = new CompetencyModel();
        $competencies = $model->orderBy('created_at', 'DESC')->findAll();

        $this->data = [
            'title' => 'Competency Page | LD Planner',
            'competencies' => $competencies,
            'page_name' => 'competencies',
        ];
        $this->data['userData'] = $this->request->userData;

    }

    public function index(): string
    {
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_competency', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws ReflectionException
     */
    public function create()
    {
        $jobModel = new CompetencyModel();

        $this->data['title'] = 'Create Competency | LD Planner';

        if (!$this->validate($this->validation)) {
            // Validation failed
            $validation = ['validation' =>$this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_competency', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        // Validation successful
        $validData = $this->validator->getValidated();

        $jobModel->save($validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Competency {$validData['competency_name']} created successfully.");
        return redirect()->to(url_to('ldm.competencies'));
    }

    public function edit($id)
    {
        $competencyModel = new CompetencyModel();
        $competency = $competencyModel->find($id);


        if ($competency === null) {
            throw new PageNotFoundException("Competency with ID $id not found.");
        }

        $this->data['title'] = 'Edit Competency | LD Planner';
        $this->data['competency'] = $competency;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_competency', $this->data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $competencyModel = new CompetencyModel();
        $this->validation['competency_name']['rules'] = 'required|min_length[3]';

        if (!$this->validate($this->validation)) {
            // Validation failed
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_competency', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        // Validation successful
        $validData = $this->request->getPost();

        $competencyModel->update($id, $validData);
        $session = \Config\Services::session();
            $session->setFlashdata('success', "Competency {$validData['competency_name']} edited successfully.");
        return redirect()->to(url_to('ldm.competencies'));
    }

    public function delete($id)
    {
        $jobModel = new JobModel();
        $jobModel->delete($id);
        $session = \Config\Services::session();
        $session->setFlashdata('deleted', "Competency deleted successfully.");
        return redirect()->to(url_to('ldm.competencies'));
    }


}

<?php

namespace App\Controllers\CompetencyFramework;

use App\Controllers\BaseController;
use App\Models\CompetencyModel;
use App\Models\CompetencyTypeModel;
use App\Models\JobModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

helper(['form', 'url']);

class CompetencyController extends BaseController
{
    public array $data;
    public CompetencyModel $competencyModel;
    public CompetencyTypeModel $competencyTypeModel;
    public array $validation = [
        'competency_name' => [
            'rules' => 'required|min_length[3]|validateCompetencyUnique[competency.competency_name]',
            'errors' => [
                'required' => 'Competency name must be provided',
                'min_length' => 'Competency name must be at least 3 characters.',
                'validateCompetencyUnique' => 'A competency with this name already registered'
            ]
        ],
        'competency_type_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A competency type must be selected.',
            ],
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
        $this->competencyModel = new CompetencyModel();
        $competencies = $this->competencyModel->orderBy('created_at', 'DESC')->findAll();
        $this->competencyTypeModel = model(CompetencyTypeModel::class);

        $this->data = [
            'title' => 'Competency Page | LD Planner',
            'competencies' => $competencies,
            'competencyTypes' => $this->competencyTypeModel->orderBy('updated_at', 'desc')->findAll(),
            'page_name' => 'competencies',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
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
        $this->data['userData'] = $this->request->userData;
        $this->data['title'] = 'Create Competency | LD Planner';

        if (!$this->validate($this->validation)) {
            $validation = ['validation' =>$this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_competency', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $this->competencyModel->save($validData);
        return redirect()->to(url_to('ldm.competencies'))->with('success', "Competency {$validData['competency_name']} created successfully.");
    }

    public function edit($competency_id)
    {
        $this->data['userData'] = $this->request->userData;
        $competency = $this->competencyModel->find($competency_id);
        if ($competency === null) {
            throw new PageNotFoundException("Competency with ID $competency_id not found.");
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

    /**
     * @throws ReflectionException
     */
    public function update($competency_id)
    {
        $this->data['userData'] = $this->request->userData;
        $this->validation['competency_name']['rules'] = 'required|min_length[3]';

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_competency', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $this->competencyModel->update($competency_id, $validData);
        return redirect()->to(url_to('ldm.competencies'))->with("success", "Competency {$validData['competency_name']} edited successfully.");
    }

    public function delete(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $competency_id = $this->request->getVar('content_id');
        $this->competencyModel->delete($competency_id);
        return redirect()->to(url_to('ldm.competencies'))->with('deleted', "Competency deleted successfully.");
    }
}

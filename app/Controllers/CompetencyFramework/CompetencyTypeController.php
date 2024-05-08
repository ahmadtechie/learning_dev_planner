<?php

namespace App\Controllers\CompetencyFramework;

use App\Controllers\BaseController;
use App\Models\CompetencyTypeModel;
use CodeIgniter\Exceptions\PageNotFoundException;

helper(['form', 'url']);


class CompetencyTypeController extends BaseController
{
    public array $data;
    public CompetencyTypeModel $competencyTypeModel;
    public array $validation = [
        'name' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Competency type name must be provided!',
                'min_length' => 'Competency type name must be at least 3 characters.',
            ]
        ],
    ];

    function __construct()
    {
        $this->competencyTypeModel = model(CompetencyTypeModel::class);
        $this->data = [
            'title' => 'Competency Types | LD Planner',
            'page_name' => 'Competency Types',
            'competencyTypes' => $this->competencyTypeModel->orderBy('created_at', 'DESC')->findAll(),
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_competency_type', $this->data) .
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
                view('forms/create_competency_type', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $this->competencyTypeModel->save($validData);
        return redirect('ldm.competencies.types')->with('success', "Competency Type created successfully.");
    }

    public function edit($num): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['title'] = 'LD Planner | Edit Competency Type';
        $competency_type = $this->competencyTypeModel->find($num);
        $this->data['competency_type'] = $competency_type;

        if ($competency_type === null) {
            throw new PageNotFoundException("Competency Type with ID $num not found.");
        }
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_competency_type', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($id)
    {
        $this->data['userData'] = $this->request->userData;

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_competency_type', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $this->competencyTypeModel->update($id, $validData);
        return redirect('ldm.competencies.types')->with('success', "Competency Type updated successfully.");
    }

    public function delete()
    {
        $this->data['userData'] = $this->request->userData;
        $competency_type_id = $this->request->getVar('competency_type_id');
        $this->competencyTypeModel->delete($competency_type_id);
        return redirect('ldm.competencies.types')->with('error', 'Competency type deleted successfully.');
    }
}

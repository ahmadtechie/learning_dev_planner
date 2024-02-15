<?php

namespace App\Controllers\CompetencyFramework;

use App\Controllers\BaseController;
use App\Models\CompetencyModel;

class CompetencyController extends BaseController
{
    public function index(): string
    {
        $competencyModel = model(CompetencyModel::class);
        $competencies = $competencyModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Competency Page | LD Planner',
            'competencies' => $competencies,
        ];

        return view('includes/head') .
            view('includes/sidebar') .
            view('includes/nav') .
            view('forms/create_competency', $data) .
            view('includes/footer');
    }

    public function create()
    {
        $model = model(CompetencyModel::class);

        if (!$this->validate([
            'competency_name' => 'required|min_length[3]',
        ])) {
            $errors = [
                'errors' => $this->validator->getError(),
            ];
            return view('includes/head') .
                view('includes/sidebar') .
                view('includes/nav') .
                view('forms/create_competency', $errors) .
                view('includes/footer');
        }

        // Validation successful
        $validData = $this->validator->getValidated();

        $model->save([
            'competency_name' => $validData['competency_name'],
        ]);

        return redirect('ldm.competencies');
    }

    public function edit($id)
    {
        $competencyModel = model(CompetencyModel::class);
        $competency = $competencyModel->find($id);
        $competencies = $competencyModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'competency' => $competency,
            'competencies' => $competencies,
        ];

        if ($competency === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Competency with ID $id not found.");
        }

        return view('includes/head') .
            view('includes/sidebar') .
            view('includes/nav') .
            view('forms/edit_competency', $data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $model = new CompetencyModel();

        if (!$this->validate([
            'competency_name' => 'required|min_length[3]',
        ])) {
            $errors = [
                'errors' => $this->validator->getError(),
            ];
            return view('includes/head') .
                view('includes/sidebar') .
                view('includes/nav') .
                view('forms/edit_competency', $errors) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();

        $model->update($id, $validData);

        return redirect('ldm.competencies');
    }

    public function delete($id)
    {
        $model = new CompetencyModel();

        $model->delete($id);

        return redirect('ldm.competencies');
    }
}

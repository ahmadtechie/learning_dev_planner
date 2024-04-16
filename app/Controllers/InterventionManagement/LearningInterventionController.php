<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Models\CompetencyModel;
use App\Models\DevelopmentCycleModel;
use App\Models\EmployeeModel;
use App\Models\InterventionTypeModel;
use App\Models\LearningInterventionModel;
use App\Models\UserRoleModel;

helper(['form', 'url']);

class LearningInterventionController extends BaseController
{
    public array $data;
    public array $validation = [
        'trainer_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A vendor must be selected.',
            ],
        ],
        'competency_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A competency must be selected.',
            ],
        ],
        'cycle_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A development cycle must be selected.',
            ],
        ],
        'intervention_type_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'An intervention type must be selected.',
            ],
        ],
        'cost' => 'required'
    ];

    function __construct()
    {
        $learningInterventionModel = model(LearningInterventionModel::class);
        $userRoleModel = model(UserRoleModel::class);
        $employeeModel = model(EmployeeModel::class);
        $cycleModel = model(DevelopmentCycleModel::class);
        $competencyModel = model(CompetencyModel::class);
        $interventionTypeModel = model(InterventionTypeModel::class);

        $trainerRoleId = $userRoleModel->where('name', 'Trainer')->first()['id'];

        $this->data = [
            'title' => 'Learning Intervention | LD Planner',
            'trainers' => $employeeModel->getTrainerEmployeesDetails($trainerRoleId),
            'competencies' => $competencyModel->findAll(),
            'cycles' => $cycleModel->findAll(),
            'intervention_types' => $interventionTypeModel->findAll(),
            'page_name' => 'Learning Intervention',
            'learningInterventions' => $learningInterventionModel->orderBy('created_at', 'DESC')->findAll(),
        ];
    }

    public function index()
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention', $this->data) .
            view('includes/footer');
    }

    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        $model = model(LearningInterventionModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_intervention', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->validator->getValidated();
        $model->save($validData);
        $session = \Config\Services::session();
        $session->setFlashdata('success', "New Learning Intervention created successfully.");
        return redirect('ldm.learning.intervention');
    }

    public function edit($id) {
        $this->data['userData'] = $this->request->userData;
        $model = model(LearningInterventionModel::class);
        $intervention = $model->find($id);
        $this->data['intervention'] = $intervention;

        $this->data['title'] = 'LD Planner | Edit Learning Intervention';

        if ($intervention === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Learning Intervention with ID $id not found.");
        }

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention', $this->data) .
            view('includes/footer');
    }

    public function update($id) {
        $this->data['userData'] = $this->request->userData;
        $model = model(LearningInterventionModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_intervention', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $model->update($id, $validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Learning Intervention updated successfully.");
        return redirect('ldm.learning.intervention');
    }

    public function delete($id) {
        $this->data['userData'] = $this->request->userData;
        $model = new LearningInterventionModel();
        $model->delete($id);

        return redirect('ldm.learning.intervention')->with('error', 'Learning Intervention deleted successfully.');
    }
}

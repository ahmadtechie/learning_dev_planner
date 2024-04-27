<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Models\CompetencyModel;
use App\Models\DevelopmentCycleModel;
use App\Models\EmployeeModel;
use App\Models\InterventionTypeModel;
use App\Models\LearningInterventionModel;
use App\Models\UserRoleModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

helper(['form', 'url']);

class LearningInterventionController extends BaseController
{
    public array $data;
    public LearningInterventionModel $learningInterventionModel;
    public UserRoleModel $userRoleModel;
    public CompetencyModel $competencyModel;
    public DevelopmentCycleModel $cycleModel;
    public InterventionTypeModel $interventionTypeModel;
    public EmployeeModel $employeeModel;
    public array $validation = [
        'intervention_name' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'An intervention name must be provided.',
            ],
        ],
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
        $this->learningInterventionModel = model(LearningInterventionModel::class);
        $this->userRoleModel = model(UserRoleModel::class);
        $this->cycleModel = model(DevelopmentCycleModel::class);
        $this->competencyModel = model(CompetencyModel::class);
        $this->interventionTypeModel = model(InterventionTypeModel::class);
        $this->employeeModel = model(EmployeeModel::class);
        $trainerRoleId = $this->userRoleModel->where('name', 'Trainer')->first()['id'];

        $this->data = [
            'title' => 'Learning Intervention | LD Planner',
            'competencies' => $this->competencyModel->findAll(),
            'cycles' => $this->cycleModel->orderBy('cycle_year')->findAll(),
            'intervention_types' => $this->interventionTypeModel->findAll(),
            'trainers' => $this->employeeModel->getTrainerEmployeesDetails($trainerRoleId),
            'page_name' => 'Learning Intervention',
            'learningInterventions' => $this->learningInterventionModel->orderBy('created_at', 'DESC')->findAll(),
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
                view('forms/create_intervention', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $intervention_id = $this->learningInterventionModel->generateUniqueInterventionID();
        $this->learningInterventionModel->insert(array_merge($validData, ['intervention_id' => $intervention_id]));
        return redirect('ldm.learning.intervention')->with('success', "New Learning Intervention created successfully.");
    }

    public function edit($id): string
    {
        $this->data['userData'] = $this->request->userData;
        $intervention = $this->learningInterventionModel->find($id);
        $this->data['intervention'] = $intervention;

        $this->data['title'] = 'LD Planner | Edit Learning Intervention';

        if ($intervention === null) {
            throw new PageNotFoundException("Learning Intervention with ID $id not found.");
        }
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_intervention', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($id) {
        $this->data['userData'] = $this->request->userData;
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
        $this->learningInterventionModel->update($id, $validData);
        return redirect('ldm.learning.intervention')->with('success', "Learning Intervention updated successfully.");
    }

    public function delete(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $learning_intervention_id = $this->request->getVar('learning_intervention_id');
        $this->learningInterventionModel->delete($learning_intervention_id);
        return redirect('ldm.learning.intervention')->with('error', 'Learning Intervention deleted successfully.');
    }
}

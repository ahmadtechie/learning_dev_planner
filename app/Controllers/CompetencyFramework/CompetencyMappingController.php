<?php

namespace App\Controllers\CompetencyFramework;

use App\Controllers\BaseController;
use App\Models\CompetencyModel;
use App\Models\JobCompetencyModel;
use App\Models\JobModel;

helper(['form', 'url']);

class CompetencyMappingController extends BaseController
{

    public array $data;
    public array $validation = [
        'job_id' => [
            'rules' => 'required|numeric|validateJobCompetencyUnique[job_competencies.job_id]',
            'errors' => [
                'numeric' => 'A job role must be selected!',
                'validateJobCompetencyUnique' => 'A job competency with this name already registered',
            ]
        ],
        'competency_ids' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'At least one competency must be selected',
            ],
        ]
    ];

    function __construct()
    {
        $this->data = [
            'title' => 'Competency-Job Mapping Page | LD Planner',
            'page_name' => 'map competencies',
        ];
        $jobModel = model(JobModel::class);
        $competencyModel = model(CompetencyModel::class);
        $jobCompetencyModel = new JobCompetencyModel();
        $this->data['jobs'] = $jobModel->orderBy('created_at', 'DESC')->findAll();
        $this->data['competencies'] = $competencyModel->orderBy('created_at', 'DESC')->findAll();
        $this->data['jobCompetencies'] = $jobCompetencyModel->getJobsWithCompetencies();
    }

    public function index()
    {
        $this->data['userData'] = $this->request->userData;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/map_competencies', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;

        $model = model(JobCompetencyModel::class);
        $jobModel = model(JobModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/map_competencies', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $jobId = $this->request->getPost('job_id');
        $competencyIds = $this->request->getPost('competency_ids');

        foreach ($competencyIds as $competencyId) {
            $model->insert([
                'job_id' => $jobId,
                'competency_id' => $competencyId,
            ]);
        }
        $job = $jobModel->find($jobId);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Competencies mapped with Job '{$job['job_title']}' role successfully.");

        return redirect('ldm.competencies.mapping');
    }

    public function edit($id)
    {
        $this->data['userData'] = $this->request->userData;
//        TODO: With the ID, fetch all rows matching the given job_id
        $jobCompetencyModel = new JobCompetencyModel();
        $jobModel = new JobModel();
        $this->data['job_competencies'] = $jobCompetencyModel->getCompetenciesForJob($id);
        $this->data['job'] = $jobModel->find($id);

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/map_competencies', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($id)
    {
        $this->data['userData'] = $this->request->userData;
        $this->validation['job_id']['rules'] = 'required|numeric';
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/map_competencies', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $competencyIds = $this->request->getPost('competency_ids');

        // Perform the update operation
        $jobCompetencyModel = new JobCompetencyModel();
        if ($jobCompetencyModel->updateJobCompetencies($id, $competencyIds)) {
            // Update successful
            return redirect()->to(url_to('ldm.competencies.mapping'))->with('success', 'Job competencies updated successfully.');
        }
        // Update failed
        return redirect()->back()->withInput()->with('error', 'Failed to update job competencies. Please try again.');
    }

    public function delete($id)
    {
        $this->data['userData'] = $this->request->userData;

        $jobCompetencyModel = new JobCompetencyModel();
        $jobCompetencyModel->where('job_id', $id)->delete();

        $session = \Config\Services::session();
        $session->setFlashdata('deleted', "Job Competencies deleted successfully.");

        return redirect('ldm.competencies.mapping');
    }
}

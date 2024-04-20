<?php

namespace App\Controllers\CompetencyFramework;

use App\Controllers\BaseController;
use App\Models\CompetencyModel;
use App\Models\JobCompetencyModel;
use App\Models\JobModel;
use CodeIgniter\HTTP\RedirectResponse;

helper(['form', 'url']);

class CompetencyMappingController extends BaseController
{

    public array $data;
    public JobModel $jobModel;
    public CompetencyModel $competencyModel;
    public JobCompetencyModel $jobCompetencyModel;

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
        $this->jobModel = model(JobModel::class);
        $this->competencyModel = model(CompetencyModel::class);
        $this->jobCompetencyModel = new JobCompetencyModel();
        $this->data['jobs'] = $this->jobModel->orderBy('created_at', 'DESC')->findAll();
        $this->data['competencies'] = $this->competencyModel->orderBy('created_at', 'DESC')->findAll();
        $this->data['jobCompetencies'] = $this->jobCompetencyModel->getJobsWithCompetencies();
    }

    public function index(): string
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
            $this->jobCompetencyModel->insert([
                'job_id' => $jobId,
                'competency_id' => $competencyId,
            ]);
        }
        $job = $this->jobModel->find($jobId);
        return redirect('ldm.competencies.mapping')->with('success', "Competencies mapped with Job '{$job['job_title']}' role successfully.");
    }

    public function edit($job_id): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['job_competencies'] = $this->jobCompetencyModel->getCompetenciesForJob($job_id);
        $this->data['job'] = $this->jobModel->find($job_id);

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
        if ($this->jobCompetencyModel->updateJobCompetencies($id, $competencyIds)) {
            return redirect()->to(url_to('ldm.competencies.mapping'))->with('success', 'Job competencies updated successfully.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to update job competencies. Please try again.');
    }

    public function delete(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $job_id = $this->request->getVar('job_id');
        $this->jobCompetencyModel->where('job_id', $job_id)->delete();
        return redirect('ldm.competencies.mapping')->with('deleted', "Job Competencies deleted successfully.");
    }
}

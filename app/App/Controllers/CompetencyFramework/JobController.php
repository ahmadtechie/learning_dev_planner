<?php

namespace App\Controllers\CompetencyFramework;

use App\Controllers\BaseController;
use App\Models\JobModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Exceptions\PageNotFoundException;
use ReflectionException;

helper(['form']);

class JobController extends BaseController
{
    public array $data;
    public JobModel $jobModel;
    public array $validation = [
        'job_title' => [
            'rules' => 'required|min_length[3]|validateJobUnique[job.job_title]',
            'errors' => [
                'required' => 'Job title must be provided',
                'min_length' => 'Job title must be at least 3 characters.',
                'validateJobUnique' => 'A job with this name already registered'
            ]
        ],
    ];

    function __construct()
    {
        $this->jobModel = new JobModel();
        $jobs = $this->jobModel->orderBy('created_at', 'DESC')->findAll();

        $this->data = [
            'title' => 'Job Page | LD Planner',
            'jobs' => $jobs,
            'page_name' => 'jobs',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_job') .
            view('includes/footer');
    }

    /**
     * @throws ReflectionException
     */
    public function create()
    {

        $this->data['title'] = 'Create Job | LD Planner';
        $this->data['userData'] = $this->request->userData;

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_job', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $this->jobModel->save($validData);
        return redirect()->to(url_to('ldm.jobs'))->with('message', 'Job created successfully.');
    }

    public function edit($id)
    {
        $job = $this->jobModel->find($id);

        $this->data['userData'] = $this->request->userData;

        if ($job === null) {
            throw new PageNotFoundException("Job with ID $id not found.");
        }

        $this->data['title'] = 'Edit Job | LD Planner';
        $this->data['job'] = $job;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_job', $this->data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $this->data['userData'] = $this->request->userData;
        $this->validation['job_title']['rules'] = 'required|min_length[3]';

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_job', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $this->jobModel->update($id, $validData);
        session()->setFlashdata('success', "Job {$validData['job_title']} edited successfully.");
        return redirect()->to(url_to('ldm.jobs'));
    }

    public function delete()
    {
        $this->data['userData'] = $this->request->userData;
        $job_id = $this->request->getVar('job_id');
        $this->jobModel->delete($job_id);
        session()->setFlashdata('deleted', "Job deleted successfully.");
        return redirect()->to(url_to('ldm.jobs'));
    }
}

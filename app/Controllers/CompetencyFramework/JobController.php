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
    public array $validation = [
        'job_title' => [
            'rules' => 'required|min_length[3]|validateJobUnique[job.job_title]',
            'errors' => [
                'required' => 'Job title must be provided',
                'min_length' => 'Job title must be at least 3 characters.',
                'validateJobUnique' => 'A job with this name already registered'
            ]
        ],
        'qualifications' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Qualifications must be provided',
            ],
        ]
    ];

    function __construct()
    {
        $jobModel = new JobModel();
        $jobs = $jobModel->orderBy('created_at', 'DESC')->findAll();

        $this->data = [
            'title' => 'Job Page | LD Planner',
            'jobs' => $jobs,
            'page_name' => 'jobs',
        ];
    }

    public function index(): string
    {
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
        $jobModel = new JobModel();

        $this->data['title'] = 'Create Job | LD Planner';

        if (!$this->validate($this->validation)) {
            // Validation failed
            $validation = ['validation' =>$this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_job', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        // Validation successful
        $validData = $this->validator->getValidated();

        $jobModel->save($validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Job {$validData['job_title']} created successfully.");
        return redirect()->to(url_to('ldm.jobs'));
    }

    public function edit($id)
    {
        $jobModel = new JobModel();
        $job = $jobModel->find($id);


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
        $jobModel = new JobModel();
        $this->validation['job_title']['rules'] = 'required|min_length[3]';

        if (!$this->validate($this->validation)) {
            // Validation failed
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_job', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        // Validation successful
        $validData = $this->request->getPost();

        $jobModel->update($id, $validData);
        $session = \Config\Services::session();
        $session->setFlashdata('success', "Job {$validData['job_title']} edited successfully.");
        return redirect()->to(url_to('ldm.jobs'));
    }

    public function delete($id)
    {
        $jobModel = new JobModel();
        $jobModel->delete($id);
        $session = \Config\Services::session();
        $session->setFlashdata('deleted', "Job deleted successfully.");
        return redirect()->to(url_to('ldm.jobs'));
    }


}

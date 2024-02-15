<?php

    namespace App\Controllers\CompetencyFramework;

use App\Controllers\BaseController;
use App\Models\JobModel;

helper(['form']);

class JobController extends BaseController
{
    public function index(): string
    {
        $jobModel = model(JobModel::class);
        $jobs = $jobModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Job Page | LD Planner',
            'jobs' => $jobs,
        ];

        return view('includes/head') .
            view('includes/sidebar') .
            view('includes/nav') .
            view('forms/create_job', $data) .
            view('includes/footer');
    }

    public function create()
    {
        $model = model(JobModel::class);

        if (!$this->validate([
            'job_title' => 'required|min_length[3]',
            'qualifications' => 'required',
        ])) {
            $errors = [
                'errors' => $this->validator->getError(),
            ];
            return view('includes/head') .
                view('includes/sidebar') .
                view('includes/nav') .
                view('forms/create_job', $errors) .
                view('includes/footer');
        }

        // Validation successful
        $validData = $this->validator->getValidated();

        $model->save([
            'job_title' => $validData['job_title'],
            'qualifications' => $validData['qualifications'],
        ]);

        return redirect('ldm.jobs');
    }

    public function edit($id)
    {
        $jobModel = model(JobModel::class);
        $job = $jobModel->find($id);
        $jobs = $jobModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'job' => $job,
            'jobs' => $jobs,
        ];

        if ($job === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Job with ID $id not found.");
        }

        return view('includes/head') .
            view('includes/sidebar') .
            view('includes/nav') .
            view('forms/edit_job', $data) .
            view('includes/footer');
    }

    public function update($id)
    {
        $model = new JobModel();

        if (!$this->validate([
            'job_title' => 'required|min_length[3]',
            'qualifications' => 'required',
        ])) {
            $errors = [
                'errors' => $this->validator->getError(),
            ];
            return view('includes/head') .
                view('includes/sidebar') .
                view('includes/nav') .
                view('forms/edit_job', $errors) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();

        $model->update($id, $validData);

        return redirect('ldm.jobs');
    }

    public function delete($id)
    {
        $model = new JobModel();

        $model->delete($id);

        return redirect('ldm.jobs');
    }
}

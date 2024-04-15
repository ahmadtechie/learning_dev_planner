<?php

namespace App\Controllers\Trainer;

use App\Controllers\BaseController;
use App\Models\InterventionVendorModel;
use App\Models\LearningInterventionModel;

helper(['form', 'url']);

class VendorController extends BaseController
{
    public array $data;
    public array $validation = [
        'intervention_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'An intervention must be selected!',
            ]
        ],
        'vendor_name' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Vendor name must be provided!',
                'min_length' => 'Vendor name must be at least 3 characters.',
            ],
        ],
        'contact_person' => 'permit_empty|max_length[255]',
        'contact_email' => [
            'rules' => 'permit_empty|valid_email|max_length[255]',
            'errors' => [
                'valid_email' => 'Valid email is expected'
            ]
        ],
        'contact_phone' => 'permit_empty|max_length[20]',
        'service_provided' => 'permit_empty|max_length[255]',
    ];

    function __construct()
    {
        $model = model(InterventionVendorModel::class);
        $interventionModel = model(LearningInterventionModel::class);
        $this->data = [
            'title' => 'Intervention Vendors | LD Planner',
            'interventions' => $interventionModel->findAll(),
            'page_name' => 'Intervention Vendors',
            'interventionVendors' => $model->orderBy('created_at', 'DESC')->findAll(),
        ];
    }
    public function index()
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_vendor', $this->data) .
            view('includes/footer');
    }

    public function create() {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionVendorModel::class);
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_vendor', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->validator->getValidated();
        $model->save($validData);
        $session = \Config\Services::session();
        $session->setFlashdata('success', "Vendor/Trainer {$validData['vendor_name']} created successfully.");
        return redirect('ldm.trainer');
    }

    public function edit($id) {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionVendorModel::class);
        $intervention_vendor = $model->find($id);
        $this->data['vendor'] = $intervention_vendor;
        $this->data['title'] = 'LD Planner | Edit Intervention Vendor';

        if ($intervention_vendor === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Intervention Vendor with ID $id not found.");
        }

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_vendor', $this->data) .
            view('includes/footer');
    }

    public function update($id) {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionVendorModel::class);

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_vendor', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $model->update($id, $validData);

        $session = \Config\Services::session();
        $session->setFlashdata('success', "Intervention Vendor {$validData['vendor_name']} updated successfully.");
        return redirect('ldm.trainer');
    }

    public function delete($id) {
        $this->data['userData'] = $this->request->userData;
        $model = model(InterventionVendorModel::class);
        $model->delete($id);
        return redirect('ldm.trainer')->with('error', 'Intervention vendor deleted successfully.');
    }
}

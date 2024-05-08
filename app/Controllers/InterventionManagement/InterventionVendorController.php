<?php

namespace App\Controllers\InterventionManagement;

use App\Controllers\BaseController;
use App\Models\InterventionVendorModel;
use App\Models\LearningInterventionModel;
use CodeIgniter\Exceptions\PageNotFoundException;

helper(['form', 'url']);

class InterventionVendorController extends BaseController
{
    public array $data;
    public InterventionVendorModel $interventionVendorModel;
    public LearningInterventionModel $interventionModel;
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
        $this->interventionVendorModel = model(InterventionVendorModel::class);
        $this->interventionModel = model(LearningInterventionModel::class);
        $this->data = [
            'title' => 'Intervention Vendors | LD Planner',
            'interventions' => $this->interventionModel->findAll(),
            'page_name' => 'Intervention Vendors',
            'interventionVendors' => $this->interventionVendorModel->orderBy('created_at', 'DESC')->findAll(),
        ];
    }
    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_vendor', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create() {
        $this->data['userData'] = $this->request->userData;
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
        $this->interventionVendorModel->save($validData);
        return redirect('ldm.vendor')->with('success', "Vendor/Trainer {$validData['vendor_name']} created successfully.");
    }

    public function edit($id): string
    {
        $this->data['userData'] = $this->request->userData;
        $intervention_vendor = $this->interventionVendorModel->find($id);
        $this->data['vendor'] = $intervention_vendor;
        $this->data['title'] = 'LD Planner | Edit Intervention Vendor';

        if ($intervention_vendor === null) {
            throw new PageNotFoundException("Intervention Vendor with ID $id not found.");
        }
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_vendor', $this->data) .
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
                view('forms/create_vendor', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $this->interventionVendorModel->update($id, $validData);
        return redirect('ldm.vendor')->with('success', "Intervention Vendor {$validData['vendor_name']} updated successfully.");
    }

    public function delete() {
        $this->data['userData'] = $this->request->userData;
        $intervention_vendor_id = $this->request->getVar('intervention_vendor_id');
        $this->interventionVendorModel->delete($intervention_vendor_id);
        return redirect('ldm.vendor')->with('error', 'Intervention vendor deleted successfully.');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class EmployeeCSVController extends BaseController
{
    public array $data;
    public array $validation = [
        'employee_csv' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Employee CSV file must be uploaded',
            ]
        ],
    ];

    function __construct() {
        $employeeModel = model(EmployeeModel::class);
        $userModel = model(UserModel::class);

        $this->data = [
            'title' => 'Employee Bulk Upload Page | LD Planner',
            'page_name' => 'Employee Bulk Upload',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/bulk_upload', $this->data) .
            view('includes/footer');
    }

    public function downloadTemplate()
    {
        // Define column headers for the CSV template
        $columns = ['email', 'first_name', 'last_name', 'job', 'employee_roles', 'department', 'unit', 'line_manager'];

        // Initialize CSV data
        $csvData = implode(',', $columns) . "\n";
        $filename = 'employee_bulk_upload_template.csv';

        // Set headers to force file download
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Output the CSV data
        echo $csvData;
        exit;
    }

    public function previewUpload()
    {
        $this->data['userData'] = $this->request->userData;

        // Retrieve uploaded CSV file
        $uploadedFile = $this->request->getFile('csv_file');

        // Check if file is uploaded successfully
        if ($uploadedFile->isValid() && $uploadedFile->getExtension() === 'csv') {
            // Parse CSV data
            $csvData = array_map('str_getcsv', file($uploadedFile->getTempName()));

            // Initialize arrays to store validated data and validation errors
            $validatedData = [];
            $validationErrors = [];

            // Iterate through each row of CSV data
            foreach ($csvData as $rowNumber => $rowData) {
                if ($rowNumber === 0) {
                    continue;
                }

                // Validate row data
                $validationResult = $this->validateRow($rowData);
                if ($validationResult['success']) {
                    $validatedData[] = $validationResult['data'];
                } else {
                    $validationErrors[] = "Row {$rowNumber}: {$validationResult['message']}";
                }
            }

            // Pass data to the view for display
            return view('forms/bulk_upload', [
                'data' => $validatedData,
                'errors' => $validationErrors
            ]);
        } else {
            // Handle invalid file format or upload failure
            return redirect()->back()->with('error', 'Invalid file format. Please upload a CSV file.');
        }
    }

    /**
     * Validate a single row of CSV data.
     *
     * @param array $rowData Row data from the CSV file
     * @return array Validation result (success, data, message)
     */
    private function validateRow(array $rowData): array
    {
        $this->data['userData'] = $this->request->userData;
        // Ensure correct number of columns
        if (count($rowData) !== 8) {
            return [
                'success' => false,
                'data' => null,
                'message' => 'Invalid number of columns.'
            ];
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'first_name' => 'required',
            'last_name' => 'required',
            'job' => 'required',
            'employee_roles' => 'required',
            'department' => 'required',
            'unit' => 'required',
            'line_manager' => 'required'
        ]);

        $validation->setData([
            'email' => $rowData[0],
            'first_name' => $rowData[1],
            'last_name' => $rowData[2],
            'job' => $rowData[3],
            'employee_roles' => $rowData[4],
            'department' => $rowData[5],
            'unit' => $rowData[6],
            'line_manager' => $rowData[7]
        ]);

        if (!$validation->run()) {
            return [
                'success' => false,
                'data' => null,
                'message' => implode(', ', $validation->getErrors())
            ];
        }

        return [
            'success' => true,
            'data' => [
                'email' => $rowData[0],
                'first_name' => $rowData[1],
                'last_name' => $rowData[2],
                'job' => $rowData[3],
                'employee_roles' => $rowData[4],
                'department' => $rowData[5],
                'unit' => $rowData[6],
                'line_manager' => $rowData[7]
            ],
            'message' => ''
        ];
    }

}

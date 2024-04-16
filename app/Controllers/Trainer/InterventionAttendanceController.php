<?php

namespace App\Controllers\Trainer;

use App\Controllers\BaseController;

helper(['form', 'url']);

class InterventionAttendanceController extends BaseController
{
    public array $data;
    public array $validation = [
        'attendance_csv' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Attendance CSV file must be uploaded',
            ]
        ],
    ];

    function __construct()
    {
        $this->data = [
            'title' => 'Attendance Bulk Upload Page | LD Planner',
            'page_name' => 'Attendance Bulk Upload',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/attendance_upload', $this->data) .
            view('includes/footer');
    }

    public function format()
    {
        $columns = ['employee_username', 'intervention_id', 'attendance_date', 'attendance_status', 'session_duration', 'remarks'];
        $csvData = implode(',', $columns) . "\n";
        $filename = 'intervention_attendance_bulk_upload_template.csv';

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo $csvData;
        exit;
    }

    public function previewUpload()
    {
        $this->data['userData'] = $this->request->userData;
        $uploadedFile = $this->request->getFile('attendance_csv');

        if ($uploadedFile->isValid() && $uploadedFile->getExtension() === 'csv') {
            $csvData = array_map('str_getcsv', file($uploadedFile->getTempName()));

            $headers = [];
            $validatedData = [];
            $validationErrors = [];

            foreach ($csvData as $rowNumber => $rowData) {
                if ($rowNumber === 0) {
                    $headers = $rowData;
                    continue;
                }

                $row = [];

                foreach ($rowData as $index => $value) {
                    $header = $headers[$index] ?? 'unknown';
                    $row[$header] = $value;
                }

                $validationResult = $this->validateRow($row);

                if ($validationResult['success']) {
                    $validatedData[] = $validationResult['data'];
                } else {
                    $validationErrors[] = "Row {$rowNumber}: {$validationResult['message']}";
                }
            }
            $this->data['data'] = $validatedData;
            $this->data['errors'] = $validationErrors;
            $this->data['uploadedFile'] = base64_encode(file_get_contents($uploadedFile->getTempName()));
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/attendance_upload', $this->data) .
                view('includes/footer');
        } else {
            return redirect()->back()->with('error', 'Invalid file format. Please upload a CSV file.');
        }
    }

    private function validateRow(array $rowData): array
    {
        if (count($rowData) !== 6) {
            return [
                'success' => false,
                'data' => null,
                'message' => 'Invalid number of columns.'
            ];
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'employee_username' => 'required',
            'intervention_id' => 'required',
            'attendance_date' => 'required',
            'attendance_status' => 'required',
            'session_duration' => 'required',
        ]);

        if (!$validation->run($rowData)) {
            return [
                'success' => false,
                'data' => null,
                'message' => implode(', ', $validation->getErrors())
            ];
        }

        return [
            'success' => true,
            'data' => [
                'employee_id' => $rowData['employee_username'],
                'intervention_id' => $rowData['intervention_id'],
                'attendance_date' => $rowData['attendance_date'],
                'attendance_status' => $rowData['attendance_status'],
                'session_duration' => $rowData['session_duration'],
                'remarks' => $rowData['remarks'],
            ],
            'message' => ''
        ];
    }


    public function create()
    {

    }
}

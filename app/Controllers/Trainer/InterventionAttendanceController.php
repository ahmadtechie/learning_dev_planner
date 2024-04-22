<?php

namespace App\Controllers\Trainer;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\InterventionAttendanceModel;
use App\Models\LearningInterventionModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use DateTime;

helper(['form', 'url']);

class InterventionAttendanceController extends BaseController
{
    public array $data;
    public UserModel $userModel;
    public EmployeeModel $employeeModel;
    public LearningInterventionModel $interventionModel;
    public InterventionAttendanceModel $interventionAttendanceModel;
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
        $this->interventionAttendanceModel = model(InterventionAttendanceModel::class);
        $this->userModel = model(UserModel::class);
        $this->employeeModel = model(EmployeeModel::class);
        $this->interventionModel = model(LearningInterventionModel::class);
        $this->data = [
            'title' => 'Attendance Bulk Upload Page | LD Planner',
            'all_attendance' => $this->interventionAttendanceModel->orderBy('updated_at', 'DESC')->findAll(),
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
        $columns = ['employee_username', 'intervention_id', 'attendance_date', 'attendance_status', 'remarks'];
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
        if (count($rowData) !== 5) {
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
            'remarks' => 'permit_empty'
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
                'employee_username' => $rowData['employee_username'],
                'intervention_id' => $rowData['intervention_id'],
                'attendance_date' => $rowData['attendance_date'],
                'attendance_status' => $rowData['attendance_status'],
                'remarks' => $rowData['remarks'],
            ],
            'message' => ''
        ];
    }


    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        $encodedData = $this->request->getPost('encoded_data');
        $decodedData = base64_decode($encodedData);
        $tempFilePath = WRITEPATH . 'uploads/attendance_temp_file.csv';

        try {
            file_put_contents($tempFilePath, $decodedData);
        } catch (\Exception $e) {
            return redirect()->to(url_to('ldm.employee.upload'))->with('error', 'Unable to upload the csv file now. Try again!');
        }
        $uploadedFile = new UploadedFile($tempFilePath, true);

        if ($uploadedFile->getExtension() === 'csv') {
            $csvData = array_map('str_getcsv', file($uploadedFile->getTempName()));

            $successCount = 0;
            $errorCount = 0;
            $errors = [];

            foreach ($csvData as $rowNumber => $rowData) {
                if ($rowNumber === 0) continue;

                $employee_username = $rowData[0];
                $intervention_id = $rowData[1];
                $attendance_date = $rowData[2];
                $attendance_status = $rowData[3];
                $remarks = $rowData[4];

                try {
                    $user = $this->userModel->where('username', $employee_username)->first();
                    if (!$user) continue;
                    $intervention = $this->interventionModel->where('intervention_id', $intervention_id)->first();
                    if (!$intervention) continue;
                    $employeeData = $this->employeeModel->where('user_id', $user['id'])->first();
                    $attendanceData = $this->interventionAttendanceModel->where('employee_id', $employeeData['id'])->where('intervention_id', $intervention['id'])->first();
                    if (!$attendanceData) continue;
                    $this->interventionAttendanceModel->update($attendanceData['id'], ['attendance_date' => $attendance_date, 'attendance_status' => $attendance_status, 'remarks' => $remarks]);
                    $successCount++;
                } catch
                (\Exception $e) {
                    $errorCount++;
                    $errors[] = "Error on row {$rowNumber}: " . $e->getMessage();
                }
            }
            if ($successCount > 0) {
                session()->setFlashdata('success', "$successCount attendance updated successfully.");
            }
            if ($errorCount > 0) {
                session()->setFlashdata('error', "$errorCount errors occurred during attendance bulk upload.");
                session()->setFlashdata('bulk_upload_errors', $errors);
            }
            return redirect()->to(url_to('ldm.intervention.attendance'));
        } else {
            return redirect()->to('ldm.home');
        }
    }
}

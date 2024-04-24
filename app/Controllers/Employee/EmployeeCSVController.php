<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Helpers\EmailHelper;
use App\Models\DepartmentModel;
use App\Models\EmailTemplateModel;
use App\Models\EmployeeModel;
use App\Models\EmployeeRolesModel;
use App\Models\JobModel;
use App\Models\SiteSettingsModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use Config\Services;

helper(['form', 'url']);

class EmployeeCSVController extends BaseController
{
    public array $data;
    public EmployeeModel $employeeModel;
    public UserModel $userModel;
    public UserRoleModel $userRoleModel;
    public JobModel $jobModel;
    public DepartmentModel $departmentModel;
    public UnitModel $unitModel;
    public EmployeeRolesModel $employeeRolesModel;
    public EmailTemplateModel $emailTemplateModel;
    public SiteSettingsModel $siteSettingsModel;
    public EmailHelper $emailHelper;

    public array $validation = [
        'employee_csv' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Employee CSV file must be uploaded',
            ]
        ],
    ];

    function __construct()
    {
        $this->data = [
            'title' => 'Employee Bulk Upload Page | LD Planner',
            'page_name' => 'Employee Bulk Upload',
        ];
        $this->employeeModel = new EmployeeModel();
        $this->userModel = new UserModel();
        $this->userRoleModel = new UserRoleModel();
        $this->jobModel = new JobModel();
        $this->departmentModel = new DepartmentModel();
        $this->unitModel = new UnitModel();
        $this->employeeRolesModel = new EmployeeRolesModel();
        $this->emailTemplateModel = new EmailTemplateModel();
        $this->siteSettingsModel = new SiteSettingsModel();
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
        $columns = ['email', 'first_name', 'last_name', 'job', 'employee_roles', 'department', 'unit', 'line_manager_username'];
        $csvData = implode(',', $columns) . "\n";
        $filename = 'employee_bulk_upload_template.csv';

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo $csvData;
        exit;
    }

    public function previewUpload()
    {
        $this->data['userData'] = $this->request->userData;
        $uploadedFile = $this->request->getFile('employee_csv');

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
                view('forms/bulk_upload', $this->data) .
                view('includes/footer');
        } else {
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
        if (count($rowData) !== 8) {
            return [
                'success' => false,
                'data' => null,
                'message' => 'Invalid number of columns.'
            ];
        }

        $validation = Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'first_name' => 'required',
            'last_name' => 'required',
            'job' => 'required',
            'employee_roles' => 'required',
            'department' => 'required',
            'line_manager_username' => 'required'
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
                'email' => $rowData['email'],
                'first_name' => $rowData['first_name'],
                'last_name' => $rowData['last_name'],
                'job' => $rowData['job'],
                'employee_roles' => $rowData['employee_roles'],
                'department' => $rowData['department'],
                'unit' => $rowData['unit'],
                'line_manager_username' => $rowData['line_manager_username'],
            ],
            'message' => ''
        ];
    }

    /**
     * @throws \ReflectionException
     */
    public function bulkUpload()
    {
        $this->data['userData'] = $this->request->userData;
        $encodedData = $this->request->getPost('encoded_data');
        $decodedData = base64_decode($encodedData);
        $logger = service('logger');
        $tempFilePath = WRITEPATH . 'uploads/temp_file.csv';

        try {
            file_put_contents($tempFilePath, $decodedData);
            } catch (\Exception $e) {
            return redirect()->to(url_to('ldm.employee.upload'))->with('error', 'Unable to upload the csv file now. Try again!');
        }
        $uploadedFile = new UploadedFile($tempFilePath, true);

        if ($uploadedFile->getExtension() === 'csv') {
            $csvData = array_map('str_getcsv', file($uploadedFile->getTempName()));
            $csvEmails = array_column($csvData, 0);

            $siteName = $this->siteSettingsModel->first()["company_name"];
            $emailData = $this->emailTemplateModel->where('email_type', 'staff_created')->first();

            $successCount = 0;
            $errorCount = 0;
            $errors = [];

            foreach ($csvData as $rowNumber => $rowData) {
                if ($rowNumber === 0) continue;

                $user_email = $rowData[0];
                $first_name = $rowData[1];
                $last_name = $rowData[2];
                $job = $rowData[3];
                $employee_roles = $rowData[4];
                $department = $rowData[5];
                $unit = $rowData[6];
                $line_manager_username = $rowData[7];
                $password = $this->userModel->generateRandomPassword();
                $username = $this->userModel->generateUniqueRandomUsername();
                $roleNames = [];
                $login_url = url_to('ldm.login');

                if (strpos($employee_roles, ',') !== false) {
                    $roleNames = array_map('trim', explode(',', $employee_roles));
                } else {
                    $roleNames[] = $employee_roles;
                }

                try {
                    $is_user_exist = $this->userModel->where('email', $user_email)->first();
                    if ($is_user_exist) continue;
                    $userId = $this->userModel->insert([
                        'username' => $username,
                        'email' => $user_email,
                        'password' => password_hash($password, PASSWORD_BCRYPT),
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                    ]);
                    $data = ['job_title' => $job];
                    $job = $this->jobModel->getOrCreate('job_title', $job, $data);
                    $lineManagerUserData = $this->userModel->where('username', $line_manager_username)->first();
                    if ($lineManagerUserData) {
                        $lineMngEmployeeData = $this->employeeModel->where('user_id', $lineManagerUserData['id'])->first();
                        $lineManagerId = $lineMngEmployeeData['id'];
                    } else {
                        $lineManagerId = Null;
                    }
                    $employeeId = $this->employeeModel->insert([
                        'user_id' => $userId,
                        'job_id' => $job['id'],
                        'line_manager_id' => $lineManagerId,
                    ]);

                    foreach ($roleNames as $roleName) {
                        $role = $this->userRoleModel->where('name', $roleName)->first();

                        if ($role) {
                            $this->employeeRolesModel->insert([
                                'user_id' => $userId,
                                'role_id' => $role['id'],
                                'employee_id' => $employeeId,
                            ]);
                        } else {
                            $logger->warning($roleName . ' not found!');
                        }
                    }

                    $department_id = $this->departmentModel->where('department_name', $department)->first()['id'] ?? Null;
                    $unit_id = $this->unitModel->where('unit_name', $unit)->first()['id'] ?? Null;
                    $this->employeeModel->update($employeeId, ['department_id' => $department_id, 'unit_id' => $unit_id]);

                    // Send email to the new user
                    $find = ['{first_name}', '{username}', '{user_roles}', '{email}', '{password}', '{login_url}'];
                    $replace = [$first_name, $username, $employee_roles, $user_email, $password, $login_url];
                    $emailBody = str_replace($find, $replace, $emailData['email_body']);
                    $emailSubject = str_replace('{siteName}', $siteName, $emailData['email_subject']);
                    $this->emailHelper->send_email($user_email, $emailData["email_from"], $emailData['email_from_name'], $emailSubject, $emailBody);
                    $successCount++;
                } catch
                (\Exception $e) {
                    $errorCount++;
                    $errors[] = "Error on row {$rowNumber}: " . $e->getMessage();
                }
            }
            $existingEmails = $this->userModel->select('email')->whereIn('email', $csvEmails)->get()->getResultArray();
            $existingEmails = array_column($existingEmails, 'email');
            $emailsNotInCSV = array_diff($existingEmails, $csvEmails);
            $this->data['emailsNotInCSV'] = $emailsNotInCSV;

            if ($successCount > 0) {
                session()->setFlashdata('success', "$successCount employees added successfully.");
            }
            if ($errorCount > 0) {
                session()->setFlashdata('error', "$errorCount errors occurred during bulk upload.");
                session()->setFlashdata('bulk_upload_errors', $errors);
            }
            if ($successCount == 0 and $errorCount == 0) {
                session()->setFlashdata('success', "All employee data has previously been registered.");
            }
            return redirect()->to(url_to('ldm.employee.upload'));
        } else {
            return redirect()->to('ldm.home');
        }
    }
}

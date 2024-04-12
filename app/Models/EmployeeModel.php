<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = ['user_id', 'job_id', 'line_manager_id', 'department_id', 'unit_id', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function user()
    {
        return $this->belongsTo('UserModel', 'user_id');
    }

    public function job()
    {
        return $this->belongsTo('JobModel', 'job_id');
    }

    public function line_manager()
    {
        return $this->belongsTo('UserModel', 'line_manager_id');
    }


    public function getAllEmployeesWithUserDetails(): array
    {
        // Select employee details along with user details, department, unit, and concatenated role IDs
        $employees = $this->select('employee.id AS employee_id, employee.*, user.*, IFNULL(GROUP_CONCAT(role.name), "") AS user_roles, department.department_name, unit.unit_name')
            ->join('user', 'user.id = employee.user_id')
            ->join('employee_roles', 'employee_roles.user_id = user.id', 'left')
            ->join('role', 'role.id = employee_roles.role_id', 'left')
            ->join('department', 'department.id = employee.department_id', 'left')
            ->join('unit', 'unit.id = employee.unit_id', 'left')
            ->withDeleted()
            ->groupBy('employee.id')
            ->findAll();

        foreach ($employees as &$employee) {
            $employee['user_roles'] = !empty($employee['user_roles']) ? $employee['user_roles'] : '';
        }

        return $employees;
    }

    public function getEmployeeDetailsWithUser(int $employeeId)
    {
        return $this->select('employee.id AS employee_id, employee.*, user.*, job.job_title as job_title, CONCAT(line_manager.first_name, " ", line_manager.last_name) as line_manager_name')
            ->join('user', 'user.id = employee.user_id')
            ->join('job', 'job.id = employee.job_id')
            ->join('user as line_manager', 'line_manager.id = employee.line_manager_id', 'left')
            ->where('employee.id', $employeeId)
            ->first();
    }

    public function getUnAssignedEmployeeDetailsWithUser(): array
    {
        return $this->select('employee.id AS employee_id, employee.*, user.*, job.job_title as job_title, CONCAT(line_manager.first_name, " ", line_manager.last_name) as line_manager_name')
            ->join('user', 'user.id = employee.user_id')
            ->join('job', 'job.id = employee.job_id')
            ->join('user as line_manager', 'line_manager.id = employee.user_id', 'left')
            ->where('employee.line_manager_id = 0')
            ->findAll();
    }

    public function getAllLineManagers(): array
    {
        $roleModel = model(UserRoleModel::class);
        $line_manager_role_id = $roleModel->where('name', 'LineManager')->first()['id'];

        return $this->select('employee.id AS employee_id, employee.*, user.*, job.job_title as job_title')
            ->join('user', 'user.id = employee.user_id')
            ->join('job', 'job.id = employee.job_id')
            ->join('employee_roles', 'employee_roles.employee_id = employee.id')
            ->where('employee_roles.role_id', $line_manager_role_id)
            ->findAll();
    }

    public function getEmployeesUnderLineManager(int $lineManagerId): array
    {
        return $this->select('employee.*, user.*',)
            ->join('user', 'user.id = employee.user_id')
            ->where('employee.line_manager_id', $lineManagerId)
            ->findAll();
    }

    public function getCompetenciesForEmployeeJob($employeeId): array
    {
        $employee = $this->find($employeeId);
        $jobId = $employee['job_id'];
        $jobCompetencyModel = new JobCompetencyModel();
        return $jobCompetencyModel->getCompetenciesForJob($jobId);
    }

    /**
     * @throws \ReflectionException
     */
    public function restoreEmployee($employeeId)
    {
        // Attempt to find the soft-deleted employee
        $employee = $this->onlyDeleted()->find($employeeId);

        if (!$employee) {
            return false; // Employee not found or not soft-deleted
        }

        // Restore the soft-deleted employee by setting the 'deleted_at' field to NULL
        return $this->update($employeeId, ['deleted_at' => null]);
    }
}


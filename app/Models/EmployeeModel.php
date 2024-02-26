<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employee';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'job_id', 'line_manager_id', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

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
        // Load UserRoleModel
        $userRoleModel = model(UserRoleModel::class);

        // Select employee details along with user details and concatenated role IDs
        $employees = $this->select('employee.*, user.*, GROUP_CONCAT(role.name) AS user_roles')
            ->join('user', 'user.id = employee.user_id')
            ->join('employee_roles', 'employee_roles.user_id = user.id')
            ->join('role', 'role.id = employee_roles.role_id') // Join role table to get role names
            ->groupBy('employee.id') // Group by employee ID to avoid duplicate rows
            ->findAll();

        // Convert comma-separated role names to arrays
        foreach ($employees as &$employee) {
            $employee['user_roles'] = explode(',', $employee['user_roles']);
        }

        return $employees;
    }

    public function getEmployeeDetailsWithUser(int $employeeId)
    {
        return $this->select('employee.*, user.*, job.job_title as job_title, CONCAT(line_manager.first_name, " ", line_manager.last_name) as line_manager_name')
            ->join('user', 'user.id = employee.user_id')
            ->join('job', 'job.id = employee.job_id')
            ->join('user as line_manager', 'line_manager.id = employee.line_manager_id', 'left')
            ->where('employee.id', $employeeId)
            ->first();
    }
}

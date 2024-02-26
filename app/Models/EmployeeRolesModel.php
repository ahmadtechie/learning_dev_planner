<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeRolesModel extends Model
{
    protected $table            = 'employee_roles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['employee_id', 'user_id', 'role_id', 'created_at', 'updated_at', 'deleted_at'];

    protected bool $allowEmptyInserts = false;

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

    public function employee()
    {
        return $this->belongsTo('EmployeeModel', 'employee_id');
    }

    public function role()
    {
        return $this->belongsTo('UserRoleModel', 'role_id');
    }

    public function user()
    {
        return $this->belongsTo('UserModel', 'user_id');
    }

    public function getAllLineManagersWithUser(): array
    {
        $userRoleModel = model(UserRoleModel::class);
        $line_manager_role_id = $userRoleModel->where('name', 'LineManager')->first()['id'];

        return $this->select('employee_roles.*, user.*')
            ->join('user', 'user.id = employee_roles.user_id')
            ->where('employee_roles.role_id', $line_manager_role_id)
            ->findAll();
    }
}

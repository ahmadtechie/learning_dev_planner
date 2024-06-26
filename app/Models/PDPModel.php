<?php

namespace App\Models;

use CodeIgniter\Model;

class PDPModel extends Model
{
    protected $table = 'personal_development_plan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = ['employee_id', 'line_manager_id', 'cycle_id', 'competency_id', 'average_rating', 'employee_signed_off', 'line_manager_signed_off', 'created_at', 'updated_at', 'deleted_at'];

    protected bool $allowEmptyInserts = false;

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

    public function getUniqueEmployeeIds()
    {
        $query = $this->distinct()->select('employee_id')->findAll();
        return array_column($query, 'employee_id');
    }

    public function completedCyclesCount($employeeId)
    {
        return $this
            ->where('employee_id', $employeeId)
            ->where('employee_signed_off', 1)
            ->groupBy('employee_id')
            ->countAllResults('cycle_id');
    }

    public function activeCycleCompletedRatingsCount($activeCycleId)
    {
        return $this
            ->where('cycle_id', $activeCycleId)
            ->groupBy('employee_id')
            ->countAllResults();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeInterventionsModel extends Model
{
    protected $table            = 'employee_interventions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['employee_id', 'intervention_id', 'created_at', 'updated_at', 'deleted_at'];

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

    public function getEmployeeInterventions(int $employeeId): ?string
    {
        $employeeInterventions = $this->select('intervention_id')
            ->where('employee_id', $employeeId)
            ->findAll();

        if (!empty($employeeInterventions)) {
            $interventionIds = array_column($employeeInterventions, 'intervention_id');

            $interventionModel = new LearningInterventionModel();
            $interventions = $interventionModel->select('intervention_name')
                ->whereIn('id', $interventionIds)
                ->findAll();

            $interventionNames = array_column($interventions, 'intervention_name');
            return implode(',', $interventionNames);
        }

        return null;
    }
}

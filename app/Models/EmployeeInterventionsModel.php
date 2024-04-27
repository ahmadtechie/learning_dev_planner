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
    protected $allowedFields    = ['employee_id', 'intervention_id', 'class_id', 'cycle_id', 'created_at', 'updated_at', 'deleted_at'];

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

    public function getEmployeesWithoutIntervention($intervention_id, $cycle_id): array
    {
        // Subquery to get employee IDs with the intervention
        $subQuery = $this->db->table('employee_interventions')
            ->select('employee_id')
            ->where('intervention_id', $intervention_id)
            ->where('cycle_id', $cycle_id)
            ->groupBy('employee_id')
            ->get();

        $employeeIdsWithIntervention = array_column($subQuery->getResultArray(), 'employee_id');

        $interventionModel = model(LearningInterventionModel::class);
        $selectedInterventionData = $interventionModel->find($intervention_id);
        $competency_id = $selectedInterventionData['competency_id'];

        $query = $this->db->table('employee')
            ->join('job_competencies', 'job_competencies.job_id = employee.job_id')
            ->where('job_competencies.competency_id', $competency_id);

        if (!empty($employeeIdsWithIntervention)) {
            $query->whereNotIn('employee.id', $employeeIdsWithIntervention);
        }

        return $query->get()->getResultArray();
    }
}

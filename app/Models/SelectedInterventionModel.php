<?php

namespace App\Models;

use CodeIgniter\Model;

class SelectedInterventionModel extends Model
{
    protected $table            = 'selectedintervention';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['intervention_id', 'employee_id', 'competency_id', 'cycle_id', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = false;
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

    public function intervention()
    {
        return $this->belongsTo('LearningInterventionModel', 'intervention_id');
    }

    public function employee()
    {
        return $this->belongsTo('EmployeeModel', 'employee_id');
    }

    public function competency()
    {
        return $this->belongsTo('CompetencyModel', 'competency_id');
    }

    public function cycle()
    {
        return $this->belongsTo('DevelopmentCycleModel', 'cycle_id');
    }
}

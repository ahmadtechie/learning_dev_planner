<?php

namespace App\Models;

use CodeIgniter\Model;

class DevelopmentContractingModel extends Model
{
    protected $table            = 'development_rating';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['employee_id', 'competency_id', 'self_rating', 'line_manager_rating', 'cycle_id', 'created_at', 'updated_at', 'deleted_at'];

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

    /**
     * @throws \ReflectionException
     */
    public function updateLineManagerRating($active_cycle_id, $employee_id, $competency_id, $line_manager_rating) {
        $this->where('cycle_id', $active_cycle_id)
            ->where('employee_id', $employee_id)
            ->where('competency_id', $competency_id)
            ->set('line_manager_rating', $line_manager_rating)
            ->update();
    }
}

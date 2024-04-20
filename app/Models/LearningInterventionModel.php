<?php

namespace App\Models;

use CodeIgniter\Model;

class LearningInterventionModel extends Model
{
    protected $table            = 'learning_intervention';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['intervention_id', 'intervention_name', 'trainer_id', 'cycle_id', 'intervention_type_id', 'cost', 'competency_id', 'created_at', 'updated_at', 'deleted_at'];

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

    public function generateUniqueInterventionID(): string
    {
        do {
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $intervention_id = 'INT' . $randomNumber;
            $existingInterventionId = $this->where('intervention_id', $intervention_id)->first();
        } while ($existingInterventionId);

        return $intervention_id;
    }
}

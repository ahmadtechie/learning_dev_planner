<?php

namespace App\Models;

use CodeIgniter\Model;

class JobModel extends Model
{
    protected $table            = 'job';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['job_title', 'qualifications', 'created_at', 'updated_at', 'deleted_at'];

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

    // Define the relationship with the Competency model
    public function competencies()
    {
        return $this->belongsToMany('App\Models\CompetencyModel', 'job_competencies', 'job_id', 'competency_id');
    }

    /**
     * @throws \ReflectionException
     */
    public function getOrCreate($key, $value, $data)
    {
        $query = $this->where($key, $value)->first();

        if ($query) {
            return $query;
        } else {
            $this->insert($data);
            return $this->where($key, $value)->first();
        }
    }
}

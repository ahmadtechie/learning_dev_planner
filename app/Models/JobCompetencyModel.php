<?php

namespace App\Models;

use CodeIgniter\Model;

class JobCompetencyModel extends Model
{
    protected $table            = 'job_competencies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['job_id', 'competency_id'];

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

    public function getJobsWithCompetencies(): array
    {
        return $this->db->table('job_competencies')
            ->select(
                'job.id as job_id,
                job.job_title, 
                GROUP_CONCAT(competency.competency_name ORDER BY competency.competency_name ASC SEPARATOR ", ") AS competencies,
                job_competencies.updated_at'
            )
            ->join('job', 'job.id = job_competencies.job_id')
            ->join('competency', 'competency.id = job_competencies.competency_id')
            ->where('job_competencies.deleted_at IS NULL')
            ->groupBy('job.id, job.job_title, job_competencies.updated_at')
            ->get()
            ->getResultArray();
    }

    public function getCompetenciesForJob($jobId): array
    {
        return $this->db->table('job_competencies')
            ->select('competency.*')
            ->join('competency', 'job_competencies.competency_id = competency.id')
            ->where('job_competencies.deleted_at IS NULL')
            ->where('job_competencies.job_id', $jobId)
            ->get()
            ->getResultArray();
    }

    /**
     * @throws \ReflectionException
     */
    public function updateJobCompetencies($jobId, $competencyIds): bool
    {
        // Begin a transaction
        $this->db->transBegin();

        try {
            // Delete existing job competencies for the specified job ID
            $this->where('job_id', $jobId)->delete();

            // Insert the updated job competencies
            $data = [];
            foreach ($competencyIds as $competencyId) {
                $data[] = [
                    'job_id' => $jobId,
                    'competency_id' => $competencyId,
                ];
            }
            $this->insertBatch($data);

            // Commit the transaction
            $this->db->transCommit();

            return true; // Return true on success
        } catch (\Exception $e) {
            // Rollback the transaction on error
            $this->db->transRollback();

            // Handle the error (e.g., log it, return false, etc.)
            return false;
        }
    }
}

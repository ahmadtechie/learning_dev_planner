<?php

namespace App\Validation\Rules;

use App\Models\CompetencyModel;
use App\Models\DepartmentModel;
use App\Models\DivisionModel;
use App\Models\GroupModel;
use App\Models\JobCompetencyModel;
use App\Models\JobModel;
use App\Models\UnitModel;
use App\Models\UserModel;

class CustomRules
{
    public function validateDivisionUnique($str, string $field, array $data): bool
    {
        $model = new DivisionModel();

        // Check if the department name is unique, excluding soft-deleted records
        $existing = $model->where($field, $str)->where('deleted_at IS NULL')->first();

        return empty($existing);
    }

    public function validateDepartmentUnique($str, string $field, array $data): bool
    {
        $model = new DepartmentModel();

        // Check if the department name is unique, excluding soft-deleted records
        $existing = $model->where($field, $str)->where('deleted_at IS NULL')->first();

        return empty($existing);
    }

    public function validateGroupUnique($str, string $field, array $data): bool
    {
        $model = new GroupModel();

        // Check if the department name is unique, excluding soft-deleted records
        $existing = $model->where($field, $str)->where('deleted_at IS NULL')->first();

        return empty($existing);
    }

    public function validateUnitUnique($str, string $field, array $data): bool
    {
        $model = new UnitModel();

        // Check if the department name is unique, excluding soft-deleted records
        $existing = $model->where($field, $str)->where('deleted_at IS NULL')->first();

        return empty($existing);
    }

    public function validateJobUnique($str, string $field, array $data): bool
    {
        $model = new JobModel();

        // Check if the job title is unique, excluding soft-deleted records
        $existing = $model->where($field, $str)->where('deleted_at IS NULL')->first();

        return empty($existing);
    }

    public function validateCompetencyUnique($str, string $field, array $data): bool
    {
        $model = new CompetencyModel();

        // Check if the competency is unique, excluding soft-deleted records
        $existing = $model->where($field, $str)->where('deleted_at IS NULL')->first();

        return empty($existing);
    }

    public function validateJobCompetencyUnique($str, string $field, array $data): bool
    {
        $model = new JobCompetencyModel();

        // Check if the job title is unique, excluding soft-deleted records
        $existing = $model->where($field, $str)->where('deleted_at IS NULL')->first();

        return empty($existing);
    }

    public function validateUserUnique($str, string $field, array $data): bool
    {
        $model = new UserModel();

        // Check if the email is unique, excluding soft-deleted records
        $existing = $model->where($field, $str)->where('deleted_at IS NULL')->first();

        return empty($existing);
    }
}
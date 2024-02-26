<?php

namespace App\Libraries;

use CodeIgniter\Validation\Validation;

class MY_Form_validation extends \CodeIgniter\Validation\Validation
{
    public function validate_unique(string $str, string $field, array $data): bool
    {
        $model = new \App\Models\DepartmentModel();

        // Check if the department name is unique, excluding soft-deleted records
        $existing = $model->where('name', $str)->where('deleted_at IS NULL')->first();

        return empty($existing);
    }
}

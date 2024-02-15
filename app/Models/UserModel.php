<?php

namespace App\Models;

use CodeIgniter\Model;
//use Myth

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['username', 'email', 'password', 'first_name', 'last_name', 'role_id', 'employee_id'];
    protected $returnType = \App\Entities\User::class;
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function employee()
    {
        return $this->belongsTo('EmployeeModel', 'employee_id');
    }

    public function role()
    {
        return $this->belongsTo('UserRole', 'role_id');
    }
}

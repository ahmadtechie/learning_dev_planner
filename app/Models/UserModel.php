<?php

namespace App\Models;

use CodeIgniter\Model;
//use Myth

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'email', 'password', 'first_name', 'last_name', 'created_at', 'updated_at', 'deleted_at'];

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
    public function restoreUser($userId)
    {
        // Attempt to find the soft-deleted user
        $user = $this->onlyDeleted()->find($userId);

        if (!$user) {
            return false; // Employee not found or not soft-deleted
        }

        // Restore the soft-deleted employee by setting the 'deleted_at' field to NULL
        return $this->update($userId, ['deleted_at' => null]);
    }

    public function generateUniqueRandomUsername(): string
    {
        do {
            $randomNumber = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            $username = 'LD' . $randomNumber;
            $existingUser = $this->where('username', $username)->first();
        } while ($existingUser);

        return $username;
    }

    public function generateRandomPassword($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }
}

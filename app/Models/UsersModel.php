<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['email', 'username', 'password', 'publisher', 'role'];

    public function getUser($username)
    {
        return $this->where(['username' => $username])->first();
    }
}

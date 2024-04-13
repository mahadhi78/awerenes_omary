<?php

namespace App\Http\Controllers\UserManagement\Dao;

interface UserDao
{
    public function createUser($data);
    public function getAllUserActive();
    public function getUnApprovedUsers();
    public function getApprovedUsers();
    public function findUserById($id);
    public function assignRoleToUser($user, $roleName);
    public function updateUserById($id, $data);


}

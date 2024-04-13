<?php

namespace App\Http\Controllers\UserManagement\Dao;

interface RoleDao
{
    public function getAllRoles();
    public function getRoleNotLikeAdmin();

}

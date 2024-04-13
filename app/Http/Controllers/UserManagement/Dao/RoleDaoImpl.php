<?php

namespace App\Http\Controllers\UserManagement\Dao;

use App\Constants\Constants;
use Auth;
use Spatie\Permission\Models\Role;

class RoleDaoImpl implements RoleDao
{
    public function getAllRoles()
    {
        if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
            $data = Role::all();
        }elseif ( Auth::user()->hasRole(Constants::ROLE_ADMINISTRATOR)) {
            $excludedRoles = [ Constants::ROLE_SUPER_ADMINISTRATOR];
             $data =  Role::whereNotIn('name', $excludedRoles)->get();
        } else {
            $excludedRoles = [Constants::ROLE_SUPER_ADMINISTRATOR, Constants::ROLE_ADMINISTRATOR];
            $data =  Role::whereNotIn('name', $excludedRoles)->get();
        }
        return $data;
    }

    public function getRoleNotLikeAdmin()
    {
        if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR) || Auth::user()->hasRole(Constants::ROLE_ADMINISTRATOR)) {
            $data = Role::where('name', '!=', Constants::ROLE_SUPER_ADMINISTRATOR)->pluck('name', 'id')->all();
        } else {
            $excludedRoles = [Constants::ROLE_SUPER_ADMINISTRATOR, Constants::ROLE_ADMINISTRATOR];
            $data =  Role::whereNotIn('name', $excludedRoles)->pluck('name', 'id')->all();
        }
        return $data;
    }
}

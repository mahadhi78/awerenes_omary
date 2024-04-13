<?php

namespace App\Http\Controllers\UserManagement\Dao;

use App\Models\User;
use App\Constants\Constants;
use Illuminate\Support\Facades\Auth;
use App\Models\UserManagement\CustomUser;

class UserDaoImpl implements UserDao
{
    public function createUser($data)
    {
        return User::create($data);
    }

    public function getAllUserActive()
    {
        return CustomUser::select('firstName', 'lastName', 'id', 'userName')
            ->where('status', Constants::STATUS_ACTIVE)
            ->get();
    }

    public function getUnApprovedUsers()
    {
        if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
            $data = CustomUser::where('is_approved', Constants::PENDING)->get();
        } else if (Auth::user()->hasRole(Constants::ROLE_ADMINISTRATOR)) {
            $data = CustomUser::where('is_approved', Constants::PENDING)->whereNull('is_super_admin')->get();
        } else {
            $data = CustomUser::where('is_approved', Constants::PENDING)->where('school_id', Auth::user()->school_id)->get();
        }
        return $data;
    }

    public function getApprovedUsers()
    {
        if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR) || Auth::user()->hasRole(Constants::ROLE_ADMINISTRATOR)) {
            $data = CustomUser::where('is_approved', Constants::APPROVED)->get();
        } elseif (Auth::user()->hasRole(Constants::ROLE_ADMINISTRATOR)) {
            $data = CustomUser::where('is_approved', Constants::APPROVED)->get();
        } else {
            if ($school_id = Auth::user()->school_id) {
                $data = CustomUser::where('is_approved', Constants::APPROVED)->where('school_id', $school_id)->get();
            }
        }
        return $data;
    }



    public function findUserById($id)
    {
        return User::find($id);
    }


    public function assignRoleToUser($user, $roleName)
    {
        $user->assignRole($roleName);
    }

    public function updateUserById($id, $data)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->update($data);
        }
        return $user;
    }
}

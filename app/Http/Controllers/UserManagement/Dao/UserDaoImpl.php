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
        return CustomUser::where('is_approved', Constants::PENDING)->get();
    }

    public function getApprovedUsers()
    {
        $data = CustomUser::where('is_approved', Constants::APPROVED)->where('userType',Constants::STAFF)->get();

        return $data;
    }

    public function getApprovedlearners()
    {
        $data = CustomUser::where('is_approved', Constants::APPROVED)->where('userType',Constants::LEARNER)->get();

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

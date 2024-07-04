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
        return CustomUser::where([['is_approved', Constants::PENDING], ['is_deleted', false]])->get();
    }
    private function getApproved($data = null)
    {
        return CustomUser::where([
            ['is_approved', Constants::APPROVED],
            $data,
            ['is_deleted', false]
        ])->get();
    }

    public function getApprovedUsers()
    {
        return $this->getApproved(['userType', Constants::STAFF]);
    }

    public function getApprovedlearners()
    {
        return $this->getApproved(['userType', Constants::LEARNER]);
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
        return  User::findOrFail($id)->update($data);
    }

    public function deleteuser($id)
    {
        return User::findOrFail($id)->update([
            'is_deleted' => true,
            'status' => Constants::STATUS_INACTIVE,
            'activation_status' => Constants::STATUS_INACTIVE
        ]);
    }
}

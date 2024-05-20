<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Constants\Constants;

use App\Models\SystemSettings\Institution;
use App\Models\SystemSettings\Directorate;
use App\Models\SystemSettings\Position;
use App\Models\SystemSettings\DutyStation;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {


        $user = User::Create(
            [
                'firstname' => 'Mahadhi',
                'middlename' => 'Ally',
                'lastname' => 'Ramadahn',
                'phone_number' => '255755455399',
                'email' => 'mahadhiramadhan@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('mahadhi@12345'),
                'remember_token' => Str::random(60),
                'is_super_admin' => true,
                'status' => Constants::STATUS_ACTIVE,
                'activation_status' => Constants::STATUS_ACTIVE,
                'is_approved' => Constants::APPROVED,
                'gender' => 'Male',
                'dob' => '21/22/1999',

            ]


        );

        $role = Role::where('status', '=', Constants::STATUS_ACTIVE)->first();

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        $roles = [
            ['name' => Constants::ROLE_ADMINISTRATOR, 'created_by' => '1', 'status' => Constants::STATUS_ACTIVE]
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Constants\Constants;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Database\Factories\RootFactory;

class DEmoDataSeeder extends Seeder
{

    public function run()
    {

        echo PHP_EOL, 'seeding user Data...';
        $this->userDemo();

        echo PHP_EOL, 'seeding Setting Data...';
        $this->settingData();

        echo PHP_EOL, 'seeding Role Data...';
        $this->roleData();
    }




    private function userDemo()
    {
        DB::table('users')->delete();
        $data = [
            [
                'firstname' => 'juma',
                'middlename' => 'Ally',
                'lastname' => 'juma',
                'phone_number' => '255755455399',
                'email' => 'juma@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('juma@12345'),
                'remember_token' => Str::random(60),
                'status' => Constants::STATUS_ACTIVE,
                'activation_status' => Constants::STATUS_ACTIVE,
                'is_approved' => Constants::APPROVED,
                'gender' => 'Male',

            ],
        ];

        DB::table('users')->insert($data);
    }
    private function settingData()
    {
        DB::table('settings')->delete();

        $data = [
            ['type' => 'system_title', 'description' => 'Awereness'],
            ['type' => 'system_name', 'description' => 'Cyber Awereness'],
            ['type' => 'system_email', 'description' => 'cyber.awereness@gmail.com'],
            ['type' => 'phone', 'description' => '255713949238'],
            ['type' => 'address', 'description' => 'DODOMA Tanzania - P.O.BOX 2222'],
            ['type' => 'logo', 'description' => ''],

        ];

        DB::table('settings')->insert($data);
    }

    private function roleData()
    {
        DB::table('roles')->delete();

        $roles = [
            ['name'=>'Super Administrator',
            'created_by'=>'1','status' => Constants::STATUS_ACTIVE]
       ];

       foreach ($roles as $key => $value) {
            Role::create($value);
       }
    }
}

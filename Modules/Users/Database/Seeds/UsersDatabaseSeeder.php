<?php

namespace Modules\Users\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Users\Models\User;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET foreign_key_checks=0");

        User::truncate();

        $users = [
            [
                'password' => bcrypt('12345'),
                'registered_date' => date('Y-m-d'),
                'username' => 'admin',
                'email' => 'admin@example.com',
                'api_token' => str_random(60),
                'remember_token' => str_random(10),
                'referral_code' => str_random(4),
            ],
            [
                'password' => bcrypt('12345'),
                'registered_date' => date('Y-m-d'),
                'username' => 'super_admin',
                'email' => 'super_admin@example.com',
                'api_token' => str_random(60),
                'remember_token' => str_random(10),
                'referral_code' => str_random(4),
            ],
            [
                'password' => bcrypt('12345'),
                'registered_date' => date('Y-m-d'),
                'username' => 'employer',
                'email' => 'employer@example.com',
                'api_token' => str_random(60),
                'remember_token' => str_random(10),
                'referral_code' => str_random(4),
            ],
            [
                'password' => bcrypt('12345'),
                'registered_date' => date('Y-m-d'),
                'username' => 'job_seeker',
                'email' => 'job_seeker@example.com',
                'api_token' => str_random(60),
                'remember_token' => str_random(10),
                'referral_code' => str_random(4),
            ],
            [
                'password' => bcrypt('12345'),
                'registered_date' => date('Y-m-d'),
                'username' => 'license_partner',
                'email' => 'license_partner@example.com',
                'api_token' => str_random(60),
                'remember_token' => str_random(10),
                'referral_code' => str_random(4),
            ]
        ];

        User::insert($users);

        \DB::statement("SET foreign_key_checks=1");

    }
}

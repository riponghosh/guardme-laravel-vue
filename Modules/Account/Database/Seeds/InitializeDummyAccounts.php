<?php

namespace Modules\Account\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Account\Models\Role;
use Modules\Users\Models\User;
use Faker\Generator as Faker;

class InitializeDummyAccounts extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user_admin = User::whereUsername('admin')->first();
        $user_admin->roles()->attach(
            [Role::whereName(config('guardme.acl.Admin'))->first()->id => ['is_primary' => true]]
        );

        $user_super_admin = User::whereUsername('super_admin')->first();
        $user_super_admin->roles()->attach(
            [Role::whereName(config('guardme.acl.Super_Admin'))->first()->id => ['is_primary' => true]]
        );

        $user_employer = User::whereUsername('employer')->first();
        $user_employer->roles()->attach(
            [Role::whereName(config('guardme.acl.Employer'))->first()->id => ['is_primary' => true]]
        );

        $user_job_seeker = User::whereUsername('job_seeker')->first();
        $user_job_seeker->roles()->attach(
            [Role::whereName(config('guardme.acl.Job_Seeker'))->first()->id => ['is_primary' => true]]
        );

        $user_license_partner = User::whereUsername('license_partner')->first();
        $user_license_partner->roles()->attach(
            [Role::whereName(config('guardme.acl.License_partner'))->first()->id => ['is_primary' => true]]
        );
    }
}

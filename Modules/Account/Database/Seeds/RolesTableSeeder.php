<?php

namespace Modules\Account\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Account\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            config('guardme.acl.License_partner'),
            config('guardme.acl.Job_Seeker'),
            config('guardme.acl.Employer'),
            config('guardme.acl.Super_Admin'),
            config('guardme.acl.Admin'),
        ];

        Role::truncate();

        foreach ($roles as $role){
            Role::create([
               'name' => $role
            ]);
        }
    }
}

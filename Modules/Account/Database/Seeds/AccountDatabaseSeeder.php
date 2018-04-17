<?php

namespace Modules\Account\Database\Seeds;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class AccountDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET foreign_key_checks=0");
        Model::unguard();

        $this->call(RolesTableSeeder::class);
        $this->call(InitializeDummyAccounts::class);

        Model::reguard();
        \DB::statement("SET foreign_key_checks=1");
    }
}

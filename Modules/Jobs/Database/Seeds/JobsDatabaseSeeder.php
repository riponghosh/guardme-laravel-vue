<?php

namespace Modules\Jobs\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Jobs\Models\Job;

class JobsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET foreign_key_checks=0");

        $this->call(DummyJobsSeed::class);

        \DB::statement("SET foreign_key_checks=1");
    }
}

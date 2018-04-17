<?php

namespace Modules\Rating\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Rating\Models\Rating;

class RatingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RatingSetup::class);
    }
}

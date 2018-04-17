<?php

namespace Modules\App\Database\Seeds;

use Illuminate\Database\Seeder;

class AppDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CountyCitiesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(SectorsSeeder::class);
    }
}

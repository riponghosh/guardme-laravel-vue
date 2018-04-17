<?php

namespace Modules\App\Database\Seeds;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Modules\App\Models\Category;
use Modules\App\Models\City;
use Modules\App\Models\County;
use Modules\App\Models\Sector;

class SectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET foreign_key_checks=0");

        Sector::truncate();

        foreach (config('guardme.sectors') as $sector){
            Sector::create([
                'name' => $sector
            ]);
        }

        \DB::statement("SET foreign_key_checks=1");

    }
}

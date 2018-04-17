<?php

namespace Modules\App\Database\Seeds;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Modules\App\Models\City;
use Modules\App\Models\County;

class CountyCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET foreign_key_checks=0");

        County::truncate();
        City::truncate();

        $result = Excel::load(module_path('app','Database/Seeds/Towns_List.csv'))
            ->all();


        foreach ($result as $record){
            $county = County::firstOrCreate([
                'name' => trim($record->county)
            ]);

            $city = City::firstOrCreate([
                'name' => trim($record->town),
                'county_id' => $county->id
            ]);
        }

        var_dump('Cities: ' . City::all()->count());
        var_dump('Counties: ' . County::all()->count());

        \DB::statement("SET foreign_key_checks=1");

    }
}

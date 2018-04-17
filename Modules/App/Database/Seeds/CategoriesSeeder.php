<?php

namespace Modules\App\Database\Seeds;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Modules\App\Models\Category;
use Modules\App\Models\City;
use Modules\App\Models\County;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET foreign_key_checks=0");

        Category::truncate();

        foreach (config('guardme.categories') as $category){
            Category::create([
                'name' => $category
            ]);
        }

        \DB::statement("SET foreign_key_checks=1");

    }
}

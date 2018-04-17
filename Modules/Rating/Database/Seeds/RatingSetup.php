<?php

namespace Modules\Rating\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Rating\Models\Rating;

class RatingSetup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET foreign_key_checks=0");

        Rating::truncate();

        foreach (config('guardme.ratings') as $rating){
            Rating::create([
                'name' => $rating
            ]);
        }

        \DB::statement("SET foreign_key_checks=1");
    }
}

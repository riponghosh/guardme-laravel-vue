<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Jobs\Models\Job::class, function (Faker $faker) {
    $title = $faker->words(8, true);
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'description' => $faker->paragraph(8),
        'starts' => $faker->dateTime(),
        'ends' => $faker->dateTime(),
        'offer' => $faker->numberBetween(7, 15),
        'rating' => $faker->numberBetween(3, 5),
        'postcode' => $faker->postcode,
    ];
});

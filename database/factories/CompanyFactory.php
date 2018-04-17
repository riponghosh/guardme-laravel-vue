<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Company\Models\Company::class, function (Faker $faker) {
    $title = $faker->company;
    return [
        'name' => $title,
        'email' => $faker->companyEmail,
        'phone_number' => $faker->phoneNumber
    ];
});

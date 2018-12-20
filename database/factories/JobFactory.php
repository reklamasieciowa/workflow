<?php

use Faker\Generator as Faker;

$factory->define(App\Job::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
		'deadline' => $faker->dateTimeBetween($startDate = '-1 week', $endDate = '+2 years', $timezone = date_default_timezone_get()),
		'status_id' => $faker->biasedNumberBetween($min = 1, $max = 3),
    ];
});
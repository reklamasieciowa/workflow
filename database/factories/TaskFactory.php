<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
        'status_id' => $faker->biasedNumberBetween($min = 1, $max = 4),
        'job_id' => $faker->biasedNumberBetween($min = 1, $max = 30),
    ];
});
<?php

use Faker\Generator as Faker;

$factory->define(App\Checklist::class, function (Faker $faker) {
    return [
    	'name' => 'checklist: '.$faker->sentence,
        'description' => $faker->sentence,
    ];
});

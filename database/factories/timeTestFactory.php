<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\timeTest;
use Faker\Generator as Faker;

$factory->define(timeTest::class, function (Faker $faker) {
    return [
        "settingTime"  => $faker->dateTime($max = 'now', $timezone = null) 
    ];
});

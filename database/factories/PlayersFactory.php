<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Players;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
$factory->define(Players::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'account' => $faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'currency' => Arr::random(["RMB","TWD","USD"]),
    ];
});


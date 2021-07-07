<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\players as Players;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(Players::class, function (Faker $faker) {
    $currency=config('setting.currency');//["RMB","TWD","USD"]
    return [
        'name' => $faker->name,
        'account' => $faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'currency' => Arr::random($currency),
    ];
});


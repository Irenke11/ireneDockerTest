<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\players ;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\currency;

$factory->define(players::class, function (Faker $faker) {
    $currency = array_column(json_decode(currency::getOpenCurrency()), 'id');//["1","2","3"]
    return [
        'name' => $faker->name,
        'account' => $faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'currency' => Arr::random($currency),
        'status' => Arr::random([0,1]),
    ];
});


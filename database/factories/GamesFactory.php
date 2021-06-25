<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Games;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(Games::class, function (Faker $faker) {
    return [
        'gameName' => json_encode(['en'=> $faker->state,"cn"=> $faker->state,"tw"=> $faker->state]),
        'gameType' => Arr::random(["slot","poker","fish"]),
    ];
});

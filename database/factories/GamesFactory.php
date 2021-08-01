<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\games as Games;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\gameType as gameType;

$factory->define(Games::class, function (Faker $faker) {
    $gameType = array_column(json_decode(gameType::getOpenGameType()), 'id');//["1","2","3"] 
    return [
        'gameName' => json_encode(['en'=> $faker->state,"cn"=> $faker->state,"tw"=> $faker->state]),
        'gameType' => Arr::random($gameType),
        'status' => Arr::random([0,1]),
    ];
});

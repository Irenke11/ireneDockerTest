<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\games as Games;
use Faker\Generator as Faker;
// use Faker\Provider\zh_CN\Address as AddressCN;
// use Faker\Provider\en_US\Address as AddressUS;
// use Faker\Provider\zh_TW\Address as AddressTW;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(Games::class, function (Faker $faker) {
    $gameType= Arr::random(["slot","poker","fish"]);
    return [
        'gameName' => json_encode(['en'=> $faker->state,"cn"=> $faker->state,"tw"=> $faker->state]),
        'gameType' => $gameType,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bets;
use App\Players;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


$factory->define(bets::class, function (Faker $faker) {
// $playerslist1=players::getAllPlayers();
// $playerslist=json_decode($playerslist1,true);
    return [
        'gameId' => Arr::random(range(1,20)),
        'playerId' => Arr::random(range(1,20)),
        'amount' => Arr::random(range(1,1000)),
        'payout' => Arr::random(range(1,1000)),
        'bureauNo' => Arr::random(range(1,1000)),
    ];
});

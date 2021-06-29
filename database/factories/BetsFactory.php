<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bets;
use App\Players;
use App\Games;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


$factory->define(bets::class, function (Faker $faker) {
// $playerslist1=players::getAllPlayers();
// $playerslist=json_decode($playerslist1,true);
    return [
        'gameName' => $faker->state,
        'gameId' => Arr::random(range(1,20)),
        'gameType' => Arr::random(["slot","poker","fish"]),
        'playerId' => Arr::random(range(1,20)),
        'amount' => Arr::random(range(1,1000)),
        'payout' => Arr::random(range(0,500)),
        'bureauNo' => Arr::random(range(1,1000)),
        'currency' => Arr::random(["RMB","TWD","USD"]),
    ];
});

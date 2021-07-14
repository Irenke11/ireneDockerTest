<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\bets as Bets;
use App\players as Players;
use App\games as Games;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


$factory->define(bets::class, function (Faker $faker) {
    $playerslist=players::getAll();//玩家資訊
    $no=array_rand(json_decode($playerslist), 1);//隨機玩家
    $gameslist=games::getAll();//游戲資訊
    $no2=array_rand(json_decode($gameslist), 1);//隨機游戲id
    $amount = $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000);
    $payout = $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 500);
    $profit = $amount - $payout;
        return [
            'amount' => $amount,
            'payout' => $payout,
            'profit' => $profit,
            'bureauNo' => $playerslist[$no]->playerId.date("Ymd").$gameslist[$no2]->gameId,
            'gameName' => json_decode($gameslist[$no2]->gameName)->en,
            'gameId' => $gameslist[$no2]->gameId,
            'gameType' => $gameslist[$no2]->gameType,
            'playerId' => $playerslist[$no]->playerId,
            'currency' => $playerslist[$no]->currency,
        ];
});

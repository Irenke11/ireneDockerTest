<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\bets as Bets;
use App\players as Players;
use App\games as Games;
use App\currency as Currency;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


$factory->define(bets::class, function (Faker $faker) {
    $playerslist=players::getAll();//玩家資訊
    $no=array_rand(json_decode($playerslist), 1);//隨機玩家
    $gameslist=games::getAll();//游戲資訊
    $no2=array_rand(json_decode($gameslist), 1);//隨機游戲id
    $stake = $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000);
    $winning = $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 500);
    $GGR = $stake - $winning;
    $rate=currency::getCurrencyById($playerslist[$no]["currency"])["rate"];
        return [
            'stake' => $stake,
            'winning' => $winning,
            'GGR' => $GGR,
            'rate' => $rate,
            'bureauNo' => $playerslist[$no]->playerId.date("Ymd").$gameslist[$no2]->gameId,
            'gameName' => json_decode($gameslist[$no2]->gameName)->en,
            'gameId' => $gameslist[$no2]->gameId,
            'gameType' => $gameslist[$no2]->gameType,
            'playerId' => $playerslist[$no]->playerId,
            'currency' => $playerslist[$no]->currency,
            // 'betTime' => "2021-07-12 06:36:53", //假裝時間
        ];
});

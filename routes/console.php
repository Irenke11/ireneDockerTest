<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Bets;
use App\dailyBets;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe(Carbon::now());

Artisan::command('dailyBets', function () {
    $dayTime['startTime'] = Carbon::yesterday();  //2021-06-25 00:00:00
    $dayTime['endTime'] = Carbon::yesterday()->endOfday();  //2021-06-25 23:59:59       
    $data['gameTypeList'] = config('setting.gametype');//遊戲類型列表
    foreach ($data['gameTypeList'] as $gameType ){
        $countSchedule = DailyBets::checkSchedule($dayTime,$gameType); //是否已存在
        if($countSchedule == 0 ){
            $dailyBets = DailyBets::dailyBets($dayTime,$gameType);
            $dailyBets['betsDay']=Carbon::yesterday();
            $dailyBets['gameType']=$gameType;
            $Schedule = DailyBets::addSchedule($dailyBets);
        }
    }
    $gameType="All";
    $countSchedule = DailyBets::checkSchedule($dayTime,$gameType); //是否已存在
    if($countSchedule == 0 ){
        $dailyBetsAll = DailyBets::dailyBetsAll($dayTime);
        $dailyBetsAll['betsDay']=Carbon::yesterday();
        $dailyBetsAll['gameType']=$gameType;
        $Schedule = DailyBets::addSchedule($dailyBetsAll);
    }
});

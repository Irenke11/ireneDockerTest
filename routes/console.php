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
    $data['currencyList'] = config('setting.currency');//比值
    foreach ($data['currencyList'] as $currency ){
        foreach ($data['gameTypeList'] as $gameType ){
            $countSchedule = DailyBets::checkSchedule($dayTime,$gameType,$currency); //是否已存在
            if($countSchedule == 0 ){
                $dailyBets = DailyBets::dailyBets($dayTime,$gameType,$currency);
                $dailyBets['betsDay']=Carbon::yesterday();
                $dailyBets['gameType']=$gameType;
                $dailyBets['currency']=$currency;
                $Schedule = DailyBets::addSchedule($dailyBets);
            }
        }
        $gameType="All";
        $countSchedule = DailyBets::checkSchedule($dayTime,$gameType,$currency); //是否已存在
        if($countSchedule == 0 ){
            $dailyBetsAll = DailyBets::dailyBetsAll($dayTime,$currency);
            $dailyBetsAll['betsDay']=Carbon::yesterday();
            $dailyBetsAll['gameType']=$gameType;
            $dailyBetsAll['currency']=$currency;
            $Schedule = DailyBets::addSchedule($dailyBetsAll);
        }
    }
 

});

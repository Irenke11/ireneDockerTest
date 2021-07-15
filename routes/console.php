<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Bets;
use App\dailyBets;
use Carbon\Carbon;
use App\gameType;
use App\currency;


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
    $dayTime['startTime'] = Carbon::yesterday();  //2021-07-14 00:00:00
    $dayTime['endTime'] = Carbon::yesterday()->endOfday();  //2021-06-25 23:59:59       
    $data['gameTypeList'] = gameType::getOpenGameTypeArray();//遊戲類型列表
    $data['currencyList'] = currency::getOpenCurrencyArray();//幣值
    foreach ($data['currencyList'] as $currencyNo => $currencyName ){
        foreach ($data['gameTypeList'] as $gameTypeNo => $gameTypeName ){
            $countSchedule = DailyBets::checkSchedule($dayTime,$gameTypeNo,$currencyNo); //是否已存在
            if($countSchedule == 0 ){
                $dailyBets = DailyBets::dailyBets($dayTime,$gameTypeNo,$currencyNo);
                $dailyBets['betsDay']=Carbon::yesterday();
                $dailyBets['gameType']=$gameTypeNo;
                $dailyBets['currency']=$currencyNo;
                $Schedule = DailyBets::addSchedule($dailyBets);
            }
        }
        $gameTypeNo="0";
        $countSchedule = DailyBets::checkSchedule($dayTime,$gameTypeNo,$currencyNo); //是否已存在
        if($countSchedule == 0 ){
            $dailyBetsAll = DailyBets::dailyBetsAll($dayTime,$currencyNo);
            $dailyBetsAll['betsDay']=Carbon::yesterday();
            $dailyBetsAll['gameType']=$gameTypeNo;
            $dailyBetsAll['currency']=$currencyNo;
            $Schedule = DailyBets::addSchedule($dailyBetsAll);
        }
    }
 

});

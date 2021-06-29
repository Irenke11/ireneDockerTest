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
    // 
    //之後記得改成call contrller
    // $dayTime['startTime'] = "2021-06-26 00:00:00"; 
    // $dayTime['endTime'] ="2021-06-26 23:59:59";
    $day = Carbon::yesterday();//昨天
    $dayTime['startTime'] = Carbon::parse($day)->toDateTimeString();            //2021-06-25 00:00:00
    $dayTime['endTime'] = Carbon::parse($day)->endOfday()->toDateTimeString();  //2021-06-25 23:59:59
    $data['gameTypeList'] = config('setting.gametype');//遊戲類型列表
    foreach ($data['gameTypeList'] as $gameType ){
        // $countSchedule = DailyBets::checkSchedule($dayTime,$gameType); //是否已存在
        // if($countSchedule == 0 ){
            $dailyBets = DailyBets::dailyBets($dayTime,$gameType);
            $dailyBets['betsDay']=Carbon::parse($day)->toDateString();
            $dailyBets['gameType']=$gameType;
            $Schedule = DailyBets::addSchedule($dailyBets);
        // }
    }
});

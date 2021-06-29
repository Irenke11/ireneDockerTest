<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Bets;
use App\dailyBets as daily;
use Carbon\Carbon;
use App\timeTest;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\dailyBets::class,
        // \App\Console\Commands\dailyBet::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->everyThirtyMinutes();
        // 
        $schedule->command('dailyBets')->daily();
        $schedule->call(function () {
            $day =   date("Y/m/d H:i:s");
            // error_log($day);
            // $day = Carbon::now();
            $timeTest = new timeTest;
            $timeTest->settingTime  = $day;
            $timeTest->save();
        })->daily();


        // $schedule->command('dailySettlement')->daily()->withoutOverlapping(10);
        
        // $schedule->call(function () {
        //     // error_log($dailyBets);
        //     $day = Carbon::yesterday();//昨天
        //     $dayTime['startTime'] = Carbon::parse($day)->toDateTimeString();            //2021-06-25 00:00:00
        //     $dayTime['endTime'] = Carbon::parse($day)->endOfday()->toDateTimeString();  //2021-06-25 23:59:59
        //     // $dayTime['startTime'] = "2021-06-25 00:00:00";    //test
        //     // $dayTime['endTime'] ="2021-06-25 23:59:59";  //test
        //     $data['gameTypeList'] = config('setting.gametype');//遊戲類型列表
        //     foreach ($data['gameTypeList'] as $gameType ){
        //         // $countSchedule = daily::checkSchedule($dayTime,$gameType); //是否已存在
        //         // if($countSchedule == 0 ){
        //             $dailyBets = daily::dailyBets($dayTime,$gameType);
        //             $dailyBets['betsDay']=Carbon::parse($day)->toDateString();
        //             $dailyBets['gameType']=$gameType;
                    
        //             $Schedule = daily::addSchedule($dailyBets);
        //         // }
        //     }
        //     // DB::table('recent_users')->delete();
        // })->everyMinute();
    
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

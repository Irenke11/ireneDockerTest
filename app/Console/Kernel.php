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
        $schedule->command('dailyBets')->everyMinute();
        // $schedule->call(function () {
        //     // $day =   date("Y/m/d H:i:s");
        //     // error_log($day);
        //     $day = Carbon::now();
        //     $timeTest = new timeTest;
        //     $timeTest->settingTime  = $day;
        //     $timeTest->save();
        // })->everyMinute();

        // $schedule->command('dailySettlement')->daily()->withoutOverlapping(10);
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

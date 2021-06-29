<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Bets;
use App\dailyBets as daily;
use Carbon\Carbon;

class dailyBets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dailyBets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command dailyBets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {   
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $day = Carbon::today()->subday()->toDateTimeString();//昨天
        // $dayTime['startTime'] = Carbon::parse($day)->toDateTimeString();            //2021-06-25 00:00:00
        // $dayTime['endTime'] = Carbon::parse($day)->endOfday()->toDateTimeString();  //2021-06-25 23:59:59
        // $data['gameTypeList'] = config('setting.gametype');//遊戲類型列表
        // foreach ($data['gameTypeList'] as $gameType ){
        //     // $countSchedule = daily::checkSchedule($dayTime,$gameType); //是否已存在
        //     // if($countSchedule == 0 ){
        //         $dailyBets = daily::dailyBets($dayTime,$gameType);
        //         $dailyBets['betsDay']=Carbon::parse($day)->toDateString();
        //         $dailyBets['gameType']=$gameType;
        //         $Schedule = daily::addSchedule($dailyBets);
        //     // }
        // }

    }

}

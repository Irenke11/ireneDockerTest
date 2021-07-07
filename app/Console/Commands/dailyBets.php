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

    }

}

<?php

use Illuminate\Database\Seeder;
use App\dailyBets as DailyBets;
class DailyBetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DailyBets::class, 20)->create();
    }
}

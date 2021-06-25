<?php

use Illuminate\Database\Seeder;
use App\Bets;

class BetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bets::class, 50)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Games;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Games::class, 20)->create();
    }
}

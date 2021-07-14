<?php

use Illuminate\Database\Seeder;
use App\games as Games;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Games::class, 10)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\players as Players;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        factory(Players::class, 20)->create();
    }
}

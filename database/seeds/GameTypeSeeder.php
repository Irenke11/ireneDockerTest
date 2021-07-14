<?php

use Illuminate\Database\Seeder;

class GameTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('game_types')->count() == 0){
            DB::table('game_types')->insert([
                [
                    'gameTypes' => 'slot',
                ],
                [
                    'gameTypes' => 'poker',
                ],
                [
                    'gameTypes' => 'fish',
                ],
            ]);
        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}

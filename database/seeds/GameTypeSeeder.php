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
        if(DB::table('gameType')->count() == 0){
            DB::table('gameType')->insert([
                [
                    'gameType' => 'slot',
                ],
                [
                    'gameType' => 'poker',
                ],
                [
                    'gameType' => 'fish',
                ],
            ]);
        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}

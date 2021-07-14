<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         if(DB::table('currencies')->count() == 0){

            DB::table('currencies')->insert([

                [
                    'currency' => 'RMB',
                ],
                [
                    'currency' => 'USD',
                ],
                [
                    'currency' => 'TWD',
                ],

            ]);
            
        } else { echo "\e[31mTable is not empty, therefore NOT "; }

    }
}

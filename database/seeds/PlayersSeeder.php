<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Players;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        factory(Players::class, 50)->create();
        // factory(App\Players::class, 50)->create()->each(function ($user) {
        //     $user->posts()->save(factory(App\Post::class)->make());
        // });
    }
    // public function run()
    // {
    //     DB::table('players')->insert([
    //         'account' => Str::random(8),
    //         'password' => Hash::make('password'),
    //         'name' => Str::random(8),
    //         'currency' => Arr::random(["RMB","TWD","USD"]),
    //     ]);
    // }
}

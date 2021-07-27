<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\players;

class playerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('http://localhost/home');

    //     $response->assertStatus(200);
    // }

    public function testPlayers()
    {
        $player=players::get();
        $this->assertCount(22,$player);
    }
    public function testPlayersAll()
    {
        $response = $this->get('http://localhost/players/all');
        $response->assertStatus(200);
    }
    public function testPlayersSee()
    {
        $response = $this->get('http://localhost/players/allData');
        $player=players::first();
        $response->assertSee($player->name);
    }
    public function testPlayersGet()
    {
        $player=players::first();
        $response = $this->get('http://localhost/players/edit/{'.$player->id.'}');
        $response->assertStatus(200);
    }
    public function testPlayersAdd()
    {
        $player=factory(Players::class, 1)->make();
        $response = $this-> get ('http://localhost/players/add',[
                                    "account"=>$player[0]["account"],
                                    "name"=>$player[0]["name"],
                                    "password"=>$player[0]["password"],
                                    "currency"=>$player[0]["currency"]  
                                ]);
        $response->assertStatus(200);
    }
}

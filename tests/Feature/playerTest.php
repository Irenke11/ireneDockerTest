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
    
    //1.route 有沒有通
    public function testPlayersAll()
    {
        $response = $this->get('http://localhost/players/all');
        $response->assertStatus(200);
    }
    //2.資料庫有沒有數據
    public function testPlayers()
    {
        //假數據22筆
        // $player=factory(Players::class, 22)->make();
        $player=players::get();
        $this->assertCount(28,$player); //players數量
    }
    //3.取得的資料是否有指定欄位
    public function testPlayersSee()
    {
        $response = $this->get('http://localhost/players/allData');
        $response->assertStatus(200);
        $player=players::first();
        $response->assertSee($player->name);//有沒有name
        $response->assertSeeInOrder([$player]);//断言响应中有序包含了给定的字符串
    }
    //測試新增賬號的功能
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
    //post json 測試新增賬號的功能
    public function testPlayersAddData()
    {
        $player=factory(Players::class, 1)->make();
        $response = $this->json('POST', 'http://localhost/players/addData', [
            "name"=>$player[0]["name"],
            "account"=>$player[0]["account"],
            "password"=>"123456",
            "currency"=>$player[0]["currency"],
            "status"=>$player[0]["status"] 
        ]);

        $response
            ->assertStatus(201)//回傳code
            ->assertExactJson([   //完全符合JSON
            "code"=>"201",
            "msg"=>"Okay",
            "status"=>"success"
            ]);
    }
        //是否有指定數據
    public function testPlayersEdit()
    {
        // $player=factory(Players::class, 1)->make();//假數據
        $player=players::first();
        $response = $this->get('http://localhost/players/edit/{'.$player->id.'}');
        $response->assertStatus(200);
    }

        //post json 測試自動回復默認密碼功能
    public function testPlayersRestorePassword()
    {
        $player=players::first();
        $response = $this->json('POST', 'http://localhost/players/restorePassword',["playerId"=>$player->playerId]);
        // $response->assertStatus(200);
        $response
            ->assertStatus(200)//回傳code
            ->assertJsonStructure([ //断言响应具有给定的 JSON 结构
                'playerId' ,
                'account',
                // 'password' ,
                'name' ,
                'currency',
                'status' ,
                'created_at',
                'updated_at',
            ]);
    }
}

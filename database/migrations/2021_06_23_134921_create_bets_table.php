<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->increments('betId')->from(3001)->unique();//注單編號
            $table->tinyInteger('gameId');//遊戲id
            $table->string('gameName', 50);//遊戲名稱
            $table->tinyInteger('gameType')->default(1);//遊戲類別
            $table->tinyInteger('playerId');//會員帳號 
            $table->decimal('stake',24, 2)->unsigned();//投注額
            $table->decimal('winning',24, 2)->unsigned();//派彩
            $table->decimal('GGR',24, 2);//銷售額
            $table->string('bureauNo', 20); //局號
            $table->tinyInteger('currency')->default(1);//幣別
            $table->dateTime('betTime')->default(DB::raw('CURRENT_TIMESTAMP'));//下注時間
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
    }
}

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
            $table->string('gameId', 50);//遊戲id
            $table->string('gameName', 50);//遊戲名稱
            $table->string('gameType', 32);//遊戲類別
            $table->string('playerId', 50);//會員帳號 
            $table->decimal('amount',24, 2)->unsigned();//投注額
            $table->decimal('payout',24, 2)->unsigned();//派彩
            $table->string('bureauNo', 20); //局號
            $table->string('currency')->default("RMB");//幣別
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

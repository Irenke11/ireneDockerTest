<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dailyBet', function (Blueprint $table) {
            $table->increments("id")->from(4001)->unique();
            $table->tinyInteger('gameType')->default(1);//遊戲類別
            $table->date('betsDay');//下注日期
            $table->mediumInteger('count');//注單量
            $table->tinyInteger('currency')->default(1);//幣別
            $table->decimal('allStake',24, 2)->unsigned();
            $table->decimal('allWinning',24, 2)->unsigned();
            $table->decimal('allGGR',24, 2);
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
        Schema::dropIfExists('dailyBet');
    }
}

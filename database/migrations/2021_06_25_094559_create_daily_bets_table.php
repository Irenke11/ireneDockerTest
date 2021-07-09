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
            $table->string('gameType', 32);
            $table->TIMESTAMP('betsDay');
            $table->string('count', 12);
            $table->string('currency')->default("RMB");//幣別
            $table->float('allAmount',24, 2)->unsigned();
            $table->float('allPayout',24, 2)->unsigned();
            $table->float('allProfit',24, 2);
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

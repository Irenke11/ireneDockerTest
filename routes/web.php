<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\View;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
   Route::get('/token', function () {
        return csrf_token(); 
    });
//玩家管理
Route::prefix('players')->group(function () {
    Route::get('all', [App\Http\Controllers\PlayersController::class, 'index'])->name('allPlayers'); //页面显示+查询
    Route::get('allData', [App\Http\Controllers\PlayersController::class, 'allData'])->name('allData');//數據API
    Route::get('add', [App\Http\Controllers\PlayersController::class, 'addPlayer'])->name('addPlayer'); //新增玩家页面
    Route::post('addData', [App\Http\Controllers\PlayersController::class, 'addData'])->name('addData'); //新增玩家
});
//游戲管理
Route::prefix('games')->group(function () {
    Route::get('all', [App\Http\Controllers\GamesController::class, 'index'])->name('allGames');//页面显示
    Route::get('allData', [App\Http\Controllers\GamesController::class, 'allData'])->name('allData');//遊戲數據API
    Route::get('edit/{id?}', [App\Http\Controllers\GamesController::class, 'editGame'])->name('editGame'); //編輯遊戲頁面
    Route::get('add', [App\Http\Controllers\GamesController::class, 'addGame'])->name('addGame'); //新增遊戲頁面
    Route::put('editData', [App\Http\Controllers\GamesController::class, 'editData'])->name('editData'); //新增|編輯遊戲
});
//注單管理
Route::prefix('bets')->group(function () {
    Route::get('all', [App\Http\Controllers\BetsController::class, 'index'])->name('allBets');//页面显示
    Route::get('allData', [App\Http\Controllers\BetsController::class, 'allData'])->name('allData');//遊戲數據API+查询
    // Route::post('/POST/addBet', [App\Http\Controllers\BetsController::class, 'addBet'])->name('addBet');//新增
    // Route::post('/POST/searchBets', [App\Http\Controllers\BetsController::class, 'index'])->name('searchBets'); //查询
    // Route::get('/GET/bets/{time}/{bureauNo}', [App\Http\Controllers\BetsController::class, 'index'])->name('bets');//页面显示+查询
});
//注單結算管理
Route::prefix('dailyBets')->group(function () {   
    Route::get('all', [App\Http\Controllers\DailyBetsController::class, 'index'])->name('allDailyBets');//页面显示
    Route::get('allData', [App\Http\Controllers\DailyBetsController::class, 'allData'])->name('allData');//數據API+查询
    // Route::post('/POST/daily', [App\Http\Controllers\DailyController::class, 'addDaily'])->name('daily');//結算(排程)
    // Route::get('/GET/daily/{day}', [App\Http\Controllers\DailyController::class, 'index'])->name('daily');//页面显示+查询
    // Route::post('/POST/addDaily', [App\Http\Controllers\DailyController::class, 'addDaily'])->name('addDaily');
    // Route::post('/POST/searchDaily', [App\Http\Controllers\DailyController::class, 'index'])->name('searchDaily');
});


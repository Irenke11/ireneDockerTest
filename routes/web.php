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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/GET/players', [App\Http\Controllers\PlayersController::class, 'index'])->name('players'); //页面显示+查询
    Route::get('/GET/playersData', [App\Http\Controllers\PlayersController::class, 'playersData'])->name('playersData');//數據API
    Route::get('/GET/addPlayer', [App\Http\Controllers\PlayersController::class, 'addPlayer'])->name('addPlayer'); //新增页面
    Route::post('/POST/addPlayerData', [App\Http\Controllers\PlayersController::class, 'addPlayerData'])->name('addPlayerData'); //新增页面
    // Route::post('/POST/editPlayers', [App\Http\Controllers\PlayersController::class, 'edit'])->name('editPlayers'); //编辑+删除/开启
Route::get('/GET/games', [App\Http\Controllers\GamesController::class, 'index'])->name('games');//页面显示+查询
    Route::get('/GET/gamesData', [App\Http\Controllers\GamesController::class, 'gamesData'])->name('gamesData');//遊戲數據API
    Route::get('/GET/editGame', [App\Http\Controllers\GamesController::class, 'editGame'])->name('editGame');//编辑&新增遊戲
    Route::post('/POST/editGameData', [App\Http\Controllers\GamesController::class, 'editGameData'])->name('editGameData'); //編輯遊戲post
Route::get('/GET/bets', [App\Http\Controllers\BetsController::class, 'index'])->name('bets');//页面显示+查询
Route::get('/GET/betsData', [App\Http\Controllers\BetsController::class, 'betsData'])->name('betsData');//遊戲數據API
    // Route::post('/POST/addBet', [App\Http\Controllers\BetsController::class, 'addBet'])->name('addBet');//新增
    // Route::post('/POST/searchBets', [App\Http\Controllers\BetsController::class, 'index'])->name('searchBets'); //查询
    // Route::get('/GET/bets/{time}/{bureauNo}', [App\Http\Controllers\BetsController::class, 'index'])->name('bets');//页面显示+查询
Route::get('/GET/dailyBets', [App\Http\Controllers\DailyBetsController::class, 'index'])->name('dailyBets');//页面显示+查询
Route::get('/GET/dailyBetsData', [App\Http\Controllers\DailyBetsController::class, 'dailyBetsData'])->name('dailyBetsData');//數據API
    // Route::post('/POST/daily', [App\Http\Controllers\DailyController::class, 'addDaily'])->name('daily');//結算(排程)
    // Route::get('/GET/daily/{day}', [App\Http\Controllers\DailyController::class, 'index'])->name('daily');//页面显示+查询
    // Route::post('/POST/addDaily', [App\Http\Controllers\DailyController::class, 'addDaily'])->name('addDaily');
    // Route::post('/POST/searchDaily', [App\Http\Controllers\DailyController::class, 'index'])->name('searchDaily');
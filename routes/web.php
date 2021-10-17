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
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\BetsController;
use App\Http\Controllers\DailyBetsController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
   Route::get('/token', function () {
        return csrf_token(); 
    });
//玩家管理
Route::prefix('players')->group(function () {
    Route::get('all', [PlayersController::class, 'index'])->name('allPlayers'); //页面显示+查询
    Route::get('allData', [PlayersController::class, 'allData'])->name('allData');//數據API
    Route::get('add', [PlayersController::class, 'addPlayer'])->name('addPlayer'); //新增玩家页面
    Route::post('addData', [PlayersController::class, 'addData'])->name('addData'); //新增玩家
    Route::get('edit/{id?}', [PlayersController::class, 'edit'])->name('edit'); //編輯玩家頁面
    Route::post('restorePassword', [PlayersController::class, 'restorePassword'])->name('restorePassword'); //密碼回復默認值
});
//游戲管理
Route::prefix('games')->group(function () {
    Route::get('all', [GamesController::class, 'index'])->name('allGames');//页面显示
    Route::get('allData', [GamesController::class, 'allData'])->name('allData');//遊戲數據API
    Route::get('edit/{id?}', [GamesController::class, 'editGame'])->name('editGame'); //編輯遊戲頁面
    Route::get('add', [GamesController::class, 'addGame'])->name('addGame'); //新增遊戲頁面
    Route::put('editData', [GamesController::class, 'editData'])->name('editData'); //新增|編輯遊戲
});
//注單管理
Route::prefix('bets')->group(function () {
    Route::get('all', [BetsController::class, 'index'])->name('allBets');//页面显示
    Route::get('allData', [BetsController::class, 'allData'])->name('allData');//遊戲數據API+查询
    Route::get('barChart', [BetsController::class, 'barChart'])->name('barChart');//view
    Route::post('barChartData', [BetsController::class, 'barChartData'])->name('barChartData');//遊戲數據API
    // Route::post('/POST/addBet', [BetsController::class, 'addBet'])->name('addBet');//新增
    // Route::post('/POST/searchBets', [BetsController::class, 'index'])->name('searchBets'); //查询
    // Route::get('/GET/bets/{time}/{bureauNo}', [BetsController::class, 'index'])->name('bets');//页面显示+查询
});
//注單結算管理
Route::prefix('dailyBets')->group(function () {   
    Route::get('all', [DailyBetsController::class, 'index'])->name('allDailyBets');//页面显示
    Route::get('allData', [DailyBetsController::class, 'allData'])->name('allData');//數據API+查询
    // Route::post('/POST/daily', [DailyController::class, 'addDaily'])->name('daily');//結算(排程)
    // Route::get('/GET/daily/{day}', [DailyController::class, 'index'])->name('daily');//页面显示+查询
    // Route::post('/POST/addDaily', [DailyController::class, 'addDaily'])->name('addDaily');
    // Route::post('/POST/searchDaily', [DailyController::class, 'index'])->name('searchDaily');
});

//玩家管理
Route::prefix('userAG')->group(function () {
    Route::get('all', [PlayersController::class, 'showAG'])->name('allUserAG'); //页面显示+查询
});


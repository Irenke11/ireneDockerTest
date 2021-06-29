<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\bets;
use DB;
class dailyBets extends Model
{
    protected $table = 'dailyBet';
    protected $primaryKey = 'id';
    protected $fillable = [
        'gameType',
        'betsDay',
        'count',
        'allAmount',
        'allPayout',
        'allProfit',
    ];
    
    public static function getAllInfo($sortBy, $orderBy, $searchValue){
        $dailyBets = dailyBets::orderBy($sortBy, $orderBy)
                        ->distinct();  
        // if (isset($searchValue)) {
        //     $Players->orwhere("name", 'like', '%'.$searchValue.'%') 
        //         // ->orwhere('playerId', $searchValue)
        //         ->orwhere('account', 'like', '%'.$searchValue.'%');
        // }    

        return $dailyBets;
    }

    public static function checkSchedule($dayTime = null,$gameType =null){
        $Dailycount = dailyBets::whereBetween('betsDay', [$dayTime["startTime"],$dayTime["endTime"]])
        ->where('gameType', '=', $gameType)
        ->count();
        return $Dailycount;
    }

    public static function dailyBets($dayTime,$gameType){
        
        $dailyBets= Bets::select(
                        DB::raw('count(*) as count'),
                        DB::raw('SUM(amount) as allAmount'),
                        DB::raw('SUM(payout) as allPayout'),
                        DB::raw('(SUM(payout) - SUM(amount)) as allProfit')
                    )->whereBetween('betTime', [$dayTime["startTime"],$dayTime["endTime"]])
                    ->where('gameType',"=",$gameType)
                    ->first();
                    // ->join('games', 'bets.gameId', '=', 'games.gameId')
        // print("<pre>".print_r($dailyBets,true)."</pre>");
        return $dailyBets;
    }
    public static function addSchedule($request){
        //  print("<pre>".print_r($request,true)."</pre>");
        $Schedule = new dailyBets;
        $Schedule->gameType  = $request->gameType;
        $Schedule->betsDay   = $request->betsDay;
        $Schedule->count     = $request->count ?? 0;
        $Schedule->allAmount = $request->allAmount ?? 0;
        $Schedule->allPayout = $request->allPayout ?? 0;
        $Schedule->allProfit = $request->allProfit ?? 0;
        $Schedule->save();
        // print("<pre>".print_r($Schedule,true)."</pre>");
    }
    public static function updateSchedule($day = null,$game = null){
        $Schedule = dailyBets::where('betsDay',"=",$day)->and("gameType","=",$game)->get();
        $Schedule->gameType  = $request->gameType;
        $Schedule->betsDay   = $request->betsDay;
        $Schedule->count     = $request->count ?? 0;
        $Schedule->allAmount = $request->allAmount ?? 0;
        $Schedule->allPayout = $request->allPayout ?? 0;
        $Schedule->allProfit = $request->allProfit ?? 0;
        $Schedule->save();
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\bets;
use DB;
use Carbon\Carbon;
class dailyBets extends Model
{
    protected $table = 'dailyBet';
    protected $primaryKey = 'id';
    protected $fillable = [
        'gameType',
        'betsDay',
        'count',
        'allStake',
        'allWinning',
        'allGGR',
    ];
    
    public static function getAllInfo($sortBy, $orderBy, $searchValue){
        $query = dailyBets::orderBy($sortBy, $orderBy)
                        ->distinct();  
        if (!isset($searchValue["datepicker"])) {
            $searchValue["datepicker"] = Carbon::today(); 
        } 
        if (isset($searchValue['currency'])) {
            $query->where("currency", '=', $searchValue['currency']);
        }
        if (isset($searchValue['gametype'])) {
            $query->where("gametype", '=', $searchValue['gametype']);
        }
        if (isset($searchValue["startTime"]) & isset($searchValue["endTime"])) {
            $query->whereBetween('betsDay', [$searchValue["datepicker"]." ".$searchValue["startTime"], $searchValue["datepicker"].' '.$searchValue["endTime"]]);
        }else{
            $query->whereBetween('betsDay', [$searchValue["datepicker"].' 00:00:00', $searchValue["datepicker"].' 23:59:59']);
        }
                      
        return $query;
    }

    public static function checkSchedule($dayTime,$gameType,$currency){
        $Dailycount = dailyBets::whereBetween('betsDay', [$dayTime["startTime"],$dayTime["endTime"]])
        ->where('gameType', '=', $gameType)
        ->where('currency', '=', $currency)
        ->count();
        
        return $Dailycount;
    }

    public static function dailyBets($dayTime,$gameType,$currency){
        
        $dailyBets= Bets::select(
                        DB::raw('count(*) as count'),
                        DB::raw('SUM(stake) as allStake'),
                        DB::raw('SUM(winning) as allWinning'),
                        DB::raw('SUM(stake)-SUM(winning) as allGGR')
                    )->whereBetween('betTime', [$dayTime["startTime"],$dayTime["endTime"]])->where('gameType', "=", $gameType)->where('currency', '=', $currency)->first();
        // print("<pre>".print_r($dailyBets,true)."</pre>");
        return $dailyBets;
    }
    public static function dailyBetsAll($dayTime,$currency){
        
        $dailyBets= Bets::select(
                        DB::raw('count(*) as count'),
                        DB::raw('SUM(stake) as allStake'),
                        DB::raw('SUM(winning) as allWinning'),
                        DB::raw('SUM(stake)-SUM(winning) as allGGR')
                    )->whereBetween('betTime', [$dayTime["startTime"],$dayTime["endTime"]])
                    ->where('currency', '=', $currency)
                    ->first();
        // print("<pre>".print_r($dailyBets,true)."</pre>");
        return $dailyBets;
    }
    public static function addSchedule($request){
        //  print("<pre>".print_r($request,true)."</pre>");
        $Schedule = new dailyBets;
        $Schedule->gameType  = $request->gameType;
        $Schedule->betsDay   = $request->betsDay;
        $Schedule->currency  = $request->currency;
        $Schedule->count     = $request->count ?? 0;
        $Schedule->allStake  = $request->allStake ?? 0; 
        $Schedule->allWinning= $request->allWinning ?? 0;
        $Schedule->allGGR    = $request->allGGR ?? 0;
        $Schedule->save();
        // print("<pre>".print_r($Schedule,true)."</pre>");
    }
    public static function updateSchedule($day = null,$game = null){
        $Schedule = dailyBets::where('betsDay',"=",$day)->and("gameType","=",$game)->get();
        $Schedule->gameType  = $request->gameType;
        $Schedule->betsDay   = $request->betsDay;
        $Schedule->currency  = $request->currency;
        $Schedule->count     = $request->count ?? 0;
        $Schedule->allStake  = $request->allStake ?? 0;
        $Schedule->allWinning= $request->allWinning ?? 0;
        $Schedule->allGGR    = $request->allGGR ?? 0;
        $Schedule->save();
    }

}

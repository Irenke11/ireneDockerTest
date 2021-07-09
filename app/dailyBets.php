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
        'allAmount',
        'allPayout',
        'allProfit',
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
                        DB::raw('SUM(amount) as allAmount'),
                        DB::raw('SUM(payout) as allPayout'),
                        DB::raw('SUM(payout)-SUM(amount) as allProfit')
                    )->whereBetween('betTime', [$dayTime["startTime"],$dayTime["endTime"]])->where('gameType', "=", $gameType)->where('currency', '=', $currency)->first();
        // print("<pre>".print_r($dailyBets,true)."</pre>");
        return $dailyBets;
    }
    public static function dailyBetsAll($dayTime,$currency){
        
        $dailyBets= Bets::select(
                        DB::raw('count(*) as count'),
                        DB::raw('SUM(amount) as allAmount'),
                        DB::raw('SUM(payout) as allPayout'),
                        DB::raw('SUM(payout)-SUM(amount) as allProfit')
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
        $Schedule->currency  = $request->currency;
        $Schedule->count     = $request->count ?? 0;
        $Schedule->allAmount = $request->allAmount ?? 0;
        $Schedule->allPayout = $request->allPayout ?? 0;
        $Schedule->allProfit = $request->allProfit ?? 0;
        $Schedule->save();
    }

}

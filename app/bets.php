<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
class bets extends Model
{
    protected $table = 'bets';
    protected $primaryKey = 'betId';
    protected $fillable = [
        'gameId',
        'playerId',
        'stake',
        'winning',
        'GGR',
    ];

    public static function getAllInfo($sortBy, $orderBy,$searchValue){
        $query = Bets::orderBy($sortBy, $orderBy)
                        ->distinct();
        if (!isset($searchValue["datepicker"])) {
            $searchValue["datepicker"] = Carbon::now()->toDateString();
        } 
        if (isset($searchValue["startTime"]) & isset($searchValue["endTime"])) {
            $query->whereBetween('betTime', [$searchValue["datepicker"]." ".$searchValue["startTime"], $searchValue["datepicker"].' '.$searchValue["endTime"]]);
        }else{
            $query->whereBetween('betTime', [$searchValue["datepicker"].' 00:00:00', $searchValue["datepicker"].' 23:59:59']);
        }  
        if (isset($searchValue['betId'])) {
            $query->where("betId", '=', $searchValue['betId']);
        }
        if (isset($searchValue['playerId'])) {
            $query->where("playerId", '=', $searchValue['playerId']);
        }
        if (isset($searchValue['currency'])) {
            $query->where("currency", '=', $searchValue['currency']);
        }
        if (isset($searchValue['bureauNo'])) {
            $query->where("bureauNo", '=', $searchValue['bureauNo']);
        }
        return $query;
    }

    public static function getDataByTime($request){
        $query= Bets::whereBetween('betTime', [$request["startDate"].' 00:00:00', $request["endDate"].' 23:59:59'])->select(
            "gameId",
            "gameName",
            DB::raw('count(gameId) as count')
        )->groupBy('gameId',"gameName")->get();
        return $query;
    }

    public static function getStakeByTime($request){
        $query= Bets::whereBetween('betTime', [$request["startDate"].' 00:00:00', $request["endDate"].' 23:59:59'])->select(
            "gameId",
            "gameName",
            DB::raw('sum(stake*rate) as stake')
        )->groupBy('gameId',"gameName")->get();
        return $query;
    }

    public static function getGGRByTime($request){
        $query= Bets::whereBetween('betTime', [$request["startDate"].' 00:00:00', $request["endDate"].' 23:59:59'])->select(
            "gameId",
            "gameName",
            DB::raw('sum(GGR*rate) as GGR')
        )->groupBy('gameId',"gameName")->get();
        // print("<pre>".print_r($query,true)."</pre>");
        return $query;
    }
        
}

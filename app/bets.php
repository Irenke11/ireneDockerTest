<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
            $searchValue["datepicker"] = Carbon::today(); 
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
    //   public static function getLastInsertId(){
    //     $id = "SELECT LAST_INSERT_ID() INTO yourTableName;"
    //     return $id;
    //   }

}

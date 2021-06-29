<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bets extends Model
{
    protected $table = 'bets';
    protected $primaryKey = 'betId';
    protected $fillable = [
        'gameId',
        'playerId',
        'amount',
        'payout',
    ];

    public static function getAllInfo($sortBy, $orderBy,$datevalue){
        $Bets = Bets::orderBy($sortBy, $orderBy)
                        ->distinct();  
        if (isset($datevalue['bureauNo'])) {
            $Bets->where("bureauNo", '=', $datevalue['bureauNo']);
        }
        if (isset($datevalue['betId'])) {
            $Bets->where("betId", '=', $datevalue['betId']);
        }
        if (isset($datevalue['playerId'])) {
            $Bets->where("playerId", '=', $datevalue['playerId']);
        }
        if (isset($datevalue['currency'])) {
            $Bets->where("currency", '=', $datevalue['currency']);
        }
        if (isset($datevalue["datepicker"])) {
            if (isset($datevalue["startTime"]) & isset($datevalue["endTime"])) {
                $Bets->whereBetween('betTime', [$datevalue["datepicker"]." ".$datevalue["startTime"], $datevalue["datepicker"].' '.$datevalue["endTime"]]);
            }else{
                $Bets->whereBetween('betTime', [$datevalue["datepicker"], $datevalue["datepicker"].' 23:59:59']);
            }
        }

        return $Bets;
    }
    

}

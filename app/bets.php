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

    public static function getAllInfo($sortBy, $orderBy,$Daytime){
        $Bets = Bets::orderBy($sortBy, $orderBy)
                        ->distinct();  
        return $Bets;
    }

}

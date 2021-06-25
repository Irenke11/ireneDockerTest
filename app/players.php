<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class players extends Model
{
    protected $table = 'players';
    protected $primaryKey = 'playerId';
    protected $fillable = [
        'name',
        'account',
        'currency',
        'status',
        'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function getAllInfo($sortBy, $orderBy, $searchValue){
        $Players = Players::orderBy($sortBy, $orderBy)
                        ->distinct();  
        return $Players;
    }

    public static function searchPlayerInfo($search){

        if(isset($search)){
            foreach($search as $name => $value){
                if(isset($value)){
                    $PlayersearchInfo = Players::where($name, 'like', '%'.$value.'%')
                    ->distinct()
                    ->get();  
                }
            }
        }else{
        $PlayersearchInfo = Players::where('name', 'like', '%'.$search['name'].'%')
                                ->orwhere('playerId', 'like', '%'.$search['playerId'].'%')
                                ->orwhere('account', 'like', '%'.$search['account'].'%')
                                ->distinct()
                                ->get();
        }
     
        return $PlayersearchInfo;
    }
    public static function getAllPlayers(){
        $PlayerInfo = Players::select('playerId')->get();
        return $PlayerInfo;
    }

    public static function getPlayerInfoById($playerId){
        $PlayerInfo = Players::where('playerId', '=', $playerId)->first();
        return $PlayerInfo;
    }

    public static function getPlayerInfoByAccount($account){
        $PlayerInfo = Players::where('account', '=', $account)->get();
        return $PlayerInfo;
    }

    public static function getPlayerInfoByName($name){
        $PlayerInfo = Players::where('name', '=', $name)->get();
        return $PlayerInfo;
    }
    
    public static function getPlayerInfoByCurrency($currency){
        $PlayerInfo = Players::where('currency', '=', $currency)->get();
        return $PlayerInfo;
    }
}

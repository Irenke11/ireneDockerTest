<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Response;

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
        $query = Players::orderBy($sortBy, $orderBy)->distinct();  
        if (isset($searchValue["search"])) {
            $query->where("name", 'like', '%'.$searchValue["search"].'%')
            ->orwhere('account', 'like', '%'.$searchValue["search"].'%');
        }
        if (isset($searchValue["currency"])) {
            $query->where("currency","=", $searchValue["currency"]);
        }
        if (isset($searchValue["playerId"])) {
            $query->where("playerId","=", $searchValue["playerId"]);
        }
        return $query;
    }

    public static function addPlayer($request){
        $query = new Players;
        $query->account   = $request->account;
        $query->name      = $request->name;
        $query->password  = $request->password;
        $query->currency  = $request->currency;
        $query->save();
        return $query;
    }

    public static function editPlayerById($request){
        $query = Players::where("playerId","=",$request['playerId'])->first();
        $query->account   = $request->account;
        $query->name      = $request->name;
        $query->password  = $request->password;
        $query->currency  = $request->currency;
        $query->save();
        return $query;
    }
    public static function getAll(){
        $PlayerInfo = Players::all();
        return $PlayerInfo;
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

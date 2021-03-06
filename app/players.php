<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

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
        $query->password  = Hash::make($request->password);
        $query->currency  = $request->currency;
        $query->status    = $request->status;
        $query->save();
        return $query;
    }

    // public static function editPlayerById($request){
    //     $query = Players::where("playerId","=",$request['playerId'])->first();
    //     $query->account   = $request->account;
    //     $query->name      = $request->name;
    //     $query->password  = $request->password;
    //     $query->currency  = $request->currency;
    //     $query->status    = $request->status;
    //     $query->save();
    //     return $query;
    // }
    public static function getAll(){
        $query = Players::all();
        return $query;
    }

    public static function getAllPlayers(){
        $query = Players::select('playerId')->get();
        return $query;
    }

    public static function getPlayerInfoById($playerId){
        $query = Players::where('playerId', '=', $playerId)->first();
        return $query;
    }
    public static function restore($playerId){
        $query = Players::where('playerId', '=', $playerId)->first();
        $query->password  = Hash::make('123456');
        $query->save();
        return $query;
    }

    public static function editPlayerById($request)
    {   
        $query = Players::where("playerId","=",$request['playerId'])->first();
        $query->name      = $request->name;
        // $query->password  = $request->password;
        $query->currency  = $request->currency;
        $query->status    = $request->status;
        $query->save();
        return $query;
    }

    public static function getPlayerInfoByAccount($account){
        $query = Players::where('account', '=', $account)->get();
        return $query;
    }

    public static function getPlayerInfoByName($name){
        $query = Players::where('name', '=', $name)->get();
        return $query;
    }
    
    public static function getPlayerInfoByCurrency($currency){
        $query = Players::where('currency', '=', $currency)->get();
        return $query;
    }
}

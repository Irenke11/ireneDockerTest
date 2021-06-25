<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class games extends Model
{
    protected $table = 'games';
    protected $primaryKey = 'gameId';
    protected $fillable = [
        'gameType',
        'gameName',
        'status',
    ];
    public static function getAllInfo($sortBy, $orderBy, $searchValue){
        $Games = Games::orderBy($sortBy, $orderBy)
                        ->distinct();  
        // if (isset($searchValue)) {
        //     $Players->orwhere("name", 'like', '%'.$searchValue.'%') 
        //         // ->orwhere('playerId', $searchValue)
        //         ->orwhere('account', 'like', '%'.$searchValue.'%');
        // }    

        return $Games;
    }
    public static function getInfoById($gameId){
        $Games = Games::where("gameId","=",$gameId)->first();
        //     $Players->orwhere("name", 'like', '%'.$searchValue.'%') 
        //         // ->orwhere('playerId', $searchValue)
        //         ->orwhere('account', 'like', '%'.$searchValue.'%');
        // }    

        return $Games;
    }

    public static function editGameById($request)
    {   
        $Games = Games::where("gameId","=",$request['gameId'])->first();
        $Games->gameName  =  $request->gameName;
        $Games->gameType  = $request->gameType;
        $Games->status    = $request->status;
        $Games->save();

        return $Games;
    }
    public static function addGame($request)
    {   
        $Games = new Games;
        $Games->gameId  =  $request->gameId;
        $Games->gameName  =  $request->gameName;
        $Games->gameType  = $request->gameType;
        $Games->status    = $request->status;
        $Games->save();

        return $Games;
    }

}

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
        $query = Games::orderBy($sortBy, $orderBy)
                        ->distinct();  
        if (isset($searchValue["gameName"])) {
            $query->where("gameName", 'like', '%'.$searchValue["gameName"].'%');
        }
        if (isset($searchValue['gameType'])) {
            $query->where("gameType","=", $searchValue['gameType']);
        }
        if (isset($searchValue['gameId'])) {
            $query->where("gameId","=", $searchValue['gameId']);
        } 

        return $query;
    }

    public static function getInfoById($gameId){
        $query = Games::where("gameId","=",$gameId)->first();
        return $query;
    }

    public static function editGameById($request)
    {   
        $query = Games::where("gameId","=",$request['gameId'])->first();
        $query->gameName  = $request->gameName;
        $query->gameType  = $request->gameType;
        $query->status    = $request->status;
        $query->save();

        return $query;
    }
    public static function addGame($request)
    {   
        $query = new Games;
        // $query->gameId   = $request->gameId;
        $query->gameName = $request->gameName;
        $query->gameType = $request->gameType;
        $query->status   = $request->status;
        $query->save();

        return $query;
    }

    public static function getOpenGames(){
        $query = Games::select("gameId","gameName")->pluck('gameId');
        return $query;
    }

    public static function getAll(){
        $query = Games::all();
        return $query;
    }
    

}

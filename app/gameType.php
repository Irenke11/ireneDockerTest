<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gameType extends Model
{
    public static function getAllGameType(){
        $query = gameType::all();
        return $query;
    }
    public static function getOpenGameType(){
        $query = gameType::select("id")->where("status","=",1)->get();
        return $query;
    }
    public static function getOpenGameTypeArray(){
        $request["gametypeList"]=config('setting.gametype');
        $request["openGameTypeList"]=json_decode(gameType::getOpenGameType(),true);
        foreach ($request["openGameTypeList"] as $key => $value) {
           $query[$value["id"]]=$request["gametypeList"][$value["id"]];
        }
        return $query;
    }
}

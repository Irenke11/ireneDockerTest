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
}

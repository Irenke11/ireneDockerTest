<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    public static function getAllCurrency(){
        $query = currency::all();
        return $query;
    }
    public static function getOpenCurrency(){
        $query = currency::select("id")->where("status","=",1)->get();
        return $query;
    }
}

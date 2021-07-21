<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    public static function getAllCurrency(){
        $query = currency::all();
        return $query;
    }

    public static function getCurrencyById($id){
        $query = currency::where("id","=",$id)->first();
        return $query;
    }

    public static function getOpenCurrency(){
        $query = currency::select("id")->where("status","=",1)->get();
        return $query;
    }

    public static function getOpenCurrencyArray(){
        $request["currencyList"]=config('setting.currency');
        $request["openCurrencyList"]=json_decode(currency::getOpenCurrency(),true);
        foreach ($request["openCurrencyList"] as $key => $value) {
           $query[$value["id"]]=$request["currencyList"][$value["id"]];
        }
        return $query;
    }
}

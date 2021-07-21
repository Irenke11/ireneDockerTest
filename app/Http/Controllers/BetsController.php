<?php

namespace App\Http\Controllers;

use App\bets;
use App\games;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\MessageBag;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Validation\ValidationException;
use App\currency;
use Carbon\Carbon;
class BetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request["currencyList"]=currency::getOpenCurrencyArray();
        $request["configCurrency"]=config('setting.currency');
        return view('backend.bets',$request);
    }
    public function allData(Request $request)
    {
        $length = $request->input('length')??100;
        $sortBy = $request->input('column')??"betId";
        $orderBy = $request->input('dir')??"desc";
        $searchValue["currency"]=$request->input('currency');
        $searchValue["bureauNo"]=$request->input('bureauNo');
        $searchValue["betId"]= $request->input('betId');
        $searchValue["playerId"]=$request->input('playerId');
        $searchValue["startTime"]=$request->input('startTime');
        $searchValue["endTime"]=$request->input('endTime');
        $searchValue["datepicker"]= $request->input('datepicker');
        $query = bets::getAllInfo($sortBy, $orderBy,$searchValue);
        $data = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }

    public function barChart(Request $request)
    {
        // $request["startDate"]= $request->input('startDate')?? date("Y-m-d", strtotime('-2 days'));
        // $request["endDate"]= $request->input('endDate')?? date("Y-m-d");
        // $getOpenGames=json_decode(Games::getOpenGames($request),true);
        // $getDataByTime=json_decode(bets::getDataByTime($request),true);
        // dd($getOpenGames,$getDataByTime);
       return view('backend.barChart',$request);
    }

    public function barChartData(Request $request)
    {
        $count=[];
        $responseArray=[];
        $stake=[];
        $GGR=[];
        $setting1=[];
        $setting2=[];
        $setting3=[];
        $request["startDate"]= $request->input('startDate')?? date("Y-m-d", strtotime('-2 days'));
        $request["endDate"]= $request->input('endDate')?? date("Y-m-d");
        $responseArray["dateRange"]["startDate"]=$request["startDate"];
        $responseArray["dateRange"]["endDate"]=$request["endDate"];
        $getOpenGames=json_decode(Games::getOpenGames($request),true);
        
        $getDataByTime=json_decode(bets::getDataByTime($request),true);
        foreach ($getDataByTime as $key => $value) {
            if(in_array($value["gameId"], $getOpenGames)){
                $count[]=$value["count"];
                $setting1["labels"][]=$value["gameName"];
            }
         
        }
        if($getDataByTime==[]){
            $responseArray["noData"]=true;
        }
        $getStakeByTime=json_decode(bets::getStakeByTime($request),true);
        foreach ($getStakeByTime as $key => $value) {
            if(in_array($value["gameId"], $getOpenGames)){
                $stake[]=round($value["stake"],2);
                $setting2["labels"][]=$value["gameName"];
            }
        }
        $getGGRByTime=json_decode(bets::getGGRByTime($request),true);
        foreach ($getGGRByTime as $key => $value) {
            if(in_array($value["gameId"], $getOpenGames)){
                $GGR[]=round($value["GGR"],2);
                $setting3["labels"][]=$value["gameName"];
            }
        }
        //單量資料
        $setting1["datasets"][]=["data"=>$count,
                                "label"=>"單量",
                                "borderColor"=> 'red',
                                "pointBackgroundColor"=> 'red',
                                 "backgroundColor"=>'#f87979',
                                "borderWidth"=> 1,
                                "pointBorderColor"=> 'white',
                            ]; 
        $responseArray["test"][]=$setting1;
        // 下注量       
        $setting2["datasets"][]=["data"=>$stake,
                                "label"=>"下注額(RMB)",
                                "borderColor"=> 'blue',
                                "pointBackgroundColor"=> 'blue',
                                "backgroundColor"=>'#4ba2f9',
                                "borderWidth"=> 1,
                                "pointBorderColor"=> 'white',]; 
        $responseArray["test"][]=$setting2;
                // 下注量       
        $setting3["datasets"][]=["data"=>$GGR,
                                "label"=>"GGR",
                                "borderColor"=> 'yellow',
                                "pointBackgroundColor"=> 'yellow',
                                "backgroundColor"=>'#ffc107',
                                "borderWidth"=> 1,
                                "pointBorderColor"=> 'white',]; 
        $responseArray["test"][]=$setting3;
        
        //初始
        $responseArray["chartdataloaded"]=$setting1; 

        return $responseArray;
    }


}

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
use App\gameType;
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
        $request["currencyList"]=config('setting.currency');
        $request["openCurrencyList"]=currency::getOpenCurrencyArray();
        $request["gametypeList"]=config('setting.gametype');
        $request["openGameTypeList"]=gameType::getOpenGameTypeArray();
        $request["statDate"]= $request->input('startDate')?? date("Y-m-d", strtotime('-10 days'));
        $request["endDate"]= $request->input('endDate')?? date("Y-m-d");
       return view('backend.barChart',$request);
    }

    public function randColor()
    {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
        return $color; 
    }

    public function barChartData(Request $request)
    {
        $count=[];
        $count11=[];
        $responseArray=[];
        $stake=[];
        $GGR=[];
        $setting1=[];
        $setting2=[];
        $setting3=[];
        $setting11=[];
        $setting22=[];
        $setting33=[];

        $request["gametype"]=$request->input('gametype');
        $request["currency"]=$request->input('currency');
        $request["startDate"]= $request->input('dateRange.startDate')?? date("Y-m-d", strtotime('-1 days'));
        $request["endDate"]= $request->input('dateRange.endDate')?? date("Y-m-d");

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
        $getStakeByTime=bets::getStakeByTime($request);
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
        // //new --getDataGroupByBetTime
        // $getDataByTime=json_decode(bets::getDataGroupByBetTime($request),true);
        // foreach ($getDataByTime as $key => $value) {
        //         $count11[]=$value["count"];
        //         $setting11["labels"][]=$value["betTime"];
        // }
       
        // $setting11["datasets"][]=["data"=>$count11,
        //                         "label"=>"Order",
        //                         // "borderColor"=> 'red',
        //                         "pointBackgroundColor"=> 'red',
        //                          "backgroundColor"=>[
        //                                             "#930000", 
        //                                             "#AE0000", 
        //                                             "#CE0000",
        //                                             "#EA0000",
        //                                             "#FF0000",
        //                                             "#FF2D2D",
        //                                             "#FF5151",
        //                                             "#FF7575", 
        //                                             "#FF9797",
        //                                             "#FFB5B5",
        //                                             "#FFD2D2",
        //                                             "#FFECEC"],
        //                         "borderWidth"=> 1,
        //                         "pointBorderColor"=> 'white',
        //                     ]; 
        // $responseArray["test2"][]=$setting11;
        // //new

        //單量資料
        $setting1["datasets"][]=["data"=>$count,
                                "label"=>$request["startDate"]."~".$request["endDate"]." Order Quantity of Game",
                                "select"=>"Order Quantity",
                                // "borderColor"=> 'red',
                                "pointBackgroundColor"=> 'red',
                                 "backgroundColor"=>'red',
                                "borderWidth"=> 1,
                                "pointBorderColor"=> 'white',
                            ]; 
        $responseArray["test"][]=$setting1;
        // 下注量       
        $setting2["datasets"][]=["data"=>$stake,
                                "label"=>$request["startDate"]."~".$request["endDate"]." Betting Amount of Game (RMB)",
                                "select"=>"Betting Amount",
                                "borderColor"=> 'blue',
                                "pointBackgroundColor"=> 'blue',
                                "backgroundColor"=> 'blue',
                                "borderWidth"=> 1,
                                "pointBorderColor"=> 'white',]; 
        $responseArray["test"][]=$setting2;
                // 下注量       
        $setting3["datasets"][]=["data"=>$GGR,
                                "label"=>$request["startDate"]."~".$request["endDate"]." Revenue",
                                "select"=>"Revenue",
                                "borderColor"=> 'yellow',
                                "pointBackgroundColor"=> 'yellow',
                                "backgroundColor"=> 'yellow',
                                "borderWidth"=> 1,
                                "pointBorderColor"=> 'white',]; 
        $responseArray["test"][]=$setting3;
        
        //初始
        $responseArray["chartdataloaded"]=$setting1; 

        return $responseArray;
    }


}

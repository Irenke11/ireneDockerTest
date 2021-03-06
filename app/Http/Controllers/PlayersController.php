<?php

namespace App\Http\Controllers;

use App\players as Players;
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
use Illuminate\Http\Response;
use App\currency;
use Symfony\component\Http;
class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request["currencyList"]=config('setting.currency');
        $request["openCurrencylist"]=currency::getOpenCurrency();
        $request["playerInfo"]= [];
        return view('backend.players',$request);
    }
    public function showAG(Request $request)
    {
        $request["currencyList"]=config('setting.currency');
        $request["openCurrencylist"]=currency::getOpenCurrency();
        $request["playerInfo"]= [];
        return view('backend.userAG',$request);
    }
    public function allData(Request $request)
    {   
        $length = $request->input('length')??100;
        $sortBy = $request->input('column')??"playerId";
        $orderBy = $request->input('dir')??"desc";
        $searchValue["search"]=$request->input('search');
        $searchValue["currency"]=$request->input('currency');
        $searchValue["playerId"]=$request->input('playerId');
        // $searchValue["currencyList"]=config('setting.currency');
        // $searchValue["openCurrencylist"]=currency::getOpenCurrency();
        $query = Players::getAllInfo($sortBy, $orderBy, $searchValue);
        $data = $query->paginate($length);
        // $data['payload']["currencyList"]=config('setting.currency');
        return new DataTableCollectionResource($data);
    }
    public function addPlayer(Request $request)
    {
        $request["currencyList"]=config('setting.currency');
        $request["getOpenCurrency"]=array_column(json_decode(currency::getOpenCurrency()), 'id');
        
        foreach ($request["getOpenCurrency"] as $key => $value) {
           $openCurrencylist[$value]=$request["currencyList"][$value];
        }
        $request["openCurrencylist"]=$openCurrencylist;
        return view('backend.addPlayer',$request);
    }

    public function addData(Request $request)
    {
        $request["currencyList"]=config('setting.currency');
        $request["openCurrencylist"]=currency::getOpenCurrency();
        try {
            $checkPlayers = Players::getPlayerInfoById($request->playerId);
            if(!is_null($checkPlayers) ){
                $validator = $request->validate([  
                    'playerId' => ['required', 'integer'],
                    // 'account' => ['required', 'email', 'string','min:6', 'max:30'],
                    'name' => ['required', 'string', 'min:6', 'max:20'],
                    // 'password' => ['required','alpha_num', 'string', 'min:6','max:20'], 
                    'currency' => ['required', 'integer'],
                    'status' => ['required', 'integer'],
                ]);
                $Players = Players::editPlayerById($request); //??????
            }else{
                $validator = $request->validate([  
                    'account' => ['required', 'email', 'string','min:6', 'max:30',"unique:players,account"],
                    'name' => ['required', 'string', 'min:6', 'max:20',"unique:players,name"],
                    'password' => ['required','alpha_num', 'string', 'min:6','max:20'], 
                    'currency' => ['required', 'integer'],
                    'status' => ['required', 'integer'],
                ]);
                $Players = Players::addPlayer($request); //??????
            }
            return response()->json([
                'code' => '201',
                'status' => 'success',
                'msg'    => 'Okay',
            ], 201);
        }catch (ValidationException $exception) {
            return response()->json([
                'code' => '422',
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function edit(Request $request)
    {
        $playerId=request()->segment(count(request()->segments()));
        $request["currencyList"]=config('setting.currency');
        $request["getOpenCurrency"]=array_column(json_decode(currency::getOpenCurrency()), 'id');
        foreach ($request["getOpenCurrency"] as $key => $value) {
           $openCurrencylist[$value]=$request["currencyList"][$value];
        }
        $request["openCurrencylist"]=$openCurrencylist;
        $request["playerInfo"]= Players::getPlayerInfoById($playerId);
        $request["playerId"]=$playerId;
        return view('backend.addPlayer',$request);
    }
    
    public function restorePassword(Request $request)
    { 
        $data["playerId"]=$request->input('playerId');
        $query=Players::restore($data["playerId"]);
        return $query;
        // return response()->noContent(Respones::HTTP_CREATED);
    }
}


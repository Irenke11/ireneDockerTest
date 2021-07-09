<?php

namespace App\Http\Controllers;

use App\bets;
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

class BetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request["currencyList"]=config('setting.currency');
        $request["gametypeList"]=config('setting.gametype');
        return view('backend.bets',$request);
    }
    public function allData(Request $request)
    {
        $length = $request->input('length')??"100";
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
}

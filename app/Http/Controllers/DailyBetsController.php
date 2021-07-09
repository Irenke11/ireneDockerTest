<?php

namespace App\Http\Controllers;

use App\dailyBets;
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

class DailyBetsController extends Controller
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
        return view('backend.dailyBets',$request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allData(Request $request)
    {
        $length = $request->input('length')??"100";
        $sortBy = $request->input('column')??"id";
        $orderBy = $request->input('dir')??"desc";
        $searchValue["startTime"]=$request->input('startTime');
        $searchValue["endTime"]=$request->input('endTime');
        $searchValue["datepicker"]=$request->input('datepicker');
        $searchValue["gametype"]=$request->input('gametype');
        $searchValue["currency"]=$request->input('currency');
        $query = dailyBets::getAllInfo($sortBy, $orderBy, $searchValue);
        $data = $query->paginate($length); 
        return new DataTableCollectionResource($data);
    }
}

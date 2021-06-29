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
        return view('backend.dailyBets');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dailyBetsData(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        // $gameType = $request->input('gameType');
        // $gameId = $request->input('gameId');
        $query = dailyBets::getAllInfo($sortBy, $orderBy, $searchValue);
        // error_log(json_encode($query,true));
        // if (isset($searchValue)) {
        //     $query->where("gameName", 'like', '%'.$searchValue.'%');
        // }
        // if (isset($gameType)) {
        //     $query->where("gameType","=", $gameType);
        // }
        // if (isset($gameId)) {
        //     $query->where("gameId","=", $gameId);
        // }

        $data = $query->paginate($length);    
        return new DataTableCollectionResource($data);

    }
}

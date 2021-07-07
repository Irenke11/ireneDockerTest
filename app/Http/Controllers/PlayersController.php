<?php

namespace App\Http\Controllers;

use App\players;
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

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backend.players');
    }
    public function allData(Request $request)
    {
        $length = $request->input('length')??100;
        $sortBy = $request->input('column')??"playerId";
        $orderBy = $request->input('dir')??"desc";
        $searchValue["search"]=$request->input('search');
        $searchValue["currency"]=$request->input('currency');
        $searchValue["playerId"]=$request->input('playerId');
        $query = Players::getAllInfo($sortBy, $orderBy, $searchValue);
        $data = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }
    public function addPlayer(Request $request)
    {
        return view('backend.addPlayer');
    }

    public function addData(Request $request)
    {
        $currency=config('setting.currency');//["RMB","TWD","USD"]
        try {
            $validator = $request->validate([  
                'account' => ['required', 'email', 'string','min:6', 'max:20',"unique:players,account"],
                'name' => ['required', 'string', 'min:6', 'max:20',"unique:players,name"],
                'password' => ['required','alpha_num', 'string', 'min:6','max:20'], 
                'currency' => ['required', 'string'],
            ]);
            $Players = Players::addPlayer($request); //新增
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
}


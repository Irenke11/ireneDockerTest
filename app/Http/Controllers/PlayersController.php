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
    public function playersData(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        $currency = $request->input('currency');
        $playerId = $request->input('playerId');
        $query = Players::getAllInfo($sortBy, $orderBy, $searchValue);
        if (isset($searchValue)) {
            $query->where("name", 'like', '%'.$searchValue.'%')
            ->orwhere('account', 'like', '%'.$searchValue.'%');
        }
        if (isset($currency)) {
            $query->where("currency","=", $currency);
        }
        if (isset($playerId)) {
            $query->where("playerId","=", $playerId);
        }
        $data = $query->paginate($length);
        return new DataTableCollectionResource($data);

        // $data=Players::getAllInfo($request);
        // return print_r($data,1);
    }
    public function addPlayer(Request $request)
    {
        return view('backend.addPlayer');
    }

    public function addPlayerData(Request $request)
    {
        // try {
            $validator = $request->validate([  
                'account' => ['required', 'string', 'max:255',"unique:players"],
                'name' => ['required', 'string', 'max:255',"unique:players"],
                'password' => ['required', 'string', 'min:6'], 
                'currency' => ['required', 'string'],
            ]);
        //     return response()->json([
        //         'status' => 'success',
        //         'msg'    => 'Okay',
        //     ], 201);
        // }
        // catch (ValidationException $exception) {
        //     return response()->json([
        //         'status' => 'error',
        //         'msg'    => 'Error',
        //         'errors' => $exception->errors(),
        //     ], 422);
        // }
        $Players = new Players;
        $Players->account   = $request->account;
        $Players->name      = $request->name;
        $Players->password  = $request->password;
        $Players->currency  = $request->currency;
        $Players->save();
        return $Players;
    }
}


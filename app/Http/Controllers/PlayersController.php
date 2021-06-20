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
        $query = Players::getAllInfo($sortBy, $orderBy, $searchValue);
        if (isset($currency)) {
            $query->where("currency","=", $currency);
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\players  $players
     * @return \Illuminate\Http\Response
     */
    public function show(players $players)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\players  $players
     * @return \Illuminate\Http\Response
     */
    public function edit(players $players)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\players  $players
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, players $players)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\players  $players
     * @return \Illuminate\Http\Response
     */
    public function destroy(players $players)
    {
        //
    }
}

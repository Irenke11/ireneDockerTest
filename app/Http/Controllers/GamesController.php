<?php

namespace App\Http\Controllers;

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

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backend.games');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gamesData(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        $gameType = $request->input('gameType');
        $gameId = $request->input('gameId');
        $query = Games::getAllInfo($sortBy, $orderBy, $searchValue);
        // error_log(json_encode($query,true));
        if (isset($searchValue)) {
            $query->where("gameName", 'like', '%'.$searchValue.'%');
        }
        if (isset($gameType)) {
            $query->where("gameType","=", $gameType);
        }
        if (isset($gameId)) {
            $query->where("gameId","=", $gameId);
        }
        $data = $query->paginate($length);
        return new DataTableCollectionResource($data);

    }

    public function editGame(Request $request)
    {
        //   error_log(json_encode($request,true));
        $gameId = $request->input('gameId');
   
            if (isset($gameId)) {
                $data["data"] = Games::getInfoById($gameId);
                $data["edit"]=true;//修改
            }else{
                $data["data"]="";   
                $data["edit"]=false;//新增
            }
        return view('backend.editGame',$data);
    }

    public function editGameData(Request $request)
    {
        $validator = $request->validate([  
            'gameId' => ['required', 'max:20'],
            'gameNameEn' => ['required', 'string', 'max:255'],
            'gameNameCn' => ['required', 'string', 'max:255'],
            'gameNameTw' => ['required', 'string', 'max:255'],
            'gameType' => ['required', 'string', 'max:6'], 
            'status' => ['required'],
        ]);
        $gameName=[];
        $gameName['cn']=$request->gameNameCn;
        $gameName['tw']=$request->gameNameTw;
        $gameName['en']=$request->gameNameEn;
        $gameName=json_encode($gameName);
        $request->merge(['gameName' => $gameName]);

        $checkGames = Games::getInfoById($request->gameId);
        if(isset($checkGames)){
            $Games = Games::editGameById($request);//修改
        }else{
            $Games = Games::addGame($request);//新增
        }
       
        // $Game->gameName  = $gameName;
        // $Game->gameType  = $request->gameType;
        // $Game->status    = $request->status;
        // $Game->save();
        // error_log($Games);
        return $Games;
    }
    // public function editGameById(Request $request)
    // {
    //     // 驗證請求...


    //     $Game = Games::getInfoById($request->gameId);
    //     $Game->gameName      = $gameName;
    //     $Game->gameType  = $request->gameType;
    //     $Game->status    = $request->status;
    //     $Game->save();

    //     return $Game;
    // }
    // public function getGameById(Request $request)
    // {
    //     // error_log(json_encode($$request,true));
    //     $gameId = $request->input('gameId');
    //     // $edit = $request->input('edit');
    //     // if(isset($edit)){
    //         if (isset($gameId)) {
    //             $query = Games::getInfoById($gameId);
    //         }
    //     // }
    //     //   error_log(json_encode($query,true));
    //     return $query;
    // }
    /**
     * Display the specified resource.
     *
     * @param  \App\games  $games
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\games  $games
     * @return \Illuminate\Http\Response
     */
    public function edit(games $games)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\games  $games
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, games $games)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\games  $games
     * @return \Illuminate\Http\Response
     */
    public function destroy(games $games)
    {
        //
    }
}

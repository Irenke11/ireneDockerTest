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
    public function allData(Request $request)
    {
        $length = $request->input('length')??100;
        $sortBy = $request->input('column')??"gameId";
        $orderBy = $request->input('dir')??"desc";
        $searchValue["gameType"]=$request->input('gameType');
        $searchValue["gameId"]=$request->input('gameId');
        $searchValue["gameName"]=$request->input('search');
        $query = games::getAllInfo($sortBy, $orderBy, $searchValue);
        $data = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }

    public function editGame(Request $request)
    {
        $gameId = request()->segment(count(request()->segments()));//id
        $data["data"] = games::getInfoById($gameId);
        $data["edit"]=true;//修改
        
        return view('backend.editGame',$data);
    }

    public function addGame(Request $request)
    {
        $data["data"] ="";
        $data["edit"]=false;//新增
        return view('backend.editGame',$data);
    }
    
    public function editData(Request $request)
    {
        try {
            $validator = $request->validate([  
                // 'gameId' => ['required', 'max:20'],
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

            $checkGames = games::getInfoById($request->gameId);
            if(isset($checkGames)){
                $Games = games::editGameById($request);//修改
            }else{
                $Games = games::addGame($request);//新增
            }
            return response()->json([
                'code' => '201',
                'status' => 'success',
                'msg'    => 'Okay',
            ], 201);
        }
        catch (ValidationException $exception) {
            return response()->json([
                'code' => '422',
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        }






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

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
        return view('backend.bets');
    }
    public function betsData(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $bureauNo = $request->input('bureauNo');
        $datepicker = $request->input('datepicker');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $Daytime=[];
        $query = bets::getAllInfo($sortBy, $orderBy,$Daytime);
        if (isset($bureauNo)) {
            $query->where("bureauNo", '=', $bureauNo);
        }
        if (isset($datepicker)) {
            if (isset($startTime) & isset($endTime)) {
                $query->whereBetween('betTime', [$datepicker." ".$startTime, $datepicker.' '.$endTime]);
            }else{
                $query->whereBetween('betTime', [$datepicker, $datepicker.' 23:59:59']);
            }
        }

        $data = $query->paginate($length);
        return new DataTableCollectionResource($data);

        // $data=bets::getAllInfo($request);
        // return print_r($data,1);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterYear = config('constants.filter_years');
        $timeNow = substr(date("Y-m-d",time()),0, 4);
        $year = (empty($request->filter_year)) ? $timeNow : $request->filter_year;
        $dataRevenue = DB::table('bills')
            ->where('deleted', '=', 0)
            ->whereYear('created_at', '=', $year)
            ->get();
        $monthNumber = config('constants.month');
        $data = [];
        foreach ($monthNumber as $valueMonth){
            $data[$valueMonth] = 0;
            foreach ($dataRevenue as $valueData){
                if((int)substr($valueData->created_at,5, 2) == (int)$valueMonth){
                    $data[$valueMonth] += $valueData->price;
                }
            }
        }
        return view('admin.pages.dashboard.index', compact('filterYear','timeNow', 'data','year'));
    }

    public function cacheClear()
    {
            $commands = ['route:cache', 'config:cache', 'cache:clear', 'view:clear'];
            foreach ($commands as $command) {
                Artisan::call($command);
            }
            Cache::flush();
            $response['status'] = true;
        return response()->json($response);
    }
}

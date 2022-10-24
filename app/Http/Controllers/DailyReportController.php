<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('user.daily_report.index',[
            'title' => 'Admin: Production',
        ]);
    }

    // //Daily Report Data Controller
    // public function ajaxRequestAll(Request $request)
    // {
    //     $dailyReport = DailyReport::query();
    //     return datatables()->of($dailyReport)
    //             ->addIndexColumn()
    //             ->toJson();
    // }

    public function getCustomFilterData(Request $request)
    {
        $dailyReport    = DailyReport::query();

        return datatables()->of($dailyReport)
                ->filter(function($query) use ($request){
                    if($request->report_date_1 != '')
                    {
                        $query->where('report_date', '>=', "$request->report_date_1");
                    }

                    if($request->report_date_2 != '')
                    {
                        $query->where('report_date', '<=', "$request->report_date_2");
                    }

                })
                ->addIndexColumn()
                ->toJson();
    }

    public function calculateSearchResult(Request $request)
    {
        $searchResult    = DailyReport::query();

        if($request->report_date_1 != '')
        {
            $searchResult->where('report_date','>=',"$request->report_date_1");
        }
        if($request->report_date_2 != '')
        {
            $searchResult->where('report_date','<=',"$request->report_date_2");
        }
        $totalRuntime   = 0;
        $totalDowntime  = 0;
        $totalPcs       = 0;
        $totalWeightFg  = 0;
        $totalWeightBb  = 0;
        $averageSpeed   = 0;
        
        foreach ($searchResult->get() as $search) {
            $totalRuntime += $search->total_runtime;
            $totalDowntime += $search->total_downtime;
            $totalPcs += $search->total_pcs;
            $totalWeightFg += $search->total_weight_fg;
            $totalWeightBb += $search->total_weight_bb;
            $averageSpeed += $search->average_speed;
        }
        
        return response()->json([
            'total_runtime'     => $totalRuntime,
            'total_downtime'    => $totalDowntime,
            'total_pcs'         => $totalPcs,
            'total_weight_fg'   => $totalWeightFg,
            'total_weight_bb'   => $totalWeightBb,
            'average_speed'     => $averageSpeed   
        ],200);
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
     * @param  \App\Models\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function show(DailyReport $dailyReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyReport $dailyReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyReport $dailyReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyReport $dailyReport)
    {
        //
    }
}

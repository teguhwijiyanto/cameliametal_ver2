<?php

namespace App\Http\Controllers;

use App\Models\Oee;
use App\Models\User;
use App\Models\Smelting;
use App\Models\Workorder;
use App\Models\Production;
use Illuminate\Http\Request;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('user.workorder.index',[
            'title'=>'Workorder',
        ]);
    }

    public function ajaxRequestAll(Request $request)
    {
        $workorder = Workorder::query();
        
        return datatables()->of($workorder)
                ->filter(function($query) use ($request){
                    if($request->report_date_1 != '')
                    {
                        $query->where('created_at', '>=', "$request->report_date_1");
                    }

                    if($request->report_date_2 != '')
                    {
                        $query->where('created_at', '<=', "$request->report_date_2");
                    }

                    if($request->wo_number != '')
                    {
                        $query->where('wo_number' , 'like', '%'.$request->wo_number.'%');
                    }
                })
                ->addColumn('wo_number',function(Workorder $model){
                    return $model->wo_number;
                })
                ->addColumn('total_production',function(Workorder $model){
                    $productions = Production::where('workorder_id',$model->id)->get();
                    $totalProd = 0;
                    foreach($productions as $prod){
                        $totalProd += $prod->pcs_per_bundle;
                    }
                    if($totalProd == 0){
                        return 'No Data';
                    }
                    return $totalProd;
                })
                ->addColumn('total_runtime',function(Workorder $model){
                    $oee = Oee::select('total_runtime')->where('workorder_id',$model->id)->first();
                    if(!$oee){
                        return 'No Data';
                    }
                    return $oee->total_runtime;
                })
                ->addColumn('total_downtime',function(Workorder $model){
                    $oee = Oee::select('total_downtime')->where('workorder_id',$model->id)->first();
                    if(!$oee){
                        return 'No Data';
                    }
                    return $oee->total_downtime;
                })
                // ->addColumn('status_prod',function(Workorder $model){
                //     if($model->status_prod == 1){
                //         return '<p class="btn btn-success">On Process</p>';
                //     }
                //     return '-';
                // })
                // ->addColumn('status_wo',function(Workorder $model){
                //     if($model->status_wo == 'draft'){
                //         return '<p class="btn btn-success">Closed</p>';
                //     }
                //     return '<p class="btn btn-danger">Open</p>';
                // })
                ->addColumn('action','user.workorder.action')
                // ->rawColumns(['status_wo','status_prod','action'])
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
    }

    public function getDowntime(Request $request)
    {
        $oee = Oee::where('workorder_id',$request->workorder_id)->first();
        if(!$oee){
            return response()->json(null,200);
        }
        if($request->data == 'downtime'){
            return response()->json([
                $oee->dt_bongkar_pasang_dies,
                $oee->dt_tunggu_bahan_baku,
                $oee->dt_ganti_bahan_baku,
                $oee->dt_tunggu_dies,
                $oee->dt_gosok_dies,
                $oee->dt_ganti_part_shot_blast,
                $oee->dt_setting_ulang_kelurusan,
                $oee->dt_ganti_polishing_dies,
                $oee->dt_ganti_nozle_polishing_mesin,
                $oee->dt_ganti_roller_straightener,
                $oee->dt_dies_rusak,
                $oee->dt_mesin_trouble_operator,
                $oee->dt_validasi_qc,
                $oee->dt_mesin_trouble_maintenance,
            ],200);
        }
        if($request->data == 'management_time'){
            return response()->json([
                $oee->dt_briefing,
                $oee->dt_cek_shot_blast,
                $oee->dt_cek_mesin,
                $oee->dt_sambung_bahan,
                $oee->dt_setting_awal,
                $oee->dt_selesai_satu_bundle,
                $oee->dt_cleaning_area_mesin,
                $oee->dt_istirahat
            ],200);
        }
        
        
    }

    public function getOee(Request $request)
    {

        $oee = Oee::where('workorder_id',$request->workorder_id)->first();
        $productions = Production::where('workorder_id',$request->workorder_id)->get();
        $totalProductions = 0;
        foreach($productions as $prod)
        {
            $totalProductions += $prod->pcs_per_bundle;
        }
        $totalProductions = 2000;
        $oeeResult = [0,0,0,0];
        if ($totalProductions > 0) {
            $oeeResult      = $this->calculateOee($oee->total_downtime, $oee->dt_istirahat, $oee->total_runtime, $totalProductions, 3);
        }
        
        $oee = Oee::where('workorder_id',$request->workorder_id)->first();
        return response()->json([
            $oeeResult[0],
            $oeeResult[1],
            $oeeResult[2],
            $oeeResult[3],
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $oee = Oee::where('workorder_id',$request['id'])->first();
        $workorder = Workorder::where('id',$request['id'])->first();
        $productions = Production::where('workorder_id',$request['id'])->get();
        $totalProductions = 0;
        foreach($productions as $prod)
        {
            $totalProductions += $prod->pcs_per_bundle;
        }
        $smeltings      = Smelting::where('workorder_id',$request['id'])->get();
        $user           = User::where('id',$workorder->user_id)->first();

        $oeeResult          = [0,0,0,0];
        if ($oee && $totalProductions>0) {
            $oeeResult      = $this->calculateOee($oee->total_downtime, $oee->dt_istirahat, $oee->total_runtime, $totalProductions, 3);
        }

        return view('user.workorder.details',[
            'title'             => 'OEE',
            'oee'               => $oee,
            'workorder'         => $workorder,
            'productions'       => $productions,
            'smeltings'         => $smeltings,
            'totalProduction'   => $totalProductions,
            'otr'               => $oeeResult[1],
            'per'               => $oeeResult[2],
            'qr'                => $oeeResult[3],
            'oee_val'           => $oeeResult[0],
            'createdBy'         => $user
        ]);
    }

    private function calculateOee(int $downtime, int $dt_istirahat, int $runtime, int $qtyProduction, int $cycleTime, int $defect = 0)
    {
        $otr    = round((($runtime - ($downtime-$dt_istirahat)) / $runtime) * 100,2);
        $per    = round(($qtyProduction/(($runtime-($downtime-$dt_istirahat))*60/$cycleTime))*100,2);
        $qr     = round((($qtyProduction - $defect)/$qtyProduction)*100,2);
        $oeeVal = round((($otr/100) * ($per/100) * ($qr/100))*100,2);
        $result = [
            $oeeVal, $otr, $per, $qr
        ];

        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

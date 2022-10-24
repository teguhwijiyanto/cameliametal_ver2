<?php

namespace App\Http\Controllers\Api;

use App\Models\Oee;
use App\Models\Smelting;
use App\Models\Workorder;
use App\Models\Production;
use GuzzleHttp\Psr7\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OeeApiRequest;

class OeeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
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
     * @param  \App\Http\Requests\StoreOeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OeeApiRequest $request)
    {
        //
        $data = $request->all();

        $workorderId = Workorder::select('id')->where('wo_number',$data['workorder_id'])->first();
        if(!$workorderId)
        {
            return response()->json([
                'messages'=>'workorder data not found'
            ],404);
        }

        $oeeId = Oee::select('id')->where('workorder_id',$workorderId->id)->get();
        if(count($oeeId)!=0)
        {
            return response()->json([
                'messages'=>'OEE data already input'
            ],400);
        }

        $data['workorder_id'] = $workorderId->id;

        Oee::create($data);

        $smeltingData = Smelting::select('id')->where('workorder_id',$workorderId->id)->get();
        $smeltingNum = count($smeltingData);
        $productionData = Production::select('id')->where('workorder_id',$workorderId->id)->get();
        $productionNum = count($productionData);
        $oeeData        = Oee::select('id')->where('workorder_id',$workorderId->id)->first();
        if($smeltingNum == $productionNum && $oeeData != null){
            Workorder::where('id',$workorderId->id)->update(['status_wo'=>'closed']);
        }

        return response()->json([
            'messages'=>'New data submited successfully'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Oee  $oee
     * @return \Illuminate\Http\Response
     */
    public function show(Oee $oee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oee  $oee
     * @return \Illuminate\Http\Response
     */
    public function edit(Oee $oee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOeeRequest  $request
     * @param  \App\Models\Oee  $oee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oee $oee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oee  $oee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oee $oee)
    {
        //
    }
}

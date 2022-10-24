<?php

namespace App\Http\Controllers\Admin;

use App\Models\Smelting;
use App\Models\Workorder;
use Illuminate\Http\Request;
use App\Http\Requests\SmeltingRequest;
use App\Http\Controllers\Controller;

class SmeltingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|office-admin']);
    }

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
    public function create(Request $request)
    {
        $workorder = Workorder::where('id',$request->id)->first();
        return view('admin.smelting.create',[
            'title'        => 'Admin: Create Smelting',
            'wo_id'        => $workorder->id,
            'wo_number'    => $workorder->wo_number,
            'numberOfCoil' => $workorder->bb_qty_coil
        ]);
    }

    public function addSmelting(SmeltingRequest $request){
        $bundleNum = Smelting::where('workorder_id',$request->wo_id)->max('bundle_num');
        $bundleCollection = Smelting::where('workorder_id',$request->wo_id)->orderBy('bundle_num','asc')->get();

        $bundleNum++;

        for($i = 0; $i < count($bundleCollection); $i++)
        {
            if($bundleCollection[$i]->bundle_num != $i+1)
            {
                $bundleNum = $i+1; 
                break;  
            }
        }
        

        Smelting::create([
            'bundle_num'        =>$bundleNum,
            'workorder_id'      =>$request->wo_id,
            'weight'            =>$request->weight,
            'smelting_num'      =>$request->smelting_num,
            // 'area'              =>$request->area,    
        ]);

        return response()->json([
            'message'=>'updated successfully'
        ],200);
    }

    public function getDataWo(Request $request){
        $bundleNum = Smelting::where('workorder_id',$request->wo_id)->count();
        return response()->json([
            'number_of_smelting'=>$bundleNum
        ],200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SmeltingRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Smelting  $smelting
     * @return \Illuminate\Http\Response
     */
    public function show(Smelting $smelting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Smelting  $smelting
     * @return \Illuminate\Http\Response
     */
    public function edit(Smelting $smelting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Smelting  $smelting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Smelting $smelting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Smelting  $smelting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Smelting $smelting)
    {
        //
        $smelting->delete();
        return redirect()->route('admin.smelting.create',['id'=>$smelting->workorder_id])->with('success','Data Deleted Successfully');
    }
}

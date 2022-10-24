<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Workorder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpvScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('supervisor.schedule.index',[
            'title'=>'Workorder Schedule',
        ]);
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
    public function show($id)
    {
        //
    }


    public function showWaiting()
    {
        $workorders = Workorder::where('status_wo','waiting')->orderBy('wo_order_num','ASC');
        return datatables()->of($workorders)
            ->addColumn('bb_qty_combine',function(Workorder $model){
                $combines = $model->bb_qty_pcs . " / " . $model->bb_qty_coil;
                return $combines;
            })
            ->addColumn('fg_size_combine',function(Workorder $model){
                $combines = $model->fg_size_1 . " x " . $model->fg_size_2;
                return $combines;
            })
            ->addColumn('tolerance',function(Workorder $model){
                $combines = $model->tolerance_minus;
                return round($combines,2);
            })
            // ->addColumn('status_prod',function(Workorder $model){
            //     $combines = $model->status_prod;
            //     if($combines){
            //         return 'On Process';
            //     }
            //     return 'Waiting';
            // })
            // ->addColumn('status_wo',function(Workorder $model){
            //     $combines = $model->status_wo;
            //     if($combines){
            //         return 'Closed';
            //     }
            //     return 'Open';
            // })
            ->addColumn('user',function(Workorder $model){
                return $model->user->name;
            })
            ->addColumn('machine',function(Workorder $model){
                return $model->machine->name;
            })
            ->addColumn('smelting','operator.schedule.smelting')
            ->addColumn('action','operator.schedule.action')
            ->rawColumns(['smelting','action'])
            ->setRowClass(function(){
                return 'workorder-row';
            })
            ->setRowId(function(Workorder $model){
                return $model->id;
            })
            ->setRowClass(function(Workorder $model){
                if($model->status_wo == 'draft'){
                    return 'workorder-row alert-danger';
                }
                return 'workorder-row';
            })
            ->setRowAttr([
                'data-toggle'       => 'tooltip',
                'data-placement'    => 'top',
                'title'             => function(Workorder $model){
                    if($model->status_wo == 'draft'){
                        return 'Smelting Number Must Be Input Correctly';
                    }
                    return 'Data OK';
                }
            ])
            ->addIndexColumn()
            ->toJson();
    }

    public function showOnProcess()
    {
        $workorders = Workorder::where('status_wo','on process')->orderBy('wo_order_num','ASC');
        return datatables()->of($workorders)
            ->addColumn('bb_qty_combine',function(Workorder $model){
                $combines = $model->bb_qty_pcs . " / " . $model->bb_qty_coil;
                return $combines;
            })
            ->addColumn('fg_size_combine',function(Workorder $model){
                $combines = $model->fg_size_1 . " / " . $model->fg_size_2;
                return $combines;
            })
            // ->addColumn('status_prod',function(Workorder $model){
            //     $combines = $model->status_prod;
            //     if($combines){
            //         return 'On Process';
            //     }
            //     return 'Waiting';
            // })
            // ->addColumn('status_wo',function(Workorder $model){
            //     $combines = $model->status_wo;
            //     if($combines){
            //         return 'Closed';
            //     }
            //     return 'Open';
            // })
            ->addColumn('tolerance',function(Workorder $model){
                $combines = '-' . $model->tolerance_minus;
                return $combines;
            })
            ->addColumn('user',function(Workorder $model){
                return $model->user->name;
            })
            ->addColumn('machine',function(Workorder $model){
                return $model->machine->name;
            })
            ->setRowId(function(Workorder $model){
                return $model->id;
            })
            ->addIndexColumn()
            ->toJson();
    }

    public function process(Workorder $id)
    {
        $workorder = Workorder::where('status_wo','on process')->first();
        if($workorder != null)
        {
            return redirect(route('schedule.index'));
        }   

        $id->update(['status_wo'=>'on process','wo_order_num'=>null]);

        return redirect(route('schedule.index'));
    }

    public function check(Workorder $id)
    {
        $workorder = Workorder::where('status_wo','on check')->first();
        if($workorder != null)
        {
            return redirect(route('schedule.index'));
        }   

        $id->update(['status_wo'=>'on check','wo_order_num'=>null]);

        return redirect(route('schedule.index'));
    }


    public function finish(Workorder $id)
    {
        $workorder = Workorder::where('status_wo','closed')->first();
        if($workorder != null)
        {
            return redirect(route('spvproduction.index'));
        }   

        $id->update(['status_wo'=>'closed','wo_order_num'=>null]);

        return redirect(route('spvproduction.index'));
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

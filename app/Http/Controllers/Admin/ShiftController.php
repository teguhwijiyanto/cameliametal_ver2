<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shift;
use Illuminate\Http\Request;
use App\Http\Requests\ShiftRequest;
use App\Http\Controllers\Controller;

class ShiftController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShiftRequest $request)
    {
        // dd($request);
        //
        $shift = Shift::create([
            'name'              => $request->name,
            'start_time'        => $request->start_time,
            'end_time'          => $request->end_time,
            'break_1_start'     => $request->break_1_start,
            'break_1_end'       => $request->break_1_end,
            'break_2_start'     => $request->break_2_start,
            'break_2_end'       => $request->break_2_end,
            'break_3_start'     => $request->break_3_start,
            'break_3_end'       => $request->break_3_end,
            'break_4_start'     => $request->break_4_start,
            'break_4_end'       => $request->break_4_end,
            'break_5_start'     => $request->break_4_start,
            'break_5_end'       => $request->break_4_end,
            'background_color'  => $request->background_color
        ]);

        // if(!$shift)
        // {
        //     return redirect()->route('admin.schedule.index')->with('failed','Shift Submission Failed');
        // }
        return redirect()->route('admin.schedule.index')->with('success','Shift Added Successfuly');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
        
        return response()->json([
            $shift
        ],200);
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

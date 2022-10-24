<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dayoff;
use Illuminate\Http\Request;
use App\Http\Requests\DayoffRequest;
use App\Http\Controllers\Controller;

class DayoffController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.dayoff.index',[
            'title' => 'Admin: Dayoff'
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
        return view('admin.dayoff.create',[
            'title'         => 'Admin: Create Dayoff',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DayoffRequest $request)
    {
        //
        $supplier = Dayoff::create([
            'name'  => $request->name,
        ]);

        return redirect()->route('admin.dayoff.index')->with('success','Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dayoff  $dayoff
     * @return \Illuminate\Http\Response
     */
    public function show(Dayoff $dayoff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dayoff  $dayoff
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        return view('admin.dayoff.edit',[

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dayoff  $dayoff
     * @return \Illuminate\Http\Response
     */
    public function update(DayoffRequest $request, Dayoff $dayoff)
    {
        //
        $dayoff->update([
            'name'      => $request->name,
        ]);

        return redirect()->route('admin.dayoff.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dayoff  $dayoff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dayoff $dayoff)
    {
        //
        $dayoff->delete();
        return redirect()->route('admin.dayoff.index')->with('success','Data Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Requests\HolidayRequest;
use App\Http\Controllers\Controller;

class HolidayController extends Controller
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
        return view('admin.holiday.index',[
            'title' => 'Admin: Holiday'
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
        return view('admin.holiday.create',[
            'title'         => 'Admin: Create Holiday',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolidayRequest $request)
    {
        //
        $supplier = Holiday::create([
            'name'  => $request->name,
        ]);

        return redirect()->route('admin.holiday.index')->with('success','Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        //
        return view('admin.holiday.edit',[
            'title'    => 'Admin: edit Holiday',
            'holiday'     => $holiday,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(HolidayRequest $request, Holiday $holiday)
    {
        //
        $holiday->update([
            'name'      => $request->name,
        ]);

        return redirect()->route('admin.holiday.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        //
        $holiday->delete();
        return redirect()->route('admin.holiday.index')->with('success','Data Deleted Successfully');
    }
}

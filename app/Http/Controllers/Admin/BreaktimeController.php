<?php

namespace App\Http\Controllers\Admin;

use App\Models\Breaktime;
use Illuminate\Http\Request;
use App\Http\Requests\BreaktimeRequest;
use App\Http\Controllers\Controller;

class BreaktimeController extends Controller
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
        return view('admin.breaktime.index',[
            'title' => 'Admin: Breaktime'
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
        return view('admin.breaktime.create',[
            'title'         => 'Admin: Create Breaktime',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BreaktimeRequest $request)
    {
        //
		/*
        $supplier = Breaktime::create([
            'name'  => $request->name,
			'name2'  => $request->name2,
        ]);
		*/

        if(preg_match("/([0-9]+):([0-5][0-9]):([0-5][0-9])/", $request->name)) {
            //return redirect()->route('admin.breaktime.index')->with('success','Data Added Successfully');

			if(preg_match("/([0-9]+):([0-5][0-9]):([0-5][0-9])/", $request->name2)) {
		        $supplier = Breaktime::create([
                'name'  => $request->name,
			    'name2'  => $request->name2,
                ]);
				return redirect()->route('admin.breaktime.index')->with('success','Data Added Successfully');
			}
			else {
				return redirect()->route('admin.breaktime.index')->with('success','ERROR!. Input FROM & TO should be in HH::MM:SS format! ');
			}

		}
		else {
            return redirect()->route('admin.breaktime.index')->with('success','ERROR!. Input FROM & TO should be in HH::MM:SS format! ');
		}

		//return redirect()->route('admin.breaktime.index')->with('success','Error. Input should be in HH::MM:SS formtted ');

        //return redirect()->route('admin.breaktime.index')->with('success','Data Added Successfully');
		/*
		if(!$supplier) {
            return redirect()->route('admin.breaktime.index')->with('danger','Error. Input should be in HH::MM:SS formtted ');
		}
		*/

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Breaktime  $breaktime
     * @return \Illuminate\Http\Response
     */
    public function show(Breaktime $breaktime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Breaktime  $breaktime
     * @return \Illuminate\Http\Response
     */
    public function edit(Breaktime $breaktime)
    {
        //
        return view('admin.breaktime.edit',[
            'title'    => 'Admin: edit Breaktime',
            'breaktime'     => $breaktime,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Breaktime  $breaktime
     * @return \Illuminate\Http\Response
     */
    public function update(BreaktimeRequest $request, Breaktime $breaktime)
    {
        //
        $breaktime->update([
            'name'      => $request->name,
			'name2'      => $request->name2,
        ]);

        return redirect()->route('admin.breaktime.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Breaktime  $breaktime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Breaktime $breaktime)
    {
        //
        $breaktime->delete();
        return redirect()->route('admin.breaktime.index')->with('success','Data Deleted Successfully');
    }
}

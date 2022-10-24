<?php

namespace App\Http\Controllers\Admin;

use App\Models\Oee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OeeController extends Controller
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
        return view('admin.oee.index',[
            'title' => 'Admin: OEE'
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
     * @param  \Illuminate\Http\Request  $request
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

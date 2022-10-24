<?php

namespace App\Http\Controllers\Admin;

use App\Models\Line;
use App\Models\Machine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MachineRequest;

class MachineController extends Controller
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
        return view('admin.machine.index',[
            'title' => 'Admin: Machine'
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
        return view('admin.machine.create',[
            'title'         => 'Admin: Machine Line',
            'lines'         => Line::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MachineRequest $request)
    {
        //
        $supplier = Machine::create([
            'name'      => $request->name,
            'line_id'   => $request->line_id
        ]);

        return redirect()->route('admin.machine.index')->with('success','Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function show(Machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function edit(Machine $machine)
    {
        //
        return view('admin.machine.edit',[
            'title'    => 'Admin: Edit Machine',
            'lines'    => Line::all(),
            'machine'  => $machine,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(MachineRequest $request, Machine $machine)
    {
        //
        $machine->update([
            'name'          => $request->name,
            'line_id'       => $request->line_id
        ]);

        return redirect()->route('admin.machine.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Machine $machine)
    {
        //
        $machine->delete();
        return redirect()->route('admin.machine.index')->with('success','Data Deleted Successfully');
    }
}

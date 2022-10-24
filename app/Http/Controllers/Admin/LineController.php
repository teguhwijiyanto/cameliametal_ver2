<?php

namespace App\Http\Controllers\Admin;

use App\Models\Line;
use Illuminate\Http\Request;
use App\Http\Requests\LineRequest;
use App\Http\Controllers\Controller;

class LineController extends Controller
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
        return view('admin.line.index',[
            'title' => 'Admin: Line'
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
        return view('admin.line.create',[
            'title'         => 'Admin: Create Line',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LineRequest $request)
    {
        //
        $supplier = Line::create([
            'name'  => $request->name,
        ]);

        return redirect()->route('admin.line.index')->with('success','Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function show(Line $line)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function edit(Line $line)
    {
        //
        return view('admin.line.edit',[
            'title'    => 'Admin: edit Line',
            'line'     => $line,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function update(LineRequest $request, Line $line)
    {
        //
        $line->update([
            'name'      => $request->name,
        ]);

        return redirect()->route('admin.line.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function destroy(Line $line)
    {
        //
        $line->delete();
        return redirect()->route('admin.line.index')->with('success','Data Deleted Successfully');
    }
}

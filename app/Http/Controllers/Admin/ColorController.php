<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;

class ColorController extends Controller
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
        return view('admin.color.index',[
            'title' => 'Admin: Color'
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
        return view('admin.color.create',[
            'title' => 'Admin: Create Color',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorRequest $request)
    {
        //
        $color = Color::create([
            'name'                  => $request->name,
        ]);

        return redirect()->route('admin.color.index')->with('success','Data Added Successfully');
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
    public function edit(Color $color)
    {
        //
        return view('admin.color.edit',[
            'title'        => 'Admin: edit Color',
            'color'     => $color,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ColorRequest $request, Color $color)
    {
        //
        $color->update([
            'name'                  => $request->name,
        ]);

        return redirect()->route('admin.color.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        //
        $color->delete();
        return redirect()->route('admin.color.index')->with('success','Data Deleted Successfully');
    }

    public function getColorData(Request $request)
    {
        $color = Color::where('name',$request->name)->first();
        if(!$color)
        {
            return response()->json([
                'message' => 'color data not found'
            ],404);
        }

        return response()->json([
            $color
        ],200);
    }
}

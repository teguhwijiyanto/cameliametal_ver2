<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
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
        return view('admin.customer.index',[
            'title' => 'Admin: Customer'
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
        return view('admin.customer.create',[
            'title' => 'Admin: Create Customer',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        //
        $customer = Customer::create([
            'name'                  => $request->name,
            'size_1'                => $request->size_1,    
            'size_2'                => $request->size_2,
            'shape'                 => $request->shape,
            'straightness_standard' => $request->straightness_standard
        ]);

        return redirect()->route('admin.customer.index')->with('success','Data Added Successfully');
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
    public function edit(Customer $customer)
    {
        //
        return view('admin.customer.edit',[
            'title'        => 'Admin: edit Customer',
            'customer'     => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        //
        $customer->update([
            'name'                  => $request->name,
            'size_1'                => $request->size_1,
            'size_2'                => $request->size_2,
            'shape'                 => $request->shape,
            'straightness_standard' => $request->straightness_standard
        ]);

        return redirect()->route('admin.customer.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->delete();
        return redirect()->route('admin.customer.index')->with('success','Data Deleted Successfully');
    }

    public function getCustomerData(Request $request)
    {
        $customer = CUstomer::where('name',$request->name)->first();
        if(!$customer)
        {
            return response()->json([
                'message' => 'customer data not found'
            ],404);
        }

        return response()->json([
            $customer
        ],200);
    }
}

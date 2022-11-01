<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        return view('admin.user.index',[
            'title' => 'Admin: User'
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
        return view('admin.user.create',[
            'title' => 'Admin: Create User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        // ddd($request->only('name','email'));
        $user = User::create([
            'name'=>$request->name,
            'employeeId'=>$request->employeeId,
            'password'=>bcrypt('12345678'),
            'api_token' => Str::random(80),
            'email_verified_at'=>now()
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.user.index')->with('success','Data Added Successfully');
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
    public function edit(User $user)
    {
        return view('admin.user.edit',[
            'user'=>$user,
            'role'=>$user->getRoleNames()[0],
            'title'=>'Admin: Edit User'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        //
        $user->update($request->only(['name','employeeId','role']));
        $user->syncRoles([$request->role]);
        return redirect()->route('admin.user.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->route('admin.user.index')->with('success','Data Deleted Successfully');
    }

    public function resetPassword(Request $request)
    {
        User::find(json_decode($request->user)->id)->update(['password'=> Hash::make('12345678')]);
   
        return redirect()->route('admin.user.index')->with('success','Password Changed Successfully');
    }
}

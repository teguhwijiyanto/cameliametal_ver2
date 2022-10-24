<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    //
    public function index()
    {
        return view('auth.change-password',[
            'title' => 'Change Password Form'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route('home')->with('success','Password Changed Successfully');
    }
}

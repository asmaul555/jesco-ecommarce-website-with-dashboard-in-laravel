<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('alreadyLoggedIn');
    }
    public function login(){
        return view('auth.login');
    }
    public function check(Request $request){
         $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $checkuser=User::where('email',$request->email)->first();
        $checkpass=Hash::check($request->password,$checkuser->password);
        if($checkpass){
            session()->put('user',$checkuser->email);
            return redirect('/dashboard');
        }else{
            return back()->with('error','Something went wrong !');
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{   
    public function __construct()
    {
        $this->middleware('alreadyLoggedIn');
    }
    public function register(){
        return view('auth.register');
    }
    public function create(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:6|max:20|confirmed'
        ]);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $query=$user->save();
        if($query){
            return back()->with('success','You has been successfully created !')&& redirect('/');
        }else{
            return back()->with('error','Something went wrong !');
        }
    }
}

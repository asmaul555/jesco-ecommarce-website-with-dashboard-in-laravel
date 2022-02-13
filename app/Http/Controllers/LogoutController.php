<?php

namespace App\Http\Controllers;
use App\Models\User;


class LogoutController extends Controller
{
    public function logout(){
        if(session('user')){
            session()->pull('user');
            return redirect('/login');
        }
    }
}
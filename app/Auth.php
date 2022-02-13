<?php

use App\Models\User;

class Auth{
     static function user(){
        return User::where('email',session('user'))->first();
        
    }
}
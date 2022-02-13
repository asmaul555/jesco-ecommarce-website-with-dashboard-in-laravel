<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    //    $this->middleware('isLoggedin');
    }
    public function index(){
        $all_product=Product::all();
        return view('frontend.home',compact('all_product'));
    }
}

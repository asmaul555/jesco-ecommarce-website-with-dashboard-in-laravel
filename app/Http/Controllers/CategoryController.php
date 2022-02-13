<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLoggedin');
    }
    public function index(){
        return view('categories.create');
    }

    public function create(Request $request){
         
        $request->validate([
            'category'=>'required',
        ]);

        $cate=Str::lower($request->category);
        $id=Auth::user()->id;
        $category=new Categories;
        if($category->where('category_name',$cate)->exists()){

            return back()->with('insertError','Already exists !');

        }else{
            $category->category_name=$cate;
            $category->added_by=$id;
            $category->created_at=Carbon::now();

            if($category->save()){
                return back()->with('insertDone','Inserted success !');
            }
        }
    }

    public function show(){
        $categ=Categories::with('user')->get();
        return view('categories.show',compact('categ'));
    }
    public function get(){
        return Categories::with('user')->get();
    }

    public function moveTotrushed($id){
        Categories::where('id',$id)->delete();
        return back();
    }

    public function trushed(){
        
        $trush=Categories::onlyTrashed()->get();
        return view('categories.trushed',compact('trush'));
    }


    public function delete($id){
        Categories::where('id',$id)->forceDelete();
        return back();
    }


    public function restore($id){
        Categories::where('id',$id)->restore();
        return back();
    }
    public function edit($id){
        $edits=Categories::where('id',$id)->get();
        return view('categories.edit',compact('edits'));
    }

    public function editInsert(Request $request){
        $request->validate([
            'edit_category_name'=>'required',
            'edit_category_id'=>'required',

        ]);
        $edit_category_name=Str::lower($request->edit_category_name);
        $check=Categories::find($request->edit_category_id)->exists();
        if($check){
            Categories::where('id',$request->edit_category_id)->update(['category_name'=>$edit_category_name]);
            return redirect('/category/show');
        }else{
            return back()->with('insertError',"Not exists !");
        }
    }
    
}

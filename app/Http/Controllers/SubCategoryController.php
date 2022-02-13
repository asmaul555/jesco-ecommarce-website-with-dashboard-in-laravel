<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\SubCategory;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLoggedin');
    }
    public function index(){
       
        $allCategories=Categories::all();
        return view('subcategories.create',compact('allCategories'));
    }

    public function create(Request $request){
         
        $request->validate([
            'sub_category_name'=>'required',
            'category_id'=>'required'
        ]);

        $sub_category_name=Str::lower($request->sub_category_name);
        $id=Auth::user()->id;
        $subcategory=new SubCategory;
        if($subcategory->where('sub_category_name',$sub_category_name)->exists()){

            return back()->with('insertError','Already exists !');

        }else{
            $subcategory->sub_category_name=$sub_category_name;
            $subcategory->category_id=$request->category_id;
            $subcategory->added_by=$id;
            $subcategory->created_at=Carbon::now();
            if($subcategory->save()){
                return back()->with('insertDone','Inserted success !');
            }
        }
    }

    public function show(){
        $subcateg=SubCategory::with('user')->get();
        $category_info=SubCategory::with('categories')->get();
        return view('subcategories.show',compact('category_info','subcateg'));
    }
    public function get(){
        return SubCategory::with('user')->get();
    }

    public function moveTotrushed($id){

        SubCategory::where('id',$id)->delete();
        return back();
    }

    public function trushed(){
        
        $trush=SubCategory::onlyTrashed()->get();
        $category=SubCategory::with('categories')->get();
        return view('subcategories.trushed',compact('trush','category'));
    }


    public function delete($id){
        SubCategory::where('id',$id)->forceDelete();
        return back();
    }


    public function restore($id){
        SubCategory::where('id',$id)->restore();
        return back();
    }
    public function edit($id){
        $edits=SubCategory::where('id',$id)->get();
        return view('subcategories.edit',compact('edits'));
    }

    public function editInsert(Request $request){
        $request->validate([
            'edit_sub_category_name'=>'required',
            'edit_sub_category_id'=>'required',

        ]);
        $edit_sub_category_name=Str::lower($request->edit_sub_category_name);
        $check=SubCategory::find($request->edit_sub_category_id)->exists();
        if($check){
            SubCategory::where('id',$request->edit_sub_category_id)->update(['sub_category_name'=>$edit_sub_category_name]);
            return redirect('/subcategory/show');
        }else{
            return back()->with('insertError',"Not exists !");
        }
    }
}

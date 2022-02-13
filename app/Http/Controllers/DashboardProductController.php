<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\SubCategory;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

use function PHPUnit\Framework\isTrue;

class DashboardProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLoggedin');
    }
   public function index(){
       $all_category=Categories::all();
    //    $all_sub_category=SubCategory::all();
        return view('products.create',compact('all_category'));
    }

    public function create(Request $request){
        
        $request->validate([
            'product_name'=>'required',
            'new_price'=>'required',
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
        ]);

        $product_slug=Str::lower(Str::slug($request->product_name));
        $product_sku=Str::lower(Str::substr($request->product_name,0,3)."-".Str::random(10));
        
       $product_id=Product::insertGetId([
            'product_name'=>$request->product_name,
            'old_price'=>$request->old_price,
            'new_price'=>$request->new_price,
            'category_id'=>$request->category_id,
            'sub_category_id'=>$request->sub_category_id,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'product_slug'=>$product_slug,
            'product_sku'=>$product_sku,
            'added_by'=>Auth::user()->id,
            'created_at'=>Carbon::now()
        ]);

        if($request->file('product_image')){
            $this->validate($request, [
                'product_image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ]);
            
            $image = $request->file('product_image');
            $input['product_image'] =$product_id.'.'.$image->getClientOriginalExtension();
            
            $destinationPath = public_path('/uploads/product_photos');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->save($destinationPath.'/'.$input['product_image']);
            Product::where('id',$product_id)->update(['product_image'=>$input['product_image']]);
            return back()->with('insertDone','Product inserted succssfully');
        }
    }
    public function show(){
        $all_product=Product::with('addeduser')->get();
        return view('products.show',compact('all_product'));
    }

    public function edit($id){
        $all_product=Product::all();
        if(count($all_product)==0){
            return redirect('/dashboard/product/index');
        }
        $edit_product=Product::where('id',$id)->first();
        $all_category=Categories::all();
        $category=Categories::where('id',$edit_product->category_id)->first();
        $sub_category=SubCategory::where('id',$edit_product->sub_category_id)->first();
        $all_sub_category=SubCategory::all();
        return view('products.edit',compact('edit_product','all_category','all_sub_category','category','sub_category'));
    }

    public function update(Request $request){
        $request->validate([
            'product_id'=>'required',
            'product_name'=>'required',
            'new_price'=>'required',
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
        ]);
        $product_slug=Str::lower(Str::slug($request->product_name));
        $product_sku=Str::lower(Str::substr($request->product_name,0,3)."-".Str::random(10));
        
       $product_id=Product::where('id',$request->product_id)->update([
            'product_name'=>$request->product_name,
            'old_price'=>$request->old_price,
            'new_price'=>$request->new_price,
            'category_id'=>$request->category_id,
            'sub_category_id'=>$request->sub_category_id,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'product_slug'=>$product_slug,
            'product_sku'=>$product_sku,
            'created_at'=>Carbon::now()
        ]);
        if($request->file('product_image')){
            $this->validate($request, [
                'product_image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ]);
            
            $image = $request->file('product_image');
            $input['product_image'] =$request->product_id.'.'.$image->getClientOriginalExtension();
            
            $destinationPath = public_path('/uploads/product_photos');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->save($destinationPath.'/'.$input['product_image']);
            Product::where('id',$request->product_id)->update(['product_image'=>$input['product_image']]);
            return back()->with('insertDone','Product updated succssfully');
        }else{
            return back()->with('insertDone','Product updated succssfully');
        }
    }

    public function subCategory($id){
        $sub_c = DB::table('sub_categories')->where('category_id', $id)->get(['*']);
        return response()->json($sub_c);
    }

    public function moveToTrush($id){
        $isTrue=Product::where('id',$id)->update(['deleted_by'=>Auth::user()->id]);
        if($isTrue){
            Product::where('id',$id)->delete();
        }
        return back();
    }

    public function allTrush(){
        $trushs=Product::onlyTrashed()->with('deleteduser')->get();
        return view('products.all_trush',compact('trushs'));
    }

    public function restore($id){
        Product::where('id',$id)->restore();
        return back();
    }

    public function delete($id){
        Product::where('id',$id)->forceDelete();
        return back();
    }

}

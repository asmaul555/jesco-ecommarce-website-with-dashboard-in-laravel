<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function singleProduct($slug,$id){
        // return ProductReview::where('product_id',$id)->first();
        $single_product=Product::where(['id'=>$id,'product_slug'=>$slug])->with('reviews')->first();
        if($single_product){
            return view('frontend.single-product',compact('single_product'));
        }
        return 'Product not found';
    }

    public function productReview(Request $request){
        $request->validate([
            'product_id'=>'required',
            'review_name'=>'required',
            'review_email'=>'required',
            'review_message'=>'required',
        ]);

        $productreview=new ProductReview;
        $productreview->product_id=$request->product_id;
        $productreview->review_name=$request->review_name;
        $productreview->review_email=$request->review_email;
        $productreview->review_message=$request->review_message;
        $productreview->review_rating=$request->review_rating;

        if($productreview->save()){
            return back();
        }
    }
}

@extends('dashboard.master')

@section('content')
<div class="row justify-content-center">
        <h3 class="col-12">Edit product</h3>
        <div class="col">

            @if(@session('insertError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{session('insertError')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if(@session('insertDone'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('insertDone')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

        <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
           <div class="row">
            @csrf  
            <input hidden name="product_id" type="text" value="{{$edit_product->id}}">
            <div class="mb-3 col-3">
                <label for="product_name" class="form-label text-uppercase">product name</label>
                <input value="{{$edit_product->product_name}}" type="text" name="product_name" class="form-control" placeholder="product name">
                @error('product_name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>



            <div class="mb-3 col-3">
                <label for="old_price" class="form-label text-uppercase">old price</label>
                <input value="{{$edit_product->old_price}}" type="text" name="old_price" class="form-control" placeholder="old price">
                @error('old_price')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3 col-3">
                <label for="new_price" class="form-label text-uppercase">new price</label>
                <input value="{{$edit_product->new_price}}" type="text" name="new_price" class="form-control" placeholder="new price">
                @error('new_price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
            </div>

            <div class="mb-3 col-3">
                <label for="category_id" class="form-label text-uppercase">category name</label>
                <select name="category_id" class="custom-select" id="category_id">
                    @foreach ($all_category as $categories)
                    <option {{$categories->category_name==$category->category_name?'selected':false}} value="{{$categories->id}}">{{$categories->category_name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div class="mb-3 col-3">
                <label for="sub_category_id" class="form-label text-uppercase">sub category name</label>
  
                <select name="sub_category_id" class="custom-select" id="sub_category_id">
                   
                </select>
                @error('sub_category_id')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3 col-4">
                <label for="short_description" class="form-label text-uppercase">short description</label>
                <textarea name="short_description" id="short_descriptrion" class="form-control" rows="1">{{$edit_product->short_description}}</textarea>
                @error('short_description')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3 col-5">
                <label for="long_description" class="form-label text-uppercase">long description</label>
                <textarea name="long_description" id="long_descriptrion" class="form-control" rows="1">{{$edit_product->long_description}}</textarea>
                @error('long_description')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <div class="mb-3 col-5">
                <label for="product_image" class="form-label text-uppercase">product image</label>
                <input value="{{$edit_product->product_image}}" type="file" name="product_image" id="product_image" class="form-control"/>
                @error('product_image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <img id="show-product-img" src="{{asset('uploads/product_photos')}}/{{$edit_product->product_image}}" width="100" alt="">
            </div>
    


            <div class="mb-3 col-12">
                <input class="btn btn-sm btn-primary" type="submit" value="Update">
            </div>

           </div>
            
        </form>
    </div>
    </div>
    <script>
         document.getElementById('product_image').addEventListener('change',(e)=>{
            let fileReader=new FileReader();
            fileReader.onload=function(e){
                document.getElementById('show-product-img').src=fileReader.result
                document.getElementById('show-product-img').style.display="block"

            }
            fileReader.readAsDataURL(e.target.files[0])
        })
        window.onload=function(){
           let id=document.querySelector('#category_id')
            ajaxCall(id.value)
        }
        document.querySelector('#category_id').addEventListener('change',(e)=>{
            ajaxCall(e.target.value)
        })


        function ajaxCall(id){

            let xhr=new XMLHttpRequest()
             xhr.responseType='json';
             xhr.onload=function(res){
                 
                 document.getElementById('sub_category_id').innerHTML='';
                    xhr.response.forEach((item,index)=>{
                        
                        document.getElementById('sub_category_id').innerHTML+=`
                     <option ${item.sub_category_name=='{{$sub_category->sub_category_name}}'?'selected':false} value="${item.id}">${item.sub_category_name}</option>
                    `})
                    
                    
             }
             xhr.open('GET',`{{url('dashboard/product/subcategory')}}/${id}`,true)
             xhr.send()
        }
     </script>
@endsection
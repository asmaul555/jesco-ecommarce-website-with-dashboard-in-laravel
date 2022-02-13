@extends('dashboard.master')

@section('content')
    <div class="row justify-content-center text-center">
        <div class="col">
            
       <table class="table table-bordered text-dark">
           <thead>
               <th>Sl</th>
               <th>PRODUCT_NAME</th>
               <th>OLD_PRICE</th>
               <th>NEW_PRICE</th>
               <th>PRODUCT_IMAGE</th>
               <th>SHORT_DESCRIPTION</th>
               <th>STATUS</th>
               <th>CREATED_AT</th>
               <th>ADDED_BY</th>
               <th>ACTIONS</th>
           </thead>
           <tbody>
            @if (count($all_product)>0)
            @foreach ($all_product as $product)
            
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$product->product_name}}</td>
                <td>${{$product->old_price}}</td>
                <td>${{$product->new_price}}</td>
                <td><img src="{{asset('uploads/product_photos')}}/{{$product->product_image}}" width="150" alt="{{$product->porduct_image}}"></td>
                <td style="overflow: auto">{{$product->short_description}}</td>
                <td>-</td>
                <td>{{$product->created_at}}</td>
             
                
                <td>{{$product->addeduser->name}}</td>
                <td><div>
                    
                        <a class="btn btn-sm btn-success m-2 mt-0 mb-0" href="{{url('dashboard/product/edit')}}/{{$product->id}}">Edit</a>
                        <a class="btn btn-sm btn-danger" href="{{url('/dashboard/product/movetotrush')}}/{{$product->id}}">Trush</a>
                    </div></td>
            </tr>
           
            @endforeach
            @else
            <tr><td class="text-danger" colspan='10'> No Data</td></tr> 
            @endif

           </tbody>
       </table>

    </div>
    </div>
@endsection
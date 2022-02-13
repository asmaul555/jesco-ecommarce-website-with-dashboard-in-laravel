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
               <th>DELETED_AT</th>
               <th>DELETED_BY</th>
               <th>ACTIONS</th>
           </thead>
           <tbody>
            @if (count($trushs)>0)
            @foreach ($trushs as $trush)
            
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$trush->product_name}}</td>
                <td>${{$trush->old_price}}</td>
                <td>${{$trush->new_price}}</td>
                <td><img src="{{asset('uploads/product_photos')}}/{{$trush->product_image}}" width="150" alt="{{$trush->porduct_image}}"></td>
                <td style="overflow: auto">{{$trush->short_description}}</td>
                <td>-</td>
                <td>{{$trush->deleted_at}}</td>
             
                
                <td>{{$trush->deleteduser->name}}</td>
                <td><div>
                    
                        <a class="btn btn-sm btn-success m-2 mt-0 mb-0" href="{{url('dashboard/product/restore')}}/{{$trush->id}}">Restore</a>
                        <a class="btn btn-sm btn-danger" href="{{url('/dashboard/product/delete')}}/{{$trush->id}}">Delete</a>
                    </div></td>
            </tr>
           
            @endforeach
            @else
            <tr><td class="text-danger" colspan='10'>Trush is empty !</td></tr> 
            @endif

           </tbody>
       </table>

    </div>
    </div>
@endsection
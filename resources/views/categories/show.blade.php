@extends('dashboard.master')

@section('content')
    <div class="row justify-content-center text-center">
        <div class="col-9">
            
       <table class="table bordered">
           <thead>
               <th>Sl</th>
               <th>Category_name</th>
               <th>Status</th>
               <th>Added_by</th>
               <th>Actions</th>
           </thead>
           <tbody>
              
            @foreach ($categ as $item)
            
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$item->category_name}}</td>
                @if ($item->status==1)
                <td><button class="btn btn-sm btn-primary">active</button></td>
                @else
                <td><button class="btn btn-sm btn-danger">de-active</button></td>
                @endif
                
                <td>{{$item->user->name}}</td>
                <td><div>
                    
                        <a class="btn btn-sm btn-success m-2 mt-0 mb-0" href="{{url('/category/edit')}}/{{$item->id}}">edit</a>
                        <a class="btn btn-sm btn-danger" href="{{url('/category/trushed')}}/{{$item->id}}">trush</a>
                    </div></td>
            </tr>
            @endforeach
           </tbody>
       </table>

    </div>
    </div>
@endsection
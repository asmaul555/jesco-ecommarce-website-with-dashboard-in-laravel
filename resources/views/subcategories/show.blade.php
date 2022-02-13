@extends('dashboard.master')

@section('content')
    <div class="row justify-content-center text-center">
        <div class="col-9">

       <table class="table bordered">
           <thead>
               <th>Sl</th>
               <th>Sub_category_name</th>
               <th>Category_name</th>
               <th>Status</th>
               <th>Created_at</th>
               <th>Added_by</th>
               <th>Actions</th>
           </thead>
           <tbody>
            
            @foreach ($subcateg as $item)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$item->sub_category_name}}</td>
                <td>{{$category_info[$loop->index]->categories->category_name}}</td>
                @if ($item->status==1)
                <td><div class="text-success">active</div></td>
                @else
                <td><div class="text-danger">de-active</div></td>
                @endif
                <td>{{$item->created_at->format('d/m/Y')}}</td>
                <td>{{$item->user->name}}</td>
                <td><div>
                    
                        <a class="btn btn-sm btn-success m-2 mt-0 mb-0" href="{{url('/subcategory/edit')}}/{{$item->id}}">edit</a>
                        <a class="btn btn-sm btn-danger" href="{{url('/subcategory/trushed')}}/{{$item->id}}">trush</a>
                    </div></td>
            </tr>
            @endforeach
           </tbody>
       </table>

    </div>
    </div>
@endsection
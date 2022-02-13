@extends('dashboard.master')

@section('content')
    <div class="row justify-content-center text-center">
        <div class="col-10">

       <table class="table bordered">
           <thead>
               <th>Sl</th>
               <th>Sub_category_name</th>
               <th>Category_name</th>
               <th>Status</th>
               <th>Added_by</th>
               <th>Deleted_at</th>
               <th>Actions</th>
           </thead>
           <tbody>

            @foreach ($trush as $item)
                
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$item->sub_category_name}}</td>
                <td>{{$category[$loop->index]->categories->category_name}}</td>
                @if ($item->deleted_at)
                <td><div class="text-danger">de-active</div></td>
                @else
                <td><div class="text-success">active</div></td>
                @endif
               
                <td>{{$item->user->name}}</td>
                <td>{{ $item->deleted_at->format('d/m/Y')}}</td>
                <td><div>
                    <a class="btn btn-sm btn-primary" href="{{url('/subcategory/restore')}}/{{$item->id}}">Restore</a>
                <a class="btn btn-sm btn-danger" href="{{url('/subcategory/delete')}}/{{$item->id}}">Delete</a>
                    </div></td>
            </tr>
            @endforeach
           </tbody>
       </table>

    </div>
    </div>
@endsection
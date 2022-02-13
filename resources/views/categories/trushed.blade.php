@extends('dashboard.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-9">
            <h3>All trushed</h3>
       <table class="table bordered  text-center">
           <thead>
               <th>Sl</th>
               <th>Category Name</th>
               <th>Status</th>
               <th>Deleted_at</th>
               <th>Added_by</th>
    
               <th>Actions</th>
           </thead>
           <tbody>
            @foreach ($trush as $item)
                
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$item->category_name}}</td>
                @if ($item->deleted_at)
                <td><div class="text-danger">de-active</div></td>
                @else
                <td><div class="text-success">active</div></td>
                @endif
                <td>{{ $item->deleted_at->format('d/m/Y')}}</td>
                <td>{{$item->user->name}}</td>
                <td><div>
                    <a class="btn btn-sm btn-primary" href="{{url('/category/restore')}}/{{$item->id}}">Restore</a>
                <a class="btn btn-sm btn-danger" href="{{url('/category/delete')}}/{{$item->id}}">Delete</a>
                    </div></td>
            </tr>
            @endforeach
           </tbody>
       </table>

    </div>
    </div>
@endsection
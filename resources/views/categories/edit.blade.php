@extends('dashboard.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-9">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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

        <form action="{{url('/category/edit')}}" method="post">
            @csrf  
            @foreach ($edits as $edit)
            <div class="mb-3">
                <label for="category" class="form-label">Edit category</label>
                <input type="text" name="edit_category_name" value="{{$edit->category_name}}" class="form-control" placeholder="Edit category">
                <input hidden type="text" name="edit_category_id" value="{{$edit->id}}" class="form-control">
            </div>
            @endforeach
            <div class="mb-3">
                <input class="btn btn-warning btn-sm" type="submit" value="Save">
            </div>
            
        </form>
    </div>
    </div>
@endsection
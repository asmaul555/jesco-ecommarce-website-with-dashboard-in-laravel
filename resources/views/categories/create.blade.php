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

        <form action="{{route('category.create')}}" method="post">
            @csrf  
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" name="category" class="form-control" placeholder="Add category">
            </div>
            <div class="mb-3">
                <input class="btn btn-sm btn-primary" type="submit" value="Add">
            </div>
            
        </form>
    </div>
    </div>
@endsection
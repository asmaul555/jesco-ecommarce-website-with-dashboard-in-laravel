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

        <form action="{{route('subcategory.create')}}" method="post">
            @csrf  
            <select id="category" name="category_id" class="form-select form-control mb-3" aria-label=".form-select-lg example">
                <option value="">Select category</option>
                @foreach ($allCategories as $category)
                
                <option value="{{$category->id}}">{{$category->category_name}}</option>

                @endforeach
            </select>
            <div class="mb-3">
                <label for="category" class="form-label">Sub category</label>
                <input type="text" name="sub_category_name" class="form-control" placeholder="Add sub category">
            </div>
            <div class="mb-3">
                <input type="submit" value="Add">
            </div>
            
        </form>
    </div>
    </div>
@endsection
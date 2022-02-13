<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('backend')}}/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="{{asset('backend')}}/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/libs/css/style.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form class="splash-container" action="{{route('register.create')}}" method="POST">
        @csrf
        <div class="card">
            @if (session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-header">
                <h3 class="mb-1">Registrations Form</h3>
                <p>Please enter your user information.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="name" placeholder="Enter name" value="{{old('name')}}">
                    @error('name')
                        <small class="text-danger">{{$message}}*</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter mail" value="{{old('email')}}">
                    @error('email')
                    <small class="text-danger">{{$message}}*</small>
                @enderror
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password">
                    @error('password')
                    <small class="text-danger">{{$message}}*</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" value="" name="password_confirmation" class="form-control form-control-lg"  placeholder="Enter confirm password">
                    @error('password_confirmation')
                    <small class="text-danger">{{$message}}*</small>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" type="submit">Register My Account</button>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
                    </label>
                </div>
                <div class="form-group row pt-0">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                        <button class="btn btn-block btn-social btn-facebook " type="button">Facebook</button>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <button class="btn  btn-block btn-social btn-twitter" type="button">Twitter</button>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p>Already member? <a href="{{route('login.index')}}" class="text-secondary">Login Here.</a></p>
            </div>
        </div>
    </form>
</body>

 
</html>
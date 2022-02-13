<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
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

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">

            <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="{{asset('backend')}}/assets/images/logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
            @if (session('error'))
             <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="card-body">
                <form action="{{route('login.check')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="email" class="form-control form-control-lg" id="email" type="text" placeholder="User email" autocomplete="off">
                        @error('email')
                        <small class="text-danger">{{$message}}*</small>
                    @enderror
                    </div>
                    <div class="form-group">
                        <input name="password" class="form-control form-control-lg" id="password" type="password" placeholder="Password">
                        @error('password')
                        <small class="text-danger">{{$message}}*</small>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="{{route('register.index')}}" class="footer-link">Create An Account</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{asset('backend')}}/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="{{asset('backend')}}/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>
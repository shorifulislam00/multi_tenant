<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('backend/fonts/icomoon/style.css') }}">

        <link rel="stylesheet" href="{{ asset('backend/css/owl.carousel.min.css')  }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

        <title>Login</title>
    </head>
<body>


    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url({{ URL::asset('backend/images/login_bg.avif') }});  ">

        </div>
        <div class="contents order-2 order-md-1">

        <div class="container">
            <div class="row align-items-center justify-content-center">
            <div class="col-md-7 bg-secondary p-4 text-light rounded">
                <h3 style="color: rgb(72, 202, 32); font-family: italic" class="my-3 text-center"><strong>Property Management System</strong></h3>
                <h3 class="my-3 text-center"><strong>Login</strong></h3>

                <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group first">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="your-email@gmail.com" id="email">
                </div>
                <div class="form-group last mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Your Password" id="password">
                </div>

                <div class="d-flex mb-5 align-items-center">
                    <label class="control  control--checkbox mb-0"><span class="caption text-light">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                    </label>

                </div>

                <x-primary-button class="ms-3 btn-primary rounded">
                    {{ __('Log in') }}
                </x-primary-button>

                </form>
            </div>
            </div>
        </div>
        </div>


    </div>



    <script src=" {{ asset('backend/scripts/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/scripts/popper.min.js') }}"></script>
    <script src="{{ asset('backend/scripts/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/scripts/main.js') }}"></script>
</body>

</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> @yield('title') </title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <link href=" {{asset('backend/css/stackpath.bootstrap.min.css') }} " rel="stylesheet">
    <link href=" {{asset('backend/css/jsdelivr.bootstrap.min.css') }} " rel="stylesheet">
    <link href=" {{asset('backend/css/main.css') }} " rel="stylesheet">
    <link href=" {{asset('backend/css/jquery-ui.css') }} " rel="stylesheet">
    <link href=" {{asset('backend/css/select2.min.css') }} " rel="stylesheet">
    {{-- // sweetalear --}}
    <link href=" {{asset('backend/css/sweetalert.css') }} " rel="stylesheet">
    <link href=" {{asset('backend/css/sweetalert2.min.css') }} " rel="stylesheet">
    {{-- // toastr --}}
    <link href=" {{asset('backend/css/toastr.min.css') }} " rel="stylesheet">



    @yield('styles')

</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

        <!-- start header here -->
           @include('admin.layouts.header')

        <!-- end header here -->

       <!-- start layout option  here -->

       @include('admin.layouts.layout_option')

        <!-- end layout option  here -->


        <div class="app-main">

        <!-- start sidebar  here -->

        @include('admin.layouts.sidebar')

        <!-- end sidebar  here -->

            <div class="app-main__outer">

                <!-- start dashboard  here -->
                    @yield('content')
                <!-- end dashboard  here -->

                <!-- start footer  here -->
                     @include('admin.layouts.footer')
                <!-- end footer here -->
            </div>
        </div>
    </div>


    @yield('modal')

    <script src="{{ asset('backend/scripts/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/scripts/select2.min.js') }}"></script>
    <script src="{{ asset('backend/css/stackpath.bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/css/jsdelivr.bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src=" {{asset('backend/scripts/main.js')}} "></script>

    // sweetalert
    <script type="text/javascript" src=" {{asset('backend/scripts/sweetalert.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('backend/scripts/sweetalert2@11.js')}} "></script>
    // toastr
    <script type="text/javascript" src=" {{asset('backend/scripts/toastr.min.js')}} "></script>

    @yield('scripts')


</body>

</html>

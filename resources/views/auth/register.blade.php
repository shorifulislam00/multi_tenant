{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <section class="vh-100 bg-image"
        style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
          <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                  <div class="card-body p-5">
                    <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                    <form>

                      <div data-mdb-input-init class=" mb-4">
                        <input type="text" id="form3Example1cg" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example1cg">Your Name</label>
                      </div>

                      <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="form3Example3cg" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example3cg">Your Email</label>
                      </div>

                      <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form3Example4cg" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example4cg">Password</label>
                      </div>

                      <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form3Example4cdg" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                      </div>

                      <div class="form-check d-flex justify-content-center mb-5">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                        <label class="form-check-label" for="form2Example3g">
                          I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                        </label>
                      </div>

                      <div class="d-flex justify-content-center">
                        <button type="button"
                          data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                      </div>

                      <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                          class="fw-bold text-body"><u>Login here</u></a></p>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>
</x-guest-layout> --}}


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

        <title>Registration</title>

        <style>
            .divider:after,
                    .divider:before {
                    content: "";
                    flex: 1;
                    height: 1px;
                    background: #eee;
                    }
                    .h-custom {
                    height: calc(100% - 73px);
                    }
                    @media (max-width: 450px) {
                    .h-custom {
                    height: 100%;
                    }
                    }
        </style>
    </head>
<body>


    <section class="vh-100">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
              <img src="{{ asset('backend/images/draw2.webp') }}"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-6 col-lg-4 d-flex justify-content-center p-3 col-xl-4 offset-xl-1" style="background-color: rgb(50, 47, 41); border-radius: 20px;" >
                <form method="POST" action="{{ route('register') }}">

                    @csrf
                    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mb-4">
                        <h2 class="text-center" style="color: rgb(17, 213, 227); font-family:italic " >Property Management System </h2>

                    </div>



                    <div data-mdb-input-init class=" ">
                        <input  type="text" name="name" id="form3Example1cg" class="form-control " placeholder="Enter name"/>

                    </div>

                    <div data-mdb-input-init class="mt-4">
                        <input  type="email" name="email" id="name" class="form-control " placeholder="Enter email" />

                    </div>

                    <div data-mdb-input-init class="mt-4">
                        <input  type="text" name="mobile_number" id="email" class="form-control " placeholder="Enter mobile number" />

                    </div>

                    <div data-mdb-input-init class="mt-4">
                        <input  type="password" name="password" id="password" class="form-control " placeholder="Enter password" />

                    </div>

                    <div data-mdb-input-init class="mt-4">
                        <input  type="password" name="password" id="password" class="form-control " placeholder="Enter confirm password"/>

                    </div>


                    <div class="col-lg-6 mt-4" style="margin-left: 100px">
                        <button type="submit"
                        data-mdb-button-init data-mdb-ripple-init class="btn text-center btn-success btn-block">Register</button>

                    </div>


              </form>
            </div>
          </div>
        </div>
        {{-- <div
          class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
          <!-- Copyright -->
          <div class="text-white mb-3 mb-md-0">
            Copyright © 2020. All rights reserved.
          </div>
          <!-- Copyright -->

          <!-- Right -->
          <div>
            <a href="#!" class="text-white me-4">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
              <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
          <!-- Right -->
        </div> --}}
      </section>



    <script src=" {{ asset('backend/scripts/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/scripts/popper.min.js') }}"></script>
    <script src="{{ asset('backend/scripts/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/scripts/main.js') }}"></script>
</body>

</html>

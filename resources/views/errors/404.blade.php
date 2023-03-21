<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> {{config('app.name')}} | 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{config('app.name')}}" name="description" />
    <meta content="{{config('app.name')}}" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('dash/assets/images/Logo-fav.png')}}" />

    <!-- Bootstrap Css -->
    <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-2 fw-medium">4<i class="bx bx-buoy bx-spin display-3" style="color: #713F93"></i>4</h1>
                        <h4 class="text-uppercase">Sorry, Page Not Found</h4>
                        <div class="mt-5 text-center">
                            <a class="btn waves-effect waves-light text-light" style="background: #713F93 !important" href="/">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <div>
                        <img src="{{URL::asset('assets/images/error-img.png')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/node-waves/waves.min.js')}}"></script>

    <script src="{{URL::asset('dash/assets/js/app.js')}}"></script>

</body>

</html>
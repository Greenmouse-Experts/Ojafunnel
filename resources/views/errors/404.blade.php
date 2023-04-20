@extends('layouts.frontend')
@section('page-content')
    <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    <div class="account-pages mb-5 pt-5" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-2 fw-medium">4<i class="bx bx-buoy bx-spin display-3" style="color: #713F93"></i>4</h1>
                        <h4 class="text-uppercase">Oops, Something went wrong</h4>
                        <p>We couldn't find the page you were looking for, navigte with the button below</p>
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
@endsection
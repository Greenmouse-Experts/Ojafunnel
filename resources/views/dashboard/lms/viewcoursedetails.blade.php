@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->

        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">{{$course->title}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">New Course</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>
<!-- Init js-->
<script type="text/javascript" src="{{URL::asset('dash/assets/js/pages/form-xeditable.init.js')}}"></script>
<!-- Plugins js -->
<script type="text/javascript" src="{{URL::asset('dash/assets/libs/bootstrap-editable/js/index.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('dash/assets/libs/moment/min/moment.min.js')}}"></script>

<!-- Bootstrap Toasts Js -->
<script type="text/javascript" src="{{URL::asset('dash/assets/js/pages/bootstrap-toastr.init.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('dash/assets/js/pages/form-wizard.init.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('dash/assets/js/app.js')}}"></script>
<!-- form repeater js -->
<script src="{{URL::asset('dash/assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>

<script src="{{URL::asset('dash/assets/js/pages/form-repeater.int.js')}}"></script>
@endsection

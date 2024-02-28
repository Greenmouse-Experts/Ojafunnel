@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <input type="hidden" value="{{ csrf_token() }}" id="txt_token">
            <input type="hidden" value="{{ url('/') }}/" id="site_url">

            <div class="row">
                <div class="col-12 mt-4">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0" style="color:#333">
                                <li class="breadcrumb-item"><a style="color:#555!important" href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active" style="color:#333"><a style="color:#007bff!important" href="{{route('user.create.course', Auth::user()->username)}}">View Courses</a></li>
                                <!-- <li class="breadcrumb-item active" style="color:#333"><a style="color:#007bff!important" href="{{url('create-quiz/388338')}}">Create Quiz</a></li> -->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <h3 class="text-center"><b>Students Scores</b></h3>
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr class="font-500">
                                            <th scope="col">Students</th>
                                            <th scope="col">Scores</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($studentResults as $email => $result)
                                            <tr>
                                                <td>{{ $email }}</td>
                                                <td>{{ $result['passScore'] }} / {{ $result['totalScore'] }}</td>
                                                <td>{{ $result['student']['created_at']->toDayDateTimeString() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootrstrap touchspin -->
<script src="{{URL::asset('dash/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{URL::asset('dash/assets/js/pages/ecommerce-cart.init.js')}}"></script>

@endsection

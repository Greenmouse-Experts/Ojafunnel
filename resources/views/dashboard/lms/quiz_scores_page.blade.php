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
                                <li class="breadcrumb-item active" style="color:#333"><a style="color:#007bff!important" href="{{route('create-quiz', [Auth::user()->username, $quiz_id])}}">Create Quiz</a></li>
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
                                <table class="table align-middle mb-0 table-nowrap">
                                    <thead class="tread">
                                        <tr class="font-500">
                                            <th scope="col">Students</th>
                                            <th scope="col">Quiz Title</th>
                                            <th scope="col">Scores</th>
                                            <th scope="col">Date</th>
                                            <!-- <th scope="col">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($lmss) > 0)
                                        @foreach($lmss as $lms)
                                        @php
                                        if($lms->scores <= 3) $status="<font style='color:red'>(Failed)</font>" ; else if($lms->scores <= 5) $status="<font style='color:orange'>(Passed)</font>" ; else if($lms->scores > 5) $status = "<font style='color:green'>(Excellent)</font>";

                                                @endphp
                                                <tr class="table-{{ $lms->id }}">
                                                    <td class="font-size-14">
                                                        {{ $lms->email }}
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-14 text-truncate"><a class="text-dark">{{ ucwords($lms->quiz_titles) }} ({{ $lms->course_title }})</a></h5>
                                                    </td>
                                                    <td>
                                                        @if($lms->status == "Pass")
                                                        <span class="badge badge-pill badge-soft-success" style="background: greenyellow">{{$lms->status}}</span>
                                                        @else
                                                        <span class="badge badge-pill badge-soft-danger" style="background: red">{{$lms->status}}</span>
                                                        @endif
                                                    </td>

                                                    <td class="font-size-14">
                                                        {{ $lms->created_at }}
                                                    </td>
                                                    <!-- <td>
                                                            <a href="{{ $quiz_id }}/create-quiz-{{ $lms->session }}" title="View Quiz" class="action-icon text-primary mr-2"> <i class="fa fa-eye font-size-18"></i></a>

                                                            <a href="javascript:;" title="Delete" class="action-icon text-danger deteleQuizSession" ids="{{ $lms->id }}"> <i class="fa fa-trash font-size-18"></i></a>
                                                        </td> -->
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td style="text-align:center" colspan="5">
                                                        No students yet!
                                                    </td>
                                                </tr>
                                                @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="CartDelete" tabindex="-1" aria-labelledby="CartDeleteLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-body px-4 py-5 text-center">
                            <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="avatar-sm mb-4 mx-auto">
                                <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </div>
                            </div>
                            <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently remove this Product.</p>

                            <div class="hstack gap-2 justify-content-center mb-0">
                                <button type="button" class="btn btn-danger">Delete Now</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

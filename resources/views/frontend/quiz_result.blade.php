@extends('layouts.frontend')

<link rel='stylesheet' href="{{ asset('assets/css/sweetalert2.min.css') }}">
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>


<input type="hidden" value="{{ url('/') }}/" id="site_url">
<input type="hidden" value="{{ csrf_token() }}" id="txt_token">

@section('page-content')
{{-- <section class="faq-welcome" style="padding:120px 0px 20px 0px;"> --}}
    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text">
                    <h1>View Your Course</h1>
                </div>
            </div>
        </div>
    </div> --}}
{{-- </section> --}}

<section class="login" style="padding:80px 0px 20px 0px;">
    <div class="container">
        <div class="row">

            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                            <h4 class="mb-sm-0 font-size-18">Course Assessment Result</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('access_course') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Quiz Result</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div style="display: flex; flex-direction:row; justify-content:space-between">
                                    <h4 class="card-title mb-4">Quiz Result</h4>
                                    {{-- <span>{{$index}} of {{$raw}}</span> --}}
                                </div>

                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead class="tread">
                                            <tr>
                                                <th scope="col">Question</th>
                                                <th scope="col">Submitted</th>
                                                <th scope="col">Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($questions as $q)
                                            <tr>
                                                <td>
                                                    {{$q->question->questions}}
                                                </td>
                                                <td>
                                                    {{$q->answer}}
                                                </td>
                                                <td>
                                                    @if($q->status == "Pass")
                                                    <span class="badge badge-pill badge-soft-success" style="background: greenyellow">{{$q->status}}</span>
                                                    @else
                                                    <span class="badge badge-pill badge-soft-danger" style="background: red">{{$q->status}}</span>
                                                    @endif
                                                </td>
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
</section>
<!-- Ferent Ends -->


<script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/jscripts.js') }}"></script>


@endsection

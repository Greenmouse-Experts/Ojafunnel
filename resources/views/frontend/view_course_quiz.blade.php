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
                            <h4 class="mb-sm-0 font-size-18">Course Assessment</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('access_course') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Quiz</li>
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
                                    <h4 class="card-title mb-4">Quiz: {{$quiz->quiz_title}}</h4>
                                    <span>{{$index}} of {{$raw}}</span>
                                </div>
                                <form action="{{ route('submit.course.quiz', ['quizId' => $quiz->id, 'sessionId' => $question->session]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="next" value="{{$index}}">
                                    <input type="hidden" name="question_id" value="{{$question->id}}"/>
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead class="tread">
                                            <tr>
                                                <th scope="col">Question</th>
                                                <th scope="col">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{$question->questions}}
                                                </td>
                                                <td>
                                                    <ul style="list-style: none">
                                                        <li class="mt-3"><input type="radio" name="ans" value="{{$question->option1}}" /> {{$question->option1}}</li>
                                                        <li class="mt-3"><input type="radio" name="ans" value="{{$question->option2}}" /> {{$question->option2}}</li>
                                                        <li class="mt-3"><input type="radio" name="ans" value="{{$question->option3}}" /> {{$question->option3}}</li>
                                                        <li class="mt-3"><input type="radio" name="ans" value="{{$question->option4}}" /> {{$question->option4}}</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <button type="submit" id="makePayment" class="btn btn-primary text-white d-none d-sm-inline-block pull-right">
                                        Submit Question
                                    </button>
                                </div>
                                </form>
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

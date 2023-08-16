@extends('layouts.dashboard-frontend')

@section('page-content')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">

@endpush
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
                                <li class="breadcrumb-item active">Course</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Overview</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home1" role="tabpanel">
                                    <section class="course-content-area">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="course-curriculum-box">
                                                        <div class="course-curriculum-title clearfix">
                                                            <div class="title float-left" style="font-size:15px"><b>Quiz Title:</b> {{ ucfirst($lmss->quiz_title) }}</div>
                                                            <div class="title float-left" style="font-size:15px"><b>Description:</b> <font style="font-size:13.5px">{!! nl2br(ucfirst($lmss->description)) !!}</font></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>

                            <hr style="border-bottom:1px solid #ccc!important;margin:-30px 0 10px 0">



                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home1" role="tabpanel">
                                    <section class="course-content-area">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="course-curriculum-box">
                                                        <div class="course-curriculum-title clearfix" style="display:{{ !$QuizAnswers ? 'block' : 'none' }}">
                                                            <form class="quiz_questions" autocomplete="off">
                                                                @csrf
                                                                @if(count(App\Models\Quiz::where('course_id', $course->id)->where('user_id', Auth::user()->id)->where('session', $session)->get()) > 0)
                                                                    @foreach(App\Models\Quiz::where('course_id', $course->id)->where('user_id', Auth::user()->id)->where('session', $session)->orderByRaw('RAND()')->get() as $index => $quizes)

                                                                        @php
                                                                        $questions = ucfirst($quizes->questions);
                                                                        $op1 = $quizes->option1;
                                                                        $op2 = $quizes->option2;
                                                                        $op3 = $quizes->option3;
                                                                        $op4 = $quizes->option4;
                                                                        $ans1 = $quizes->ans1;

                                                                        $op1_1=$op1; $op1_2=$op2; $op1_3=$op3; $op1_4=$op4;
                                                                    
                                                                        $all_options = array($op1, $op2, $op3, $op4);
                                                                        if($op1!="" && $op2!="" && $op3=="" && $op4=="") $all_options = array($op1, $op2);
                                                                        if($op1!="" && $op2!="" && $op3!="" && $op4=="") $all_options = array($op1, $op2, $op3);
                                                                        shuffle($all_options);

                                                                        $k=1;

                                                                        //print_r($all_options)
                                                                        @endphp

                                                                        <div class="row mb-3">
                                                                            <!-- <input type='text' name='txtrandom_quiz' id='txtrandom_quiz' value='{{ $quizes->id }}'> -->

                                                                            <div class="col-12 mb-2" style="font-size:15px; color:#069; font-weight:600">{{ $index+1 }}. {{ ucfirst($questions) }}</div>

                                                                            @foreach($all_options as $keys)
                                                                                <?php
                                                                                if($k == 1) $m="<b>A)</b>";
                                                                                else if($k == 2) $m="<b>B)</b>";
                                                                                else if($k == 3) $m="<b>C)</b>";
                                                                                //else if($k == 4) $m="<b>D)</b>";
                                                                                else $m="<b>D)</b>";
                                                                                $keys1 = ucfirst($keys);
                                                                                ?>

                                                                                
                                                                                <!-- <li>
                                                                                    <label for='options$keys'>{!! $m !!}&nbsp;
                                                                                    <label class='container_radio'>{{ $keys1 }}
                                                                                    <input type='radio' name='options1' value='{{ $op1_1 }}' class='{{ $keys }}' id='options{{ $keys }}' ids=''>
                                                                                    <span class='checkmark'></span>
                                                                                    </label>
                                                                                </li> -->

                                                                                <div class="col-12" style="font-size:14px; color:#069; font-weight:500">
                                                                                    <label class="options" for="{{ $keys1 }}">
                                                                                        {!! $m !!}. <input type="radio" id="{{ $keys1 }}" name="option[{{ $index }}]" value="{{ $keys1 }}">
                                                                                        {{ ucfirst($keys1) }}
                                                                                    <label>
                                                                                </div>
                                                                                @php $k++; @endphp

                                                                            @endforeach
                                                                            <input type="hidden" id="{{ $quizes->ans }}" name="answers[]" value="{{ $quizes->ans }}">
                                                                        </div>
                                                                        
                                                                    @endforeach

                                                                    <input type="hidden" name="quiz_session1" class="quiz_session1" value="{{ $session }}" />
                                                                    <input type="hidden" name="course_id1" class="course_id1" value="{{ $course->id }}" />

                                                                    <div class="row mt-4">
                                                                        <div class="col-lg-12">
                                                                            <button type="button" class="submitAnswers custom_btns" style="float:left">Submit Answers</button>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <li>No quiz found yet</li>
                                                                @endif
                                                            </form>
                                                        </div>


                                                        <div class="course-curriculum-title clearfix div_score" style="display:{{ $QuizAnswers ? 'block' : 'none' }}">
                                                            <h3 class="text-center"><b>Your Score</b></h3>
                                                            @php $sum=0; @endphp
                                                            @if($QuizAnswers)
                                                                <h5 class="text-center mt-2 mb-4">You scored {{ $QuizAnswers->scores * 10 }}%</h5>
                                                                @php 
                                                                $user_answers1 = explode("||", $QuizAnswers->user_answers);
                                                                $real_answers1 = explode("||", $QuizAnswers->real_answers);
                                                                @endphp
                                                                <div class="row">
                                                                    <div class="col-6" style="color:#333"><h5><b>Your Answers</b></h5></div>
                                                                    <div class="col-6" style="color:#333"><h5><b>Correct Answers</b></h5></div>
                                                                    @foreach($user_answers1 as $index => $user_answer)
                                                                        @if($user_answer != "")
                                                                            @php $tick = "<i class='fa fa-times' style='color:red'></i>"; @endphp
                                                                            @if($user_answer == $real_answers1[$index])
                                                                                @php $tick = "<i class='fa fa-check' style='color:green'></i>"; @endphp
                                                                            @endif
                                                                            <div class="col-6 mb-1" style="font-size:14.5px;color:#444;">{{ $user_answer }}</div>
                                                                            <div class="col-6 mb-1" style="font-size:14.5px;color:#444;">{{ $real_answers1[$index] }} {!! $tick !!}</div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <div class="text-center mt-3">No scores yet!</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($QuizAnswers)
                                                    <div class="offset-md-4 col-md-4 text-center">
                                                        <button type="button" class="custom_btns cmdDone">I'm Done</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/js/tinymce.min.js') }}"></script>
<script src="{{ asset('frontend/js/multi-step-modal.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.webui-popover.min.js') }}"></script>
@endsection
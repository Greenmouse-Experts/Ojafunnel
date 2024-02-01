@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <input type="hidden" value="{{ csrf_token() }}" id="txt_token">
            <input type="hidden" value="{{ url('/') }}/" id="site_url">

            <!-- container-fluid -->
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
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-nowrap">
                                    <thead class="tread">
                                        <tr class="font-500">
                                            <th scope="col">Quiz Title</th>
                                            <th scope="col">Time Per Question</th>
                                            <th scope="col">Session</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Students</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($lmss) > 0)
                                        @foreach($lmss as $lms)
                                        <tr class="table-{{ $lms->id }}">
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="{{ $quiz_id }}/create-quiz-{{ $lms->session }}" class="text-dark">{{ ucwords($lms->quiz_title) }} ({{ $lms->counts }} questions)</a></h5>
                                            </td>
                                            <td>
                                                {{$lms->time_per_question}} seconds
                                            </td>
                                            <td>
                                                <div class="font-size-14">{{ $lms->session }}</div>
                                            </td>
                                            <td class="font-size-14">
                                                {{ $lms->course_title }}
                                            </td>
                                            <td class="font-size-14">
                                                <div>{{ \App\Models\QuizSubmission::distinct('candidate')->where(['quiz_id' => $lms->id, 'session' => $lms->session])->count();}} students wrote the test</div>
                                                <div class="mt-2"><a href="{{ $quiz_id }}/view-scores/{{ $lms->session }}/" style="font-size:13px">view Students scores</a></div>
                                            </td>
                                            <td class="font-size-14">
                                                {{ $lms->created_at }}
                                            </td>
                                            <td>
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editQuiz-{{$lms->id}}" title="Update" class="action-icon text-danger"> <i class="fa fa-edit font-size-18"></i></a>

                                                <a href="{{ route('create-quiz1', ['id' => $quiz_id, 'session' => 'enter-quiz-'.$lms->session, 'username' => Auth::user()->username]) }}" title="View Quiz" class="action-icon text-primary mr-2"> <i class="fa fa-eye font-size-18"></i></a>

                                                <a hre="javascript:;" title="Delete" class="action-icon text-danger deteleQuizSession" ids="{{ $lms->id }}"> <i class="fa fa-trash font-size-18"></i></a>

                                            </td>
                                            <!-- End Page-content -->
                                            <div class="modal fade" id="editQuiz-{{$lms->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                Edit {{$lms->quiz_title}}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="Edit-level">
                                                                    <form action="{{route('user.update.quiz', Crypt::encrypt($lms->id))}}" method="post">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="col-lg-12 mb-2">
                                                                                <label for="Name">Quiz Title</label>
                                                                                <input type="text" name="quiz_title" style="background:#F8F8FB" value="{{$lms->quiz_title}}" placeholder="Eg. Quiz 1" required />
                                                                            </div>
                                                                            <div class="col-lg-12 mb-2">
                                                                                <label for="Name">Time Per Question (In Seconds)</label>
                                                                                <input type="number" name="time_per_question" id="time_per_question" style="background:#F8F8FB" value="{{$lms->time_per_question}}" required />
                                                                            </div>
                                                                            <div class="col-lg-12 mb-2">
                                                                                <label for="Name">Quiz Description/Instructions</label>
                                                                                <textarea name="description" id="" style="height:9em!important" placeholder="Enter your quiz description or instructions" value="{{$lms->description}}" required>{{$lms->description}}</textarea>
                                                                            </div>
                                                                            <div class="row justify-content-between">
                                                                                <div class="col-6"></div>
                                                                                <div class="col-6 text-end">
                                                                                    <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091">
                                                                                        Update
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td style="text-align:center" colspan="5">
                                                No quiz session found here
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
@endsection

@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row card account-head" style="background:#6610f2;color:#fff">
                <div class="col-12">
                    <div class="py-3">
                        <h4 class="font-60">Create Quiz</h4>
                        <p>Create your quiz title and add questions and answers</p>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="commerce-con mb-4">
                    <form class="quiz_forms_input" autocomplete="off">
                        @csrf
                        <!-- store name -->

                        @if($sessions === "")
                            <div>
                                <div class="Editt">
                                    <div class="form">
                                        <h6 class="mt-2 mb-3" style="font-size:14px;line-height:21px;">A quiz session can have many questions underneath it, kindly create a session first before adding questions and answers</h6>
                                        <div class="row">
                                            <div class="col-lg-12 mb-2">
                                                <label for="Name">Quiz Title</label>
                                                <input type="text" name="quiz_title" style="background:#F8F8FB" value="" placeholder="Eg. Quiz 1" required />

                                                <input type="hidden" name="quiz_session" class="quiz_session" value="{{ time() }}" />
                                                <input type="hidden" name="course_id" class="course_id" value="{{ $quiz_id }}" />
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <label for="Name">Time Per Question (In Seconds)</label>
                                                <input type="number" name="time_per_question" id="time_per_question" style="background:#F8F8FB" value="" required />
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <label for="Name">Quiz Description/Instructions</label>
                                                <textarea name="description" id="" style="height:9em!important" placeholder="Enter your quiz description or instructions" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12" style="display: flex; justify-content: center;">
                                                <button type="button" class="storeSession custom_btns">Create Quiz</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <hr class="mt-0 mt-sm-4" />


                        @if($sessions !== "")
                            <div class="mt-4 questions_form">
                                <div class="Editt mb-5">
                                    <div class="form forms">
                                        @if(count($quizzes) > 0)
                                            @foreach($quizzes as $quiz)
                                                <div class="row mb-4" id="myForm">
                                                    <div class="col-sm-10 mb-3">
                                                        <label for="Name">Question</label>
                                                        <input type="text" name="question[]" class="reset" placeholder="Enter Question" required value="{{ $quiz->questions }}" />
                                                    </div>
                                                    <div class="col-sm-2 pl-2 mb-3">
                                                        <a href="{{route('user.delete.question', Crypt::encrypt($quiz->id))}}"type="button" class="removeForm remove_btn">Remove</a>
                                                    </div>
                                                    <div class="col-sm-6 mb-2">
                                                        <label for="Name">Option A</label>
                                                        <input type="text" name="option_a[]" class="reset" placeholder="Enter Option A" required value="{{ $quiz->option1 }}" />
                                                    </div>
                                                    <div class="col-sm-6 mb-2">
                                                        <label for="Name">Option B</label>
                                                        <input type="text" name="option_b[]" class="reset" placeholder="Enter Option B" required value="{{ $quiz->option2 }}" />
                                                    </div>
                                                    <div class="col-sm-6 mb-2">
                                                        <label for="Name">Option C (Optional)</label>
                                                        <input type="text" name="option_c[]" class="reset" placeholder="Enter Option C" value="{{ $quiz->option3 }}" />
                                                    </div>
                                                    <div class="col-sm-6 mb-2">
                                                        <label for="Name">Option D (Optional)</label>
                                                        <input type="text" name="option_d[]" class="reset" placeholder="Enter Option D" value="{{ $quiz->option4 }}" />
                                                    </div>
                                                    <div class="col-lg-12 mb-2">
                                                        <label for="Name">Paste Answer here</label>
                                                        <select name="ans[]" class="reset">
                                                            @php
                                                            $selected1=""; $selected2=""; $selected3=""; $selected4="";
                                                            if($quiz->option1 == $quiz->ans){
                                                                $selected1="selected";
                                                            }else if($quiz->option2 == $quiz->ans){
                                                                $selected2="selected";
                                                            }else if($quiz->option3 == $quiz->ans){
                                                                $selected3="selected";
                                                            }else if($quiz->option4 == $quiz->ans){
                                                                $selected4="selected";
                                                            }
                                                            @endphp
                                                            <option value="">-Select One-</option>
                                                            <option value="a" {{ $selected1 }}>A</option>
                                                            <option value="b" {{ $selected2 }}>B</option>
                                                            <option value="c" {{ $selected3 }}>C</option>
                                                            <option value="d" {{ $selected4 }}>D</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <label for="Name">Score</label>
                                                        <input type="text" name="score[]" class="reset" placeholder="Enter score" value="{{ $quiz->score }}" required/>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="quiz_each_id[]" class="quiz_each_id" value="{{ $quiz->id }}" />

                                            @endforeach

                                        @else

                                            <div class="row" id="myForm">
                                                <div class="col-sm-12 mb-3">
                                                    <label for="Name">Question</label>
                                                    <input type="text" name="question[]" class="reset" placeholder="Enter Question" required />
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="Name">Option A</label>
                                                    <input type="text" name="option_a[]" class="reset" placeholder="Enter Option A" required />
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="Name">Option B</label>
                                                    <input type="text" name="option_b[]" class="reset" placeholder="Enter Option B" required />
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="Name">Option C (Optional)</label>
                                                    <input type="text" name="option_c[]" class="reset" placeholder="Enter Option C" />
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="Name">Option D (Optional)</label>
                                                    <input type="text" name="option_d[]" class="reset" placeholder="Enter Option D" />
                                                </div>
                                                <div class="col-lg-12 mb-2">
                                                    <label for="Name">Paste Answer here</label>
                                                    <select name="ans[]" class="reset">
                                                        <option value="">-Select One-</option>
                                                        <option value="a">A</option>
                                                        <option value="b">B</option>
                                                        <option value="c">C</option>
                                                        <option value="d">D</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="Name">Score</label>
                                                    <input type="text" name="score[]" class="reset" placeholder="Enter score" required/>
                                                </div>
                                            </div>

                                        @endif

                                        <input type="hidden" name="quiz_session1" class="quiz_session1" value="{{ $sessions }}" />
                                        <input type="hidden" name="course_id1" class="course_id1" value="{{ $quiz_id }}" />

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 mt-1">

                                            <button type="button" class="add_more">Add more question</button>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-lg-12" style="display: flex; flex-direction: row;">
                                            <a href="{{ route('view-quiz', ['id' => $quiz_id, 'username' => Auth::user()->username]) }}" class="custom_btns" style="width: 40%; text-align: center;">Back to Quiz List</a>
                                            <button type="button" class="storeQuiz custom_btns" style="width: 40%">{{ count($quizzes) > 0 ? 'Update Quiz' : 'Submit Quiz' }}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif

                    </form>
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

<script src="{{URL::asset('dash/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{URL::asset('dash/assets/js/pages/ecommerce-cart.init.js')}}"></script>


<script>

    $(document).ready(function() {

        function addForm() {
            var newForm = `
            <div class="row mt-4" id="myForm">
                <div class="col-sm-10 pr-0 mb-3">
                    <label for="Name">Question</label>
                    <input type="text" name="question[]" placeholder="Enter Question" required />
                </div>
                <div class="col-sm-2 pl-2 mb-3">
                    <button type="button" class="removeForm remove_btn">Remove</button>
                </div>

                <div class="col-sm-6 mb-2">
                    <label for="Name">Option A</label>
                    <input type="text" name="option_a[]" class="reset" placeholder="Enter Option A" required />
                </div>
                <div class="col-sm-6 mb-2">
                    <label for="Name">Option B</label>
                    <input type="text" name="option_b[]" class="reset" placeholder="Enter Option B" required />
                </div>
                <div class="col-sm-6 mb-2">
                    <label for="Name">Option C (Optional)</label>
                    <input type="text" name="option_c[]" class="reset" placeholder="Enter Option C" />
                </div>
                <div class="col-sm-6 mb-2">
                    <label for="Name">Option D (Optional)</label>
                    <input type="text" name="option_d[]" class="reset" placeholder="Enter Option D" />
                </div>
                <div class="col-lg-12 mb-2">
                    <label for="Name">Paste Answer here</label>
                    <select name="ans[]" class="reset">
                        <option value="">-Select One-</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>
                <div class="col-12 mb-2">
                    <label for="Name">Score</label>
                    <input type="text" name="score[]" class="reset" placeholder="Enter score" required/>
                </div>
            </div>
            `;
            $('.forms').append(newForm);
        }

        $('.add_more').on('click', function() {
            addForm();
        });

        $('.forms').on('click', '.removeForm', function() {
            $(this).closest('#myForm').remove();
        });



    });
</script>
@endsection

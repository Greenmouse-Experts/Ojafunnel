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
            <div class="checkout-tabs mb-4">
                <div class="row">
                    <div class="col-xl-2 col-sm-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-shipping-tab" data-bs-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="true">
                                <i class="bi bi-card-checklist d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Curriculum</p>
                            </a>
                            <a class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">
                                <i class="bx bx-money d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Course Landing Page</p>
                            </a>
                            <a class="nav-link" id="v-pills-promotion-tab" data-bs-toggle="pill" href="#v-pills-promotion" role="tab" aria-controls="v-pills-promotion" aria-selected="false">
                                <i class="bi bi-person-check d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Promotions</p>
                            </a>
                            <a class="nav-link" style="background-color: #70418F; color:#fff; cursor: pointer;" href="{{route('user.save.course', Crypt::encrypt($course->id))}}" onclick="event.preventDefault();
                                document.getElementById('submit-button').submit();" value="save-review" class="btn px-4 py-1">
                                <p class="fw-bold mb-1 mt-2">Publish Course</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-sm-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                                        <div>
                                            <h4 class="card-title mb-4"><strong>Curriculum</strong></h4>
                                            <div id="appera">
                                                <div class="card-body" style="box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);  line-height: 1.8;">
                                                    <p class="card-title-desc text-dark font-600">
                                                        <i class="bi bi-info-circle" style="padding-right: 15px;"></i>Start putting together your course by creating sections, lectures and practice activities (quizzes, and assignments). Use your course outline to structure your content and label your sections and lectures clearly. If you’re intending to offer your course for free, the total length of video content must be less than 2 hours.
                                                        <a style="float: right;" onclick="myFunct()" class="btn btn-danger mt-3">Dismiss</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="font-500 mt-5">
                                                <p>
                                                    Start putting together your course by creating sections, lectures and practice <a href="#">
                                                        (quizzes,and assignments)
                                                    </a>.
                                                </p>
                                                <p>
                                                    Start putting together your course by creating sections, lectures and practice activities <a href="#">
                                                        (quizzes,and assignments)
                                                    </a>. Use your course outline to structure your content and label your sections and lectures clearly. If you’re intending to offer your course for free, the total length of video content must be less than 2 hours.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="font-500 mt-5">
                                            <p>
                                                Start putting together your course by creating sections, lectures and practice <a href="#">
                                                    (quizzes,and assignments)
                                                </a>.
                                            </p>
                                            <p>
                                                Start putting together your course by creating sections, lectures and practice activities <a href="#">
                                                    (quizzes,and assignments)
                                                </a>. Use your course outline to structure your content and label your sections and lectures clearly. If you’re intending to offer your course for free, the total length of video content must be less than 2 hours.
                                            <div class="lamet float-end"><a href="" data-bs-toggle="modal" data-bs-target="#createCurriculum"><strong><u>Create Curriculum</u></strong></a></div>
                                            </p>
                                        </div>
                                        @foreach(\App\Models\Section::where('course_id', $course->id)->get() as $section)
                                        <div class="common mt-5">
                                            <div class="assets">
                                                <h1 style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#section-{{$section->id}}"><b>Section {{$loop->iteration}}:</b> {{$section->title}}</h1>
                                               
                                                <div class="modal fade" id="section-{{$section->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-bottom-0">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    Section
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="Edit-level">
                                                                        <form method="post" action="{{route('user.action.curriculum', Crypt::encrypt($section->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <div class="col-lg-12">
                                                                                    <label>Title</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" placeholder="Enter Title" name="section_title" value="{{$section->title}}" class="input">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Objective</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <textarea name="section_objective" cols="30" rows="10" value="{{$section->objective}}" placeholder="Insert your Objective">{{$section->objective}}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row justify-content-between">
                                                                                    <div class="col-6">
                                                                                        <button name="submitbutton" value="Delete" type="submit" class="btn px-3" style="color: red; border: 1px solid red">
                                                                                            Delete
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="col-6 text-end">
                                                                                        <button name="submitbutton" value="Update" type="submit" class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
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
                                                <div class="actting">
                                                    <h1><b>Lessons</b>
                                                        <!-- <div class="lamet float-end"><a href="{{route('user.save.lesson', Crypt::encrypt($section->id))}}" data-bs-toggle="modal" data-bs-target="#createLesson{{ $section->id }}"><strong><u>Create Lesson</u></strong></a></div> -->
                                                        <div class="lamet float-end"><button class="open_modal btn" type="button" value="{{$section->id}}"><strong><u>Create Lesson</u></strong></button></div>
                                                    </h1>
                                                    <table id="" style="border-color: #fff;" class="table dt-responsive nowrap w-100">
                                                        <tbody>
                                                            @foreach(\App\Models\Lesson::where('section_id', $section->id)->get() as $lesson)
                                                            <tr>
                                                                <td><b>Lesson {{$loop->iteration}}:</b> {{$lesson->title}}</td>
                                                                <td><b>Content Type:</b> {{$lesson->content_type}}</td>
                                                                <td>
                                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                                    <li data-bs-toggle="tooltip" data-bs-placement="top">
                                                                        <form method="POST" action="{{ route('user.delete.lesson', Crypt::encrypt($lesson->id))}}">
                                                                            @csrf
                                                                            <button type="submit" title="Delete" class="btn btn-sm btn-soft-danger"><i class="bi bi-trash"></i></button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- email confirm modal -->
                                                <div class="modal fade" id="createLesson" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-bottom-0">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    Create Lesson
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="Edit-level">
                                                                        <form method="post" action="{{route('user.save.lesson', Crypt::encrypt($section->id))}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <input name="section_id" id="section_id" hidden>
                                                                                <div class="col-lg-12">
                                                                                    <label>Title</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" placeholder="Enter Title" name="lesson_title" class="input">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Description</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <textarea name="lesson_description" cols="30" rows="10" placeholder="Insert your description"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Duration (in seconds)</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="number" placeholder="Enter Duration" name="lesson_duration" class="input">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Content Type</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <select name="content_type" id="selectBox" onclick="changeFunc()" multiple>
                                                                                                <option value="Video">Video</option>
                                                                                                <!-- <option value="Quiz">Quiz</option> -->
                                                                                                <option value="Youtube">Youtube</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4" id="textboxcont">
                                                                                </div>
                                                                                <div class="row justify-content-between">
                                                                                    <div class="col-6">
                                                                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                            Cancel
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="col-6 text-end">
                                                                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                                                                            Create
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
                                                <!-- end modal -->
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                        <div class="card shadow-none border mb-0">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4"><strong>Course Landing Page</strong></h4>
                                                <div class="visual">
                                                    <p>
                                                        Your course landing page is crucial to your success on Ojafunnel. If it’s done right, it can also help you gain visibility in search engines like Google. As you complete this section, think about creating a compelling Course Landing Page that demonstrates why someone would want to enroll in your course.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-9">
                                                    <div class="Editt">
                                                        <form id="submit-button" name="submitbutton" method="post" action="{{route('user.save.course', Crypt::encrypt($course->id))}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form">
                                                            <div class="row">
                                                                <div class="col-lg-12 mb-4">
                                                                    <label for="Name">Course title</label>
                                                                    <input type="text" name="title" value="{{$course->title}}" placeholder="Course Title" />
                                                                </div>
                                                                <div class="col-lg-12 mb-4">
                                                                    <label for="Name">Course subtitle</label>
                                                                    <input type="text" name="subtitle" value="{{$course->subtitle}}" placeholder="Insert your course subtitle." />
                                                                </div>
                                                                <div class="col-lg-12 mb-4">
                                                                    <label for="Name">Course description</label>
                                                                    <textarea name="course_description" cols="30" rows="10" placeholder="Insert your Course Description">{{$course->description}}</textarea>
                                                                </div>
                                                                <div class="col-lg-4 mb-4">
                                                                    <label for="Name">Basic info</label>
                                                                    <select name="language">
                                                                        <option value="{{$course->language}}">{{$course->language}}</option>
                                                                        <option value="">-- Select Level --</option>
                                                                        <option value="English">English</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4 mb-4">
                                                                    <label for="Name">-- Select Level --</label>
                                                                    <select name="level">
                                                                        <option value="{{$course->level}}">{{$course->level}}</option>
                                                                        <option value="">-- Select Level --</option>
                                                                        <option value="beginner">Beginner Level</option>
                                                                        <option value="intermediate">Intermediate Level</option>
                                                                        <option value="advanced">Advanced Level</option>
                                                                        <option value="all">All Levels</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4 mb-4">
                                                                    <label for="Name">-- Select Category --</label>
                                                                    <select name="category">
                                                                        <option value="{{$course->category_id}}">{{\App\Models\Category::find($course->category_id)->name}}</option>
                                                                        <option value="">-- Select Category --</option>
                                                                        @foreach(\App\Models\Category::get() as $category)
                                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-2 mb-4">
                                                                    <label for="Name">Currency</label>
                                                                    <select name="currency">
                                                                        <option value="{{$course->currency}}">{{$course->currency}}</option>
                                                                        <option value="">-- Select Currency --</option>
                                                                        <option value="USD">USD</option>
                                                                        <option value="NGN">NGN</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-10 mb-4">
                                                                    <label for="Name">Pricing</label>
                                                                    <input type="number" name="price" value="{{$course->price}}" placeholder="Enter Price" />
                                                                </div>
                                                                <div class="col-lg-12 mb-4">
                                                                    <label for="Name">Course image</label>
                                                                    <input type="file" name="image" />
                                                                </div>
                                                                <div class="col-xl-12 float-end">
                                                                    <div class="card">
                                                                        <button type="submit" name="courseUpdate" value="Update" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                            Update
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-promotion" role="tabpanel" aria-labelledby="v-pills-promotion-tab">
                                        <div class="card shadow-none border mb-0">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4"><strong>Promotion</strong></h4>
                                                <div class="visual">
                                                    <p>
                                                        We have updated the coupon system, and there is more to come. Announcing new free coupon limits.
                                                    <div class="lamet float-end"><a href="" data-bs-toggle="modal" data-bs-target="#createCoupon"><strong><u>Create Coupon</u></strong></a></div>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <h4 class="card-title mb-3">Page</h4>
                                                <div class="table-responsive mt-2">
                                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">S/N</th>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">Code</th>
                                                                <th scope="col">Percent (%)</th>
                                                                <th scope="col">Quantity</th>
                                                                <th scope="col">Expires</th>
                                                                <!-- <th scope="col">Active</th> -->
                                                                <th scope="col">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach(\App\Models\Coupon::where('course_id', $course->id)->get() as $coupon)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$coupon->created_at->toDayDateTimeString()}}</td>
                                                                <td>{{$coupon->code}}</td>
                                                                <td>{{$coupon->percent}}%</td>
                                                                <td>{{$coupon->quantity}}</td>
                                                                <td>{{$coupon->expires}}</td>
                                                                <!-- <td>{{$coupon->active}}</td> -->
                                                                <td>
                                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Options
                                                                    </button>
                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit-{{$coupon->id}}">Edit</a></li>
                                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$coupon->id}}">Delete</a></li>
                                                                    </ul>
                                                                    <!-- Modal START -->
                                                                    <div class="modal fade" id="edit-{{$coupon->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                            <div class="modal-content pb-3">
                                                                                <div class="modal-header border-bottom-0">
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body ">
                                                                                    <div class="row">
                                                                                        <div class="Editt">
                                                                                            <form method="POST" action="{{ route('user.update.coupon', Crypt::encrypt($coupon->id))}}" enctype="multipart/form-data">
                                                                                                @csrf
                                                                                                <div class="form">
                                                                                                    <p>
                                                                                                        <b>
                                                                                                            Coupon Code: <code>{{$coupon->title}}</code>
                                                                                                        </b>
                                                                                                    </p>
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-12">
                                                                                                            <label>Code</label>
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12 mb-4">
                                                                                                                    <input type="text" placeholder="Enter Code" name="code" value="{{$coupon->code}}" class="input" required>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-lg-12">
                                                                                                            <label>Percent (%)</label>
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12 mb-4">
                                                                                                                    <input type="number" placeholder="Enter Percent" name="percent" value="{{$coupon->percent}}" class="input" required>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-lg-12">
                                                                                                            <label>Quantity</label>
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12 mb-4">
                                                                                                                    <input type="number" placeholder="Enter Quantity" name="quantity" value="{{$coupon->quantity}}" class="input" required>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-lg-12">
                                                                                                            <label>Expires</label>
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12 mb-4">
                                                                                                                    <input type="date" placeholder="Enter Expiring Date" name="expires" value="{{$coupon->expires}}" class="input" required>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-lg-12 mb-4">
                                                                                                            <div class="boding">
                                                                                                                <button type="submit">
                                                                                                                    Update
                                                                                                                </button>
                                                                                                            </div>
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
                                                                    <!-- end modal -->
                                                                    <!-- Modal START -->
                                                                    <div class="modal fade" id="delete-{{$coupon->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                            <div class="modal-content pb-3">
                                                                                <div class="modal-header border-bottom-0">
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body ">
                                                                                    <div class="row">
                                                                                        <div class="Editt">
                                                                                            <form method="POST" action="{{ route('user.delete.coupon', Crypt::encrypt($coupon->id))}}">
                                                                                                @csrf
                                                                                                <div class="form">
                                                                                                    <p><b>Delete Page</b></p>
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-12">
                                                                                                            <p>This action cannot be undone. This will permanently delete coupon code <code>{{$coupon->code}}</code></p>
                                                                                                            <label>Please type DELETE to confirm.</label>
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12 mb-4">
                                                                                                                    <input type="text" name="delete_field" class="input" required>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-lg-12 mb-4">
                                                                                                            <div class="boding">
                                                                                                                <button type="submit" class="form-btn">
                                                                                                                    I understand this consquences, Delete
                                                                                                                </button>
                                                                                                            </div>
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
                                                                    <!-- end modal -->
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- email confirm modal -->
<div class="modal fade" id="createCurriculum" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Section
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="post" action="{{route('user.save.curriculum', Crypt::encrypt($course->id))}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Title</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter Title" name="section_title" class="input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Objective</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="section_objective" cols="30" rows="10" placeholder="Insert your Objective"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Create
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
<!-- end modal -->

<!-- email confirm modal -->
<div class="modal fade" id="createCoupon" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Coupon
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="post" action="{{route('user.save.coupon', Crypt::encrypt($course->id))}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Code</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter Code" name="code" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Percent (%)</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="number" placeholder="Enter Percent" name="percent" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Quantity</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="number" placeholder="Enter Quantity" name="quantity" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Expires</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="date" placeholder="Enter Expiring Date" name="expires" class="input" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Create
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
<!-- end modal -->

<script>

    $(document).on('click','.open_modal',function(){
        var section_id= $(this).val();
        
        $('#title').text(section_id);
        $('#section_id').val(section_id);
        $('#createLesson').modal('show');
    });

    // $('select[name=content_type]').on('change', function() {
    //     if (this.value == 'Video') {
    //         $("#video").show();
    //         $("#youtube").hide();
    //     } else if(this.value == 'Youtube') {
    //         $("#youtube").show();
    //         $("#video").hide();
    //     } else {
    //         $("#video").hide();
    //         $("#youtube").hide();
    //     }
    // });

    function changeFunc() 
    {
        document.getElementById('textboxcont').innerHTML = '';
        var selectBox = document.getElementById("selectBox").value;
        var selectedValues = Array.from(document.getElementById('selectBox').selectedOptions).map(el => el.value);

        if (selectBox === 'Video') {
            for (var i = 0; selectedValues.length > i; ++i) {
                var i1 = document.createElement("label");
                var i2 = document.createElement("input");
                i1.innerHTML = "Video";
                i2.setAttribute("type", "file");
                i2.setAttribute("name", "lesson_video");
                // you may want to change this
                // add the file and text to the div
                document.getElementById('textboxcont').appendChild(i1);
                document.getElementById('textboxcont').appendChild(i2);
            }
        } else if (selectBox === 'Youtube') {
            for (var i = 0; selectedValues.length > i; ++i) {
                var i1 = document.createElement("label");
                var i2 = document.createElement("input");
                i1.innerHTML = "Youtube";
                i2.setAttribute("type", "text");
                i2.setAttribute("name", "lesson_youtube");
                // you may want to change this
                // add the file and text to the div
                document.getElementById('textboxcont').appendChild(i1);
                document.getElementById('textboxcont').appendChild(i2);
            }
        } else {
            alert('Coming Soon');
        }
    }
</script>

<!-- jquery step -->
<script type="text/javascript" src="{{URL::asset('dash/assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>

<!-- form wizard init -->
<script>
    function myFunct() {
        document.getElementById("appera").style.display = "none";
    }
</script>
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
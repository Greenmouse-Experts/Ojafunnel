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
                        <h4 class="mb-sm-0 font-size-18">New Course</h4>

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
                            <a class="nav-link" id="v-pills-confir-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab" aria-controls="v-pills-confir" aria-selected="false">
                                <i class="bx bx-badge-check d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Pricing</p>
                            </a>
                            <a class="nav-link" id="v-pills-promotion-tab" data-bs-toggle="pill" href="#v-pills-promotion" role="tab" aria-controls="v-pills-promotion" aria-selected="false">
                                <i class="bi bi-person-check d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Promotions</p>
                            </a>
                            <a class="nav-link" id="v-pills-send-tab" data-bs-toggle="pill" href="#v-pills-send" role="tab" aria-controls="v-pills-send" aria-selected="false">
                                <i class="bi bi-envelope-check d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Course messages</p>
                            </a>
                            <a class="nav-link" style="background-color: #70418F; color:#fff;  cursor: pointer;">
                                <p class="fw-bold mb-1 mt-2">Submit for Review</p>
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
                                                        <button type="button" style="float: right;" onclick="myFunct()" class="btn btn-danger mt-3">Dismiss</button>
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
                                            <div class="common">
                                                <div class="assets">
                                                    <h1><b id="inline-section" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Section 1:</b> <a href="javascript: void(0);" id="inline-username" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Introduction</a></h1>
                                                    <div class="actting">
                                                        <h1><b>Lecture 1:</b> <a href="javascript: void(0);" id="inline-firstname" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter ">Introduction</a></h1>
                                                        <div class="float-end tent">
                                                            <div class="btn-group">
                                                                <button class="btn dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <b>Content</b>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#">Video</a>
                                                                    <a class="dropdown-item" href="#">Audio</a>
                                                                    <a class="dropdown-item" href="#">Pdf</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="asseting">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <h1 class="mb-2"><b>Add Lecture:</b> <a href="javascript: void(0);" id="inline-intro" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Introduction</a></h1>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <h1 class="mb-2"><b>Add Quiz:</b> <a href="javascript: void(0);" id="inline-quiz" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Introduction</a></h1>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <h1 class="mb-2"><b>Add Assignment:</b> <a href="javascript: void(0);" id="inline-ass" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Introduction</a></h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form class="repeater" enctype="multipart/form-data">
                                                <div data-repeater-list="group-a">
                                                    <div data-repeater-item class="row">
                                                        <div class="common">
                                                            <div class="assets">
                                                                <h1><b id="inline-sectionn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Section 2:</b> <a href="javascript: void(0);" id="inline-usernamee" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Introduction</a></h1>
                                                                <div class="actting">
                                                                    <h1><b>Lecture 2:</b> <a href="javascript: void(0);" id="inline-firstnamee2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter ">Introduction</a></h1>
                                                                    <div class="float-end tent">
                                                                        <div class="btn-group">
                                                                            <button class="btn dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <b>Content</b>
                                                                            </button>
                                                                            <div class="dropdown-menu">
                                                                                <a class="dropdown-item" href="#">Video</a>
                                                                                <a class="dropdown-item" href="#">Audio</a>
                                                                                <a class="dropdown-item" href="#">Pdf</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="asseting">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <h1 class="mb-2"><b>Add Lecture:</b> <a href="javascript: void(0);" id="inline-introo" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Introduction</a></h1>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <h1 class="mb-2"><b>Add Quiz:</b> <a href="javascript: void(0);" id="inline-quizz" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Introduction</a></h1>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <h1 class="mb-2"><b>Add Assignment:</b> <a href="javascript: void(0);" id="inline-asss" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Introduction</a></h1>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-sm-10"></div>
                                                            <div class="col-lg-2 align-self-center">
                                                                <div class="d-grid">
                                                                    <input style="background-color: #70418F; color:#fff;" data-repeater-delete type="button" class="btn" value="Delete Section" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input style="background-color: #70418F; color:#fff;" data-repeater-create type="button" class="btn mt-lg-0" value="+ Add Section" />
                                                </div>
                                            </form>
                                        </div>
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
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-8">
                                                    <div class="Editt">
                                                        <form>
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Course title</label>
                                                                        <input type="text" name="name" placeholder="learn" required />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Course subtitle</label>
                                                                        <input type="text" name="name" placeholder="Insert your course subtitle." required />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Course description</label>
                                                                        <textarea name="description" id="" cols="30" rows="10" placeholder="Insert your course description" required></textarea>
                                                                    </div>
                                                                    <div class="col-lg-4 mb-4">
                                                                        <label for="Name">Basic info</label>
                                                                        <select>
                                                                            <option>English</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-4 mb-4">
                                                                        <label for="Name">-- Select Level --</label>
                                                                        <select>
                                                                            <option>Beginner Level</option>
                                                                            <option>Intermediate Level</option>
                                                                            <option>Expert Level</option>
                                                                            <option>All Levels</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-4 mb-4">
                                                                        <label for="Name">-- Select Category --</label>
                                                                        <select>
                                                                            <option>Finance & Accounting</option>
                                                                            <option>Development </option>
                                                                            <option>I don't know yet</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">What is primarily taught in your course?</label>
                                                                        <input type="text" name="name" placeholder="e.g. Landscape Photography" required />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Course image</label>
                                                                        <input type="file" name="quantity" required />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Promotional video</label>
                                                                        <input type="file" name="name" required />
                                                                    </div>
                                                                    <div class="text-end mt-2">
                                                                        <a href="#" class="text-decoration-none">
                                                                            <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                                Submit
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                                        <div class="card shadow-none border mb-0">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4"><strong>Pricing</strong></h4>
                                                <h4 class="card-title mb-2 mt-3">Ojafunnel Deals and List Price</h4>
                                                <div class="visual">
                                                    <p>
                                                        You are opted into the Ojafunnel Deals program.
                                                    </p>
                                                    <p>
                                                        Since you participate in the Ojafunnel Deals program, Ojafunnel optimizes your list price in most currencies and offers your course at a compelling discount via targeted promotions.
                                                    </p>
                                                    <p>
                                                        In markets where Ojafunnel doesn't currently display an optimized list price, we show a list price chosen by the instructor.
                                                    </p>
                                                </div>
                                                <h4 class="card-title mb-2 mt-3">Course Price Tier</h4>
                                                <div class="visual">
                                                    <p>
                                                        Please select the price tier for your course below and click 'Save'. In markets where Ojafunnel is not optimizing your list price, the list price that students will see in other currencies is determined using the price tier matrix.
                                                    </p>
                                                    <p class="mb-4">
                                                        If you intend to offer your course for free, the total length of video content must be less than 2 hours.
                                                    </p>
                                                </div>
                                                <div class="Editt">
                                                    <form>
                                                        <div class="form">
                                                            <div class="row">
                                                                <div class="col-lg-2 mb-4">
                                                                    <label for="Name">USD</label>
                                                                    <select required>
                                                                        <option>USD</option>
                                                                        <option>AUD</option>
                                                                        <Option>BRL</Option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-3 mb-4">
                                                                    <label for="Name">-- Select Level --</label>
                                                                    <select required>
                                                                        <option>Free</option>
                                                                        <option>Tier 1</option>
                                                                        <option>Tier 2</option>
                                                                        <option>Tier 3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-1 mb-4 mt-1">
                                                                    <a href="#" class="text-decoration-none">
                                                                        <button type="submit" class="btn px-4" style="color: #714091; border: 1px solid #714091">
                                                                            Save
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                <div class="text-end mt-2">
                                                                    <a href="#" class="text-decoration-none">
                                                                        <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                            Submit
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
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
                                                    <div class="lamet float-end"><a href=""><strong><u>Create Coupon</u></strong></a></div>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-8">
                                                    <div class="Editt">
                                                        <form>
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Coupons</label>
                                                                        <input type="text" name="name" placeholder="You cannot create coupons for a free course" readonly required />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Active/Scheduled coupons</label>
                                                                        <input type="text" name="name" placeholder="No coupon found" readonly required />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Expired coupons</label>
                                                                        <input type="text" name="name" placeholder="No coupon found" readonly required />
                                                                    </div>
                                                                    <div class="text-end mt-2">
                                                                        <a href="#" class="text-decoration-none">
                                                                            <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                                Submit
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-send" role="tabpanel" aria-labelledby="v-pills-send-tab">
                                        <div class="card shadow-none border mb-0">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4"><strong>Course messages</strong></h4>
                                                <div class="visual">
                                                    <p>
                                                        Write messages to your students (optional) that will be sent automatically when they join or complete your course to encourage students to engage with course content. If you do not wish to send a welcome or congratulations message, leave the text box blank.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-2"></div>
                                                    <div class="col-sm-8">
                                                        <div class="Editt">
                                                            <form>
                                                                <div class="form">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mb-4">
                                                                            <label for="Name">Welcome Message</label>
                                                                            <textarea name="description" id="" cols="30" rows="10" placeholder="Insert your welcome message" required></textarea>
                                                                        </div>
                                                                        <div class="col-lg-12 mb-4">
                                                                            <label for="Name">Congratulations Message</label>
                                                                            <textarea name="description" id="" cols="30" rows="10" placeholder="Insert your congratulation message" required></textarea>
                                                                        </div>
                                                                        <div class="text-end mt-2">
                                                                            <a href="#" class="text-decoration-none">
                                                                                <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                                    Submit
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2"></div>
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

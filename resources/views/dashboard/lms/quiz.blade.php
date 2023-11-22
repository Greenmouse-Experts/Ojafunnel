<head>
    <meta charset="utf-8" />
    <title>Oja Funnel | Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="title" name="Oja Funnel | shopFront" />
    <meta content="description" name=" | Oja Funnel | Shop" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.webui-popover.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- Font Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- style Css -->
     <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel='stylesheet' href="{{ asset('assets/css/sweetalert2.min.css') }}">
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>


</head>
<body>
    <input type="hidden" value="{{ csrf_token() }}" id="txt_token">
    <input type="hidden" value="{{ url('/') }}/" id="site_url">

<section class="menu-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <ul class="mobile-header-buttons">

                            <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
                        </ul>
                        <a class="navbar-brand" href="{{route('user.dashboard', Auth::user()->username)}}">
                            Quiz
                        </a>
                        <form class="inline-form" style="width: 80%;">
                            <div class="input-group search-box mobile-search">
                                <input type="text" name='search_string' class="form-control" placeholder="Search for courses">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="cart-box menu-icon-box" id="cart_items">
                        </div>
                        <div class="user-box menu-icon-box">
                            <div class="icon">
                                <a href="">
                                    <img src="{{ asset('dash/assets/images/users/avatar-1.jpg') }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</body>
    <!-- container-fluid -->
    <div class="container">
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
                                                    <div class="font-size-14">{{ $lms->session }}</div>
                                                </td>
                                                <td class="font-size-14">
                                                    {{ $lms->course_title }}
                                                </td>
                                                <td class="font-size-14">
                                                    <div>{{ $lms->students }} students wrote the test</div>
                                                    <div class="mt-2"><a href="{{ $quiz_id }}/view-scores/{{ $lms->session }}/" style="font-size:13px">view Students scores</a></div>
                                                </td>
                                                <td class="font-size-14">
                                                    {{ $lms->created_at }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('create-quiz1', ['id' => $quiz_id, 'session' => 'enter-quiz-'.$lms->session, 'username' => Auth::user()->username]) }}" title="View Quiz" class="action-icon text-primary mr-2"> <i class="fa fa-eye font-size-18"></i></a>

                                                    <a href="javascript:;" title="Delete" class="action-icon text-danger deteleQuizSession" ids="{{ $lms->id }}"> <i class="fa fa-trash font-size-18"></i></a>
                                                </td>
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

<!-- Bootrstrap touchspin -->
<script src="{{URL::asset('dash/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{URL::asset('dash/assets/js/pages/ecommerce-cart.init.js')}}"></script>

<script src="{{URL::asset('admin/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/jscripts.js') }}"></script>

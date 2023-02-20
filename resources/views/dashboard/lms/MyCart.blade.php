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
</head>
<body>
<section class="menu-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <ul class="mobile-header-buttons">

                            <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
                        </ul>
                        <a class="navbar-brand" href="{{route('user.dashboard', Auth::user()->username)}}">
                            Ojafunnel Shop
                        </a>
                        <form class="inline-form mt-3" style="width: 80%;">
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
                    <h4 class="mb-sm-0 font-size-18">Shopping Cart</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                            <li class="breadcrumb-item active">Shopping Cart</li>
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
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Images</th>
                                        <th scope="col">Product Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">Html Full Course</a></h5>
                                        </td>
                                        <td>
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548204/OjaFunnel-Images/html_yhwt1x.jpg" alt="product-img" title="product-img" class="avatar-md" />
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Iste, perferendis?</a></h5>
                                        </td>

                                        <td>
                                            ₦ 500
                                        </td>
                                        <td>
                                            <a href="#CartDelete" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">Laravel Full Course</a></h5>
                                        </td>
                                        <td>
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548205/OjaFunnel-Images/laravel_iupjh0.png" alt="product-img" title="product-img" class="avatar-md" />
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Iste, perferendis?</a></h5>
                                        </td>
                                        <td>
                                            ₦ 1000
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-8">
                                <a href="{{route('user.shop.course', Auth::user()->username)}}" class="text-muted d-none d-sm-inline-block btn-link ">
                                    <i class="mdi mdi-arrow-left me-1"></i> Back to Shop </a>
                            </div> <!-- end col -->
                            <div class="col-sm-4">
                                <div class="text-end">
                                    <a href="{{route('user.checkout', Auth::user()->username)}}" style="background: #713f93; padding:10px; border-radius: 3px; color:#fff;" class="">
                                        <i class="mdi mdi-truck-fast me-1"></i> Proceed to Checkout </a>
                                </div>
                            </div> <!-- end col -->
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

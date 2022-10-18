@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row card begin">
                <div class="col-12 account-head">
                    <div class="py-3">
                        <h4 class="font-60">Create Store</h4>
                        <p>Create a store for your digital/physical product sales</p>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <div class="container">
                <div class="commerce-con">
                    <form action="">
                        <!-- store name -->
                        <div class="mb-5 mt-2">
                            <div class="account-input-div">
                                <input type="text" class="rounded" placeholder="Enter your shop name" required />
                                <div class="label-text fs-6">Store</div>
                            </div>
                        </div>
                        <!-- store description -->
                        <div class="mt-5 mb-3">
                            <div class="account-input-div">
                                <textarea type="text" style="height: 100px" class="rounded w-100 p-2 py-3" placeholder="Enter your shop description" required></textarea>
                                <div class="label-text fs-6">Store Description</div>
                            </div>
                        </div>
                        <!-- store name -->
                        <div class="mt-3">
                            <label for="Name" class="fs-5 mt-3">Store Name</label>
                            <div class="d-flex border-in align-items-center">
                                <div class="w-50 d-flex ps-3 pt-2" style="color: #714091; background: #efd7ff">
                                    <p class="mb-2">https://chuka.ojafunnel.cc/store</p>
                                </div>
                            </div>
                        </div>
                        <!-- store theme -->
                        <div class="mt-5">
                            <label for="theme" class="fs-5"> Store Theme </label>
                            <div class="row mt-2 justify-content-between">
                                <div class="col-lg-6 theme-select">
                                    <input type="radio" name="color" id="blue" />
                                    <input type="radio" name="color" id="purple" />
                                    <input type="radio" name="color" id="green" />
                                    <input type="radio" name="color" id="pink" />
                                    <input type="radio" name="color" id="brown" />
                                    <input type="radio" name="color" id="navy" />
                                </div>
                                <div class="col-lg-4 text-end">
                                    <a href="#" style="color: #714091">Choose another color</a>
                                </div>
                            </div>
                        </div>
                        <!-- store logo -->
                        <div class="mt-5">
                            <label for="logo" class="fs-5 mb-3"> Store Logo </label>
                            <div class="logo-input border-in w-full px-5 py-4 pb-5">
                                <p>upload your store logo</p>
                                <div class="logo-input2 border-in py-5 px-3">
                                    <div class="avatar-logo"></div>
                                    <div class="logo-file">
                                        <input type="file" accept="image" name="logo" id="" class="mt-4 w-100" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- buttons -->
                        <div class="row justify-content-between mt-5">
                            <div class="col-6">
                                <a href="#" class="text-decoration-none">
                                    <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                        Cancel
                                    </button></a>
                            </div>
                            <div class="col-6 text-end">
                                <a href="ecommerce2.html" class="text-decoration-none">
                                    <button class="btn px-4" style="color: #ffffff; background-color: #714091" data-bs-toggle="modal" data-bs-target="#onlineStore">
                                        Create Shop
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
</div>

<!-- SuccessModal -->
<div class="modal fade" id="onlineStore" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="icon-success">
                    <img src="{{URL::asset('dash/assets/image/theme.png')}}" alt="" width="100%" />
                </div>
                <div class="text-center mt-5">
                    <p>Congratulations, you've created your online store</p>
                </div>
                <div class="text-end mt-2">
                    <a href="{{route('user.check.store')}}" class="text-decoration-none">
                        <button class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                            Next
                        </button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<!-- END layout-wrapper -->
@endsection
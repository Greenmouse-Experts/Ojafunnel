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
            <div class="row begin">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">Create Course</h4>
                            <p>
                                Create courses to publish on your store
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 account-head">
                                <div class="campaign-nav mt-3">
                                    <ul class="list-unstyled">
                                        <li class="px-3 py-2 text-white bg-purp">Course Details >></li>
                                        </li>
                                        </li>
                                        <li>
                                            <a href="{{route('user.course.content')}}" class="text-decoration-none text-dark">Course Content >></a>
                                        </li>
                                        <li>
                                            <a href="" class="text-decoration-none text-dark">Summary >></a>
                                        </li>
                                        <li>
                                            <a href="" class="text-decoration-none text-dark">Publish >></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">

                </div>
            </div>
            <div class="row cut">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b>
                                        Tell us about your course
                                    </b>
                                </p>
                                <div class="col-lg-12">
                                    <label>Course Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter your course name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Course Description </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="" id="" placeholder="Enter your course name" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label> Course Image</label>
                                    <div class="mt-2 mb-4">
                                        <div class="logo-input border-inn w-full px-5 py-4 pb-5">
                                            <div class="logo-input2 border-in py-5 px-3">
                                                <div class="avatar">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                                </div>
                                                <div class="logo-file">
                                                    <input type="file" accept="image" name="logo" id="" class="mt-4 w-100" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="boding">
                                                <button class="btn px-3" style="color: #714091; border:1px solid #714091; background:#fff;">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="boding">
                                                <button>
                                                    <a href="CourseContent.html" style="color: #fff;">
                                                        Proceed
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->

    <!-- Transaction Modal -->
    <div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaction-detailModalLabel">
                        Order Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">
                        Product id: <span class="text-primary">#SK2540</span>
                    </p>
                    <p class="mb-4">
                        Billing Name: <span class="text-primary">Neal Matthews</span>
                    </p>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <div>
                                            <img src="assets/images/product/img-7.png" alt="" class="avatar-sm" />
                                        </div>
                                    </th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14">
                                                Wireless Headphone (Black)
                                            </h5>
                                            <p class="text-muted mb-0">$ 225 x 1</p>
                                        </div>
                                    </td>
                                    <td>$ 255</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div>
                                            <img src="assets/images/product/img-4.png" alt="" class="avatar-sm" />
                                        </div>
                                    </th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14">
                                                Phone patterned cases
                                            </h5>
                                            <p class="text-muted mb-0">$ 145 x 1</p>
                                        </div>
                                    </td>
                                    <td>$ 145</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Sub Total:</h6>
                                    </td>
                                    <td>$ 400</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Shipping:</h6>
                                    </td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Total:</h6>
                                    </td>
                                    <td>$ 400</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
</div>
<!-- END layout-wrapper -->
@endsection
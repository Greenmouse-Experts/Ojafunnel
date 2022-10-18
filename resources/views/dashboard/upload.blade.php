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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card account-head">
                                <div class="py-2">
                                    <h4 class="font-500">Add Contact ; <span style="color: #2E59F3;"> Student List</span></h4>
                                    <p>
                                        Add emails & phone numbers to your created mailing list
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="sms">
                                <ul>
                                    <li class="text-purp">
                                        <a href="#">
                                            Upload Files
                                        </a>
                                    </li>
                                    <li class="text-purpp">
                                        <a href="{{route('user.copy.paste')}}">
                                            Copy & Paste
                                        </a>
                                    </li>
                                    <li class="text-purpp">
                                        <a href="{{route('user.add.contact')}}">
                                            Add Individualy
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row cut">
                        <div class="col-lg-2">
                        </div>
                        <div class="col-lg-8">
                            <div class="Edittt">
                                <div class="mt-5">
                                    <div class="logo-input border-in w-full px-5 py-4 pb-5">
                                        <p>
                                            <b>
                                                Upload a file containing your contact
                                            </b>
                                        </p>
                                        <div class="logo-input2 border-in py-5 px-3">
                                                <div class="avatar">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                                </div>
                                            <div class="logo-file">
                                                <input type="file" accept="image" name="logo" id=""
                                                    class="mt-4 w-100" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 py-3">
                                    <div class="name">
                                        <ul>
                                            <li>
                                                Email Verification :
                                            </li>
                                            <li>
                                                <input type="checkbox" > 
                                            </li>
                                            <li>
                                                Verify uploaded addresses
                                            </li>
                                        </ul>
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
                                        <a href="Add-contact.html" class="text-decoration-none">
                                            <button class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                >
                                                Proceed
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Page-content -->

                <!-- Transaction Modal -->
                <div class="modal fade transaction-detailModal" tabindex="-1" role="dialog"
                    aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="transaction-detailModalLabel">
                                    Order Details
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
                                                        <img src="assets/images/product/img-7.png" alt=""
                                                            class="avatar-sm" />
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
                                                        <img src="assets/images/product/img-4.png" alt=""
                                                            class="avatar-sm" />
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
            <!-- end main content-->
        </div>
<!-- END layout-wrapper -->
@endsection
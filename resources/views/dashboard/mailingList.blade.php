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
                <div class="col-lg-8">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Mailing List </h4>
                            <p>
                                Create, view, edit and do many more with your contact list
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card account-head">
                        <div class="all-create py-2">
                            <button data-bs-toggle="modal" data-bs-target="#emailConfirm">+ Create Mailing List </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Mailing List(s)</h4>
                            <p class="card-title-desc">

                            </p>

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Mailing List Name </th>
                                            <th>Date Created</th>
                                            <th>No of Contacts </th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="Add-contact.html">Add Contact</a></li>
                                                        <li><a class="dropdown-item" href="#">Enable</a></li>
                                                        <li><a class="dropdown-item" href="#">Disable</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>Edit</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>Edit</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>Edit</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>Edit</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
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
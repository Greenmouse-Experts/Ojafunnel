@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card begin account-head mb-4">
                        <div class="row">
                            <div class="col-md-2">
                                <ul class="list-unstyled mt-3">
                                    <li>
                                        <a href="{{route('user.course.content')}}">
                                            << Previous </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-7"></div>
                            <div class="col-md-3">
                                <div class="save mt-2 mb-4">
                                    <button>
                                        <a href="">
                                            Save and Continue
                                        </a>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="campaign-nav mt-1">
                                        <ul class="list-unstyled">
                                            <li class="px-3 py-2 text-white bg-purp">Course Details >></li>
                                            </li>
                                            </li>
                                            <li class="px-3 py-2 text-white bg-purp">
                                                <a href="#" class="text-decoration-none text-white">Course Content
                                                    >>
                                                </a>
                                            </li>
                                            <li class="px-3 py-2">
                                                <a href="{{route('user.course.summary')}}" class="text-decoration-none text-dark">Summary >></a>
                                            </li>
                                            <li class="px-3 py-2">
                                                <a href="#" class="text-decoration-none text-dark">Publish >></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <h4 class="font-600">Set Quiz</h4>
                            <p>
                                Set your quiz questions and answers here
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="course">
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Quiz Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter your quiz name" name="email" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="course">
                            <div class="color">
                                <p>
                                    <b>
                                        Question 1
                                    </b>
                                </p>
                            </div>
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Question 1</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <!-- <input type="text" placeholder="Enter your quiz name" name="email" class="input" required> -->
                                                <textarea placeholder="Type in your question" required name="" id="" cols="30" rows="5">
                                                        </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="color-child">
                                                <ul>
                                                    <li>
                                                        <b class="mb-2">
                                                            Option A
                                                        </b>
                                                    </li>
                                                    <li>
                                                        <div class="col-md-12">
                                                            <input type="text" placeholder="Type in your option A" name="email" class="input" required>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dropdown">
                                                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Option
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item" href="Add-contact.html">Edit</a></li>
                                                                <li><a class="dropdown-item" href="#">Enable</a></li>
                                                                <li><a class="dropdown-item" href="#">Disable</a></li>
                                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="color-child mb-3">
                                                <ul>
                                                    <li>
                                                        <b class="mb-2">
                                                            Option B
                                                        </b>
                                                    </li>
                                                    <li>
                                                        <div class="col-md-12">
                                                            <input type="text" placeholder="Type in your option B" name="email" class="input" required>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dropdown">
                                                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Option
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item" href="Add-contact.html">Add Contact</a></li>
                                                                <li><a class="dropdown-item" href="#">Enable</a></li>
                                                                <li><a class="dropdown-item" href="#">Disable</a></li>
                                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="color-child">
                                                <ul>
                                                    <li>
                                                        <a href="AddNewOption.html">
                                                            + Add New Option
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="course">
                            <div class="color">
                                <p>
                                    <b>
                                        Question 2
                                    </b>
                                </p>
                                <button>
                                    <a href="AddNewOption.html" style="text-decoration:none;">
                                        Add Question
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between mt-5">
                        <div class="col-6">
                            <a href="#" class="text-decoration-none">
                                <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                    Cancel
                                </button></a>
                        </div>
                        <div class="col-6 text-end">
                            <a href="#" class="text-decoration-none">
                                <button class="btn px-4" style="color: #ffffff; background-color: #714091">
                                    Set Quiz
                                </button>
                            </a>
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


@endsection
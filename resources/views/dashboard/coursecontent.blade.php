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
                            <div class="py-2">
                                <h4 class="font-600">Set up your Curriculum</h4>
                                <p>
                                    Here’s where you add course content—like lectures, course sections, etc
                                </p>
                            </div>
                            <div class="col-md-2">
                                <ul class="list-unstyled mt-3">
                                    <li>
                                        <a href="{{route('user.create.course')}}">
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
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="campaign-nav mt-1">
                                    <ul class="list-unstyled">
                                        <li class="px-3 py-2 text-white bg-purp">Course Details >></li>
                                        </li>
                                        </li>
                                        <li class="px-3 py-2 text-white bg-purp">
                                            <a href="{{route('user.course.content')}}" class="text-decoration-none text-white">Course Content >></a>
                                        </li>
                                        <li class="px-3 py-2">
                                            <a href="#" class="text-decoration-none text-dark">Summary >></a>
                                        </li>
                                        <li class="px-3 py-2">
                                            <a href="#" class="text-decoration-none text-dark">Publish >></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <div class="curriculom">
                        <p>
                            <b>
                                Your Curriculum
                            </b>
                        </p>
                        <div class="write">
                            <p>
                                <b>
                                    Chapter 1 : Introduction
                                </b>
                            </p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Course Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <!-- <input type="text" placeholder="Enter your course name" name="name"
                                                        class="input" required> -->
                                            <select>
                                                <option>
                                                    Week 1 : Scheme of work
                                                </option>
                                                <option> Week 2 : Principle of School </option>
                                            </select>
                                            <button data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                + Add Content
                                            </button>
                                            <div class="add">
                                                <ul>
                                                    <li class="text-purpp">
                                                        <a href="">
                                                            Add Lecture
                                                        </a>
                                                    </li>
                                                    <li class="text-purpp">
                                                        <a href="{{route('user.get.quiz')}}">
                                                            Add Quiz
                                                        </a>
                                                    </li>
                                                    <li class="text-purpp">
                                                        <a href="">
                                                            Add Assignment
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="write">
                            <p>
                                <b>
                                    Chapter 2 : Literature review
                                </b>
                            </p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Course Title</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <!-- <input type="text" placeholder="Enter your course name" name="name"
                                                        class="input" required> -->
                                            <select>
                                                <option>
                                                    Week 1 : Scheme of work
                                                </option>
                                                <option> Week 2 : Principle of School </option>
                                            </select>
                                            <button data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                + Add Content
                                            </button>
                                            <div class="add">
                                                <ul>
                                                    <li class="text-purpp">
                                                        <a href="">
                                                            Add Lecture
                                                        </a>
                                                    </li>
                                                    <li class="text-purpp">
                                                        <a href="{{route('user.get.quiz')}}">
                                                            Add Quiz
                                                        </a>
                                                    </li>
                                                    <li class="text-purpp">
                                                        <a href="">
                                                            Add Assignment
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

<!-- email confirm modal -->
<div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Add Content
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="whitee">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                                <p>
                                    <b>
                                        Video
                                    </b>
                                </p>
                                <div class="and">
                                    Upload and display your video content
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="white">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                            <p>
                                <b>
                                    Audio
                                </b>
                            </p>
                            <div class="and">
                                Prefect learning for students who are on go
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="white">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                            <p>
                                <b>
                                    Text
                                </b>
                            </p>
                            <div class="and">
                                Include bodies of text, images or external links
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="white">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                            <p>
                                <b>
                                    PDF File
                                </b>
                            </p>
                            <div class="and">
                                Easily upload pdf content for your students
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="white">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                            <p>
                                <b>
                                    Downloable File
                                </b>
                            </p>
                            <div class="and">
                                Distribute materials to your students
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="white">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                            <p>
                                <b>
                                    Presentation
                                </b>
                            </p>
                            <div class="and">
                                Display slides with audio for your students
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<!-- email confirm modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content px-4 py-2">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel1">
                    Add Video
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- <div class="col-lg-2 col-md-2"></div> -->
                    <div class="col-lg-12 col-md-12">
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Title</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter your course name" name="email" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="logo-input border-in w-full px-5 py-4 pb-5">
                                            <p>
                                                <b>
                                                    Upload your video
                                                </b>
                                            </p>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="boding">
                            <button>
                                Add Content
                            </button>
                        </div>
                    </div>
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
@endsection
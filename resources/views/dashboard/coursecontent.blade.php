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
                        <h4 class="mb-sm-0 font-size-18">Curriculum</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Curriculum</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
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
                                        <a href="{{route('user.create.course', Auth::user()->username)}}">
                                            << Previous </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-7"></div>
                            <div class="col-md-3">
                                <div class="save mt-2 mb-4">
                                    <button>
                                        <a href="#">
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
                                            <a href="{{route('user.course.content', Auth::user()->username)}}" class="text-decoration-none text-white">Course Content >></a>
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
                                            <button data-bs-toggle="modal" data-bs-target="#AddContent">
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
                                                        <a href="{{route('user.get.quiz', Auth::user()->username)}})}}">
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
                                            <button data-bs-toggle="modal" data-bs-target="#AddContent">
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
                                                        <a href="{{route('user.get.quiz', Auth::user()->username)}})}}">
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
</div>
<!-- AddContent modal -->
    <!-- <div class="modal fade" id="AddContent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content px-4 py-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel1">
                        Kindly Add Content Below
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
                                        <label>Content Description</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea name="" id="" cols="30" rows="5" placeholder="Start typing"></textarea>
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
    </div> -->
<!-- end modal -->

<!-- email confirm modal -->
    <!-- <div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
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
    </div> -->
<!-- end modal -->
<!-- email confirm modal -->
<div class="modal fade" id="AddContent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content px-4 py-2">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel1">
                    Kindly Add Content
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
                                            <textarea name="" id="" cols="30" rows="10"  placeholder="Start Typing" required></textarea>
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
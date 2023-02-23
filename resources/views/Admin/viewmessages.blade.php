@extends('layouts.admin-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">View Messagest</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminwelcome')}}">Home</a></li>
                                <li class="breadcrumb-item active">View Mailing list</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">View Messages</h4>
                            <p>
                                Connect the tools that power your business
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Right Sidebar -->
                    <div>

                        <div class="card">
                            <div class="btn-toolbar p-3" role="toolbar">
                                <div class="btn-group me-2 mb-2 mb-sm-0">
                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </div>
                            <ul class="message-list">
                                <li>
                                    <div class="col-mail col-mail-1">
                                        <div class="checkbox-wrapper-mail">
                                            <input type="checkbox" id="chk19">
                                            <label for="chk19" class="toggle"></label>
                                        </div>
                                        <a href="javascript: void(0);" class="title">Hamzat, me (3)</a><span class="star-toggle far fa-star"></span>
                                    </div>
                                    <div class="col-mail col-mail-2">
                                        <a href="javascript: void(0);" class="subject">Hello – <span class="teaser">Trip home from Colombo has been arranged, then Jenna will come get me from Stockholm. :)</span>
                                        </a>
                                        <div class="date">Dec 9</div>
                                    </div>
                                </li>

                                <li>
                                    <div class="col-mail col-mail-1">
                                        <div class="checkbox-wrapper-mail">
                                            <input type="checkbox" id="chk20">
                                            <label for="chk20" class="toggle"></label>
                                        </div>
                                        <a href="javascript: void(0);" class="title">me, Afo (7)</a><span class="star-toggle far fa-star"></span>
                                    </div>
                                    <div class="col-mail col-mail-2">
                                        <a href="javascript: void(0);" class="subject"><span class="bg-warning badge me-2">Freelance</span>Since you asked... and i'm
                                            inconceivably bored at the train station –
                                            <span class="teaser">Alright thanks. I'll have to re-book that somehow, i'll get back to you.</span>
                                        </a>
                                        <div class="date">Dec 8</div>
                                    </div>
                                </li>

                                <li>
                                    <div class="col-mail col-mail-1">
                                        <div class="checkbox-wrapper-mail">
                                            <input type="checkbox" id="chk6">
                                            <label for="chk6" class="toggle"></label>
                                        </div>
                                        <a href="javascript: void(0);" class="title">Web Support Promise</a><span class="star-toggle far fa-star"></span>
                                    </div>
                                    <div class="col-mail col-mail-2">
                                        <a href="javascript: void(0);" class="subject">Re: New mail settings –
                                            <span class="teaser">Will you answer him asap?</span>
                                        </a>
                                        <div class="date">Dec 8</div>
                                    </div>
                                </li>
                            </ul>

                        </div><!-- card -->

                        <div class="row">
                            <div class="col-7">
                                Showing 1 - 20 of 50
                            </div>
                            <div class="col-5">
                                <div class="btn-group float-end">
                                    <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end Col-9 -->

                </div>

            </div>
           </div>
        </div>
    </div>
    @endsection

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
                    <div class="card begin account-head mb-4">
                        <div class="">
                            <h4 class="font-600">WhatsApp Automation</h4>
                            <p>
                                Send instant, scheduled or automated messages to your contact
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-tabs-custom">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.whatsapp.automation', Auth::user()->username)}}">New Campaign</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Recieved Messages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Sent Campaigns</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Auto Reply</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.sent.campaigns', Auth::user()->username)}}">View Broadcast </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Right Sidebar -->
                                    <div class="card">
                                        <!-- <div class="btn-toolbar p-3" role="toolbar">
                                            <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-priJany waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                                                <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                                <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
                                            </div>
                                            <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-primary waves-light waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Updates</a>
                                                    <a class="dropdown-item" href="#">Social</a>
                                                    <a class="dropdown-item" href="#">Team Manage</a>
                                                </div>
                                            </div>
                                            <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-primary waves-light waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Updates</a>
                                                    <a class="dropdown-item" href="#">Social</a>
                                                    <a class="dropdown-item" href="#">Team Manage</a>
                                                </div>
                                            </div>

                                            <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-primary waves-light waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                                    More <i class="mdi mdi-dots-vertical ms-2"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Mark as Unread</a>
                                                    <a class="dropdown-item" href="#">Mark as Important</a>
                                                    <a class="dropdown-item" href="#">Add to Tasks</a>
                                                    <a class="dropdown-item" href="#">Add Star</a>
                                                    <a class="dropdown-item" href="#">Mute</a>
                                                </div>
                                            </div>
                                        </div> -->
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
                                                    <div class="date">Jan 6</div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="col-mail col-mail-1">
                                                    <div class="checkbox-wrapper-mail">
                                                        <input type="checkbox" id="chk20">
                                                        <label for="chk20" class="toggle"></label>
                                                    </div>
                                                    <a href="javascript: void(0);" class="title">me, Susanna (7)</a><span class="star-toggle far fa-star"></span>
                                                </div>
                                                <div class="col-mail col-mail-2">
                                                    <a href="javascript: void(0);" class="subject"><span class="bg-warning badge me-2">Freelance</span>Since you asked... and i'm
                                                        inconceivably bored at the train station –
                                                        <span class="teaser">Alright thanks. I'll have to re-book that somehow, i'll get back to you.</span>
                                                    </a>
                                                    <div class="date">Jan. 6</div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="col-mail col-mail-1">
                                                    <div class="checkbox-wrapper-mail">
                                                        <input type="checkbox" id="chk6">
                                                        <label for="chk6" class="toggle"></label>
                                                    </div>
                                                    <a href="javascript: void(0);" class="title">Web Support Dennis</a><span class="star-toggle far fa-star"></span>
                                                </div>
                                                <div class="col-mail col-mail-2">
                                                    <a href="javascript: void(0);" class="subject">Re: New mail settings –
                                                        <span class="teaser">Will you answer him asap?</span>
                                                    </a>
                                                    <div class="date">Jan 7</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-mail col-mail-1">
                                                    <div class="checkbox-wrapper-mail">
                                                        <input type="checkbox" id="chk7">
                                                        <label for="chk7" class="toggle"></label>
                                                    </div>
                                                    <a href="javascript: void(0);" class="title">me, Peter (2)</a><span class="star-toggle far fa-star"></span>
                                                </div>
                                                <div class="col-mail col-mail-2">
                                                    <a href="javascript: void(0);" class="subject"><span class="bg-info badge me-2">Support</span>Off on Thursday -
                                                        <span class="teaser">Eff that place, you might as well stay here with us instead! Sent from my iPhone 4 4 Jan 2014 at 5:55 pm</span>
                                                    </a>
                                                    <div class="date">Jan 4</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-mail col-mail-1">
                                                    <div class="checkbox-wrapper-mail">
                                                        <input type="checkbox" id="chk8">
                                                        <label for="chk8" class="toggle"></label>
                                                    </div>
                                                    <a href="javascript: void(0);" class="title">Medium</a><span class="star-toggle far fa-star"></span>
                                                </div>
                                                <div class="col-mail col-mail-2">
                                                    <a href="javascript: void(0);" class="subject"><span class="bg-priJany badge me-2">Social</span>This Week's Top Stories –
                                                        <span class="teaser">Our top pick for you on Medium this week The Man Who Destroyed America’s Ego</span>
                                                    </a>
                                                    <div class="date">Feb 28</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-mail col-mail-1">
                                                    <div class="checkbox-wrapper-mail">
                                                        <input type="checkbox" id="chk9">
                                                        <label for="chk9" class="toggle"></label>
                                                    </div>
                                                    <a href="javascript: void(0);" class="title">Death to Stock</a><span class="star-toggle far fa-star"></span>
                                                </div>
                                                <div class="col-mail col-mail-2">
                                                    <a href="javascript: void(0);" class="subject">Montly High-Res Photos –
                                                        <span class="teaser">To create this month's pack, we hosted a party with local musician Jared Mahone here in Columbus, Ohio.</span>
                                                    </a>
                                                    <div class="date">Feb 28</div>
                                                </div>
                                            </li>

                                            <li class="unread">
                                                <div class="col-mail col-mail-1">
                                                    <div class="checkbox-wrapper-mail">
                                                        <input type="checkbox" id="chk3">
                                                        <label for="chk3" class="toggle"></label>
                                                    </div>
                                                    <a href="javascript: void(0);" class="title">Randy, me (5)</a><span class="star-toggle far fa-star"></span>
                                                </div>
                                                <div class="col-mail col-mail-2">
                                                    <a href="javascript: void(0);" class="subject"><span class="bg-success badge me-2">Family</span>Last pic over my village –
                                                        <span class="teaser">Yeah i'd like that! Do you remember the video you showed me of your train ride between Colombo and Kandy? The one with the mountain view? I would love to see that one again!</span>
                                                    </a>
                                                    <div class="date">5:01 am</div>
                                                </div>
                                            </li>
                                        </ul>

                                    </div><!-- card -->

                                    <div class="row">
                                        <div class="col-7">
                                            Showing 1 - 20 of 1,524
                                        </div>
                                        <div class="col-5">
                                            <div class="btn-group float-end">
                                                <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END layout-wrapper -->
    @endsection
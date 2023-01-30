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
                                        <a class="nav-link" href="#">Recieved Messages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.sent.campaigns', Auth::user()->username)}}">Sent Campaigns</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Auto Reply</a>
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
                                <div class="d-lg-flex">
                                    <div class="chat-leftsidebar me-lg-4">
                                        <div class="">
                                            <div class="py-4 border-bottom">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 align-self-center me-3">
                                                        <img src="{{URL::asset('dash/assets/images/users/avatar-3.jpg')}}" class="avatar-xs rounded-circle" alt="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-15 mb-1">Hamzat </h5>
                                                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat-leftsidebar-nav">
                                                <div class="tab-content py-4">
                                                    <div class="tab-pane show active" id="chat">
                                                        <div>
                                                            <h5 class="font-size-14 mb-3">Recent</h5>
                                                            <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                                                <li class="active">
                                                                    <a href="javascript: void(0);">
                                                                        <div class="d-flex">
                                                                            <div class="flex-shrink-0 align-self-center me-3">
                                                                                <i class="mdi mdi-circle font-size-10"></i>
                                                                            </div>
                                                                            <div class="flex-shrink-0 align-self-center me-3">
                                                                                <img src="{{URL::asset('dash/assets/images/users/avatar-2.jpg')}}" class="rounded-circle avatar-xs" alt="">
                                                                            </div>

                                                                            <div class="flex-grow-1 overflow-hidden">
                                                                                <h5 class="text-truncate font-size-14 mb-1">Promise Ezema</h5>
                                                                                <p class="text-truncate mb-0">Hey! there I'm available</p>
                                                                            </div>
                                                                            <div class="font-size-11">05 min</div>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            
                                        </div>
                                    </div>
                                    <div class="w-100 user-chat">
                                        <div class="card">
                                            <div class="p-4 border-bottom ">
                                                <div class="row">
                                                    <div class="col-md-4 col-9">
                                                        <h5 class="font-size-15 mb-1">Promise Ezema</h5>
                                                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                                                    </div>
                                                    <div class="col-md-8 col-3">
                                                        <ul class="list-inline user-chat-nav text-end mb-0">
                                                            <li class="list-inline-item d-none d-sm-inline-block">
                                                                <div class="dropdown">
                                                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="bx bx-search-alt-2"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                                                        <form class="p-3">
                                                                            <div class="form-group m-0">
                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">

                                                                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>

                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="list-inline-item  d-none d-sm-inline-block">
                                                                <div class="dropdown">
                                                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="bx bx-cog"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">View Profile</a>
                                                                        <a class="dropdown-item" href="#">Clear chat</a>
                                                                        <a class="dropdown-item" href="#">Muted</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <div class="dropdown">
                                                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another action</a>
                                                                        <a class="dropdown-item" href="#">Something else</a>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>


                                            <div>
                                                <div class="chat-conversation p-3">
                                                    <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                                                        <li>
                                                            <div class="chat-day-title">
                                                                <span class="title">Today</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="conversation-list">
                                                                <div class="dropdown">

                                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="#">Copy</a>
                                                                        <a class="dropdown-item" href="#">Save</a>
                                                                        <a class="dropdown-item" href="#">Forward</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>
                                                                    </div>
                                                                </div>
                                                                <div class="ctext-wrap">
                                                                    <div class="conversation-name">Promise Ezema</div>
                                                                    <p>
                                                                        Hello!
                                                                    </p>
                                                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:00</p>
                                                                </div>

                                                            </div>
                                                        </li>

                                                        <li class="right">
                                                            <div class="conversation-list">
                                                                <div class="dropdown">

                                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="#">Copy</a>
                                                                        <a class="dropdown-item" href="#">Save</a>
                                                                        <a class="dropdown-item" href="#">Forward</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>
                                                                    </div>
                                                                </div>
                                                                <div class="ctext-wrap">
                                                                    <div class="conversation-name">Hamzat</div>
                                                                    <p>
                                                                        Hi, How are you? What about our next meeting?
                                                                    </p>

                                                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="conversation-list">
                                                                <div class="dropdown">

                                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="#">Copy</a>
                                                                        <a class="dropdown-item" href="#">Save</a>
                                                                        <a class="dropdown-item" href="#">Forward</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>
                                                                    </div>
                                                                </div>
                                                                <div class="ctext-wrap">
                                                                    <div class="conversation-name">Promise Ezema</div>
                                                                    <p>
                                                                        Yeah everything is fine
                                                                    </p>

                                                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                                                </div>

                                                            </div>
                                                        </li>

                                                        <li class="last-chat">
                                                            <div class="conversation-list">
                                                                <div class="dropdown">

                                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="#">Copy</a>
                                                                        <a class="dropdown-item" href="#">Save</a>
                                                                        <a class="dropdown-item" href="#">Forward</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>
                                                                    </div>
                                                                </div>
                                                                <div class="ctext-wrap">
                                                                    <div class="conversation-name">Promise Ezema</div>
                                                                    <p>& Next meeting tomorrow 10.00AM</p>
                                                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                                                </div>

                                                            </div>
                                                        </li>

                                                        <li class=" right">
                                                            <div class="conversation-list">
                                                                <div class="dropdown">

                                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="#">Copy</a>
                                                                        <a class="dropdown-item" href="#">Save</a>
                                                                        <a class="dropdown-item" href="#">Forward</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>
                                                                    </div>
                                                                </div>
                                                                <div class="ctext-wrap">
                                                                    <div class="conversation-name">Hamzat</div>
                                                                    <p>
                                                                        Wow that's great
                                                                    </p>

                                                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:07</p>
                                                                </div>
                                                            </div>
                                                        </li>


                                                    </ul>
                                                </div>
                                                <div class="p-3 chat-input-section">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control chat-input" placeholder="Enter Message...">
                                                                <div class="chat-input-links" id="tooltip-container">
                                                                    <ul class="list-inline mb-0">
                                                                        <li class="list-inline-item"><a href="javascript: void(0);" title="Emoji"><i class="mdi mdi-emoticon-happy-outline"></i></a></li>
                                                                        <li class="list-inline-item"><a href="javascript: void(0);" title="Images"><i class="mdi mdi-file-image-outline"></i></a></li>
                                                                        <li class="list-inline-item"><a href="javascript: void(0);" title="Add Files"><i class="mdi mdi-file-document-outline"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
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
                </div>
            </div>
        </div>
    </div>

    <!-- END layout-wrapper -->
    @endsection
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
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Ojafunnel Support</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Support</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->


            <!-- <div class="d-lg-flex" id="app">
                <example-component :userprop="{{ Auth::user() }}"></example-component>
            </div> -->

            <div id="app">
                <example-component></example-component>
            </div>
            
            <!-- <div >
                <div class="chat-leftsidebar me-lg-4">
                    <div class="">
                        <div class="py-4 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0 align-self-center me-3">
                                    <img src="assets/images/users/avatar-1.jpg" class="avatar-xs rounded-circle" alt="">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-1">Henry Wells</h5>
                                    <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active</p>
                                </div>

                                <div>
                                    <div class="dropdown chat-noti-dropdown active">
                                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-bell bx-tada"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="search-box chat-search-box py-4">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>

                        <div class="chat-leftsidebar-nav">
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active" aria-selected="true" role="tab">
                                        <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">Chat</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#groups" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" tabindex="-1" role="tab">
                                        <i class="bx bx-group font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">Groups</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#contacts" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" tabindex="-1" role="tab">
                                        <i class="bx bx-book-content font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">Contacts</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-4">
                                <div class="tab-pane show active" id="chat" role="tabpanel">
                                    <div>
                                        <h5 class="font-size-14 mb-3">Recent</h5>
                                        <ul class="list-unstyled chat-list" data-simplebar="init" style="max-height: 410px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -20px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                            <li class="active">
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <i class="mdi mdi-circle font-size-10"></i>
                                                        </div>
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="">
                                                        </div>
                                                        
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="text-truncate font-size-14 mb-1">Steven Franklin</h5>
                                                            <p class="text-truncate mb-0">Hey! there I'm available</p>
                                                        </div>
                                                        <div class="font-size-11">05 min</div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <i class="mdi mdi-circle text-success font-size-10"></i>
                                                        </div>
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-xs" alt="">
                                                        </div>

                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="text-truncate font-size-14 mb-1">Adam Miller</h5>
                                                            <p class="text-truncate mb-0">I've finished it! See you so</p>
                                                        </div>
                                                        <div class="font-size-11">12 min</div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <i class="mdi mdi-circle text-success font-size-10"></i>
                                                        </div>
                                                        <div class="avatar-xs align-self-center me-3">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                K
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                            <p class="text-truncate mb-0">This theme is awesome!</p>
                                                        </div>
                                                        <div class="font-size-11">24 min</div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <i class="mdi mdi-circle text-warning font-size-10"></i>
                                                        </div>
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="">
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="text-truncate font-size-14 mb-1">Jose Vickery</h5>
                                                            <p class="text-truncate mb-0">Nice to meet you</p>
                                                        </div>
                                                        <div class="font-size-11">1 hr</div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <i class="mdi mdi-circle font-size-10"></i>
                                                        </div>

                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                    M
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="text-truncate font-size-14 mb-1">Mitchel Givens</h5>
                                                            <p class="text-truncate mb-0">Hey! there I'm available</p>
                                                        </div>
                                                        <div class="font-size-11">3 hrs</div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <i class="mdi mdi-circle text-success font-size-10"></i>
                                                        </div>
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <img src="assets/images/users/avatar-6.jpg" class="rounded-circle avatar-xs" alt="">
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="text-truncate font-size-14 mb-1">Stephen Hadley</h5>
                                                            <p class="text-truncate mb-0">I've finished it! See you so</p>
                                                        </div>
                                                        <div class="font-size-11">5hrs</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <i class="mdi mdi-circle text-success font-size-10"></i>
                                                        </div>
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                    K
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                            <p class="text-truncate mb-0">This theme is awesome!</p>
                                                        </div>
                                                        <div class="font-size-11">24 min</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 485px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 361px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></ul>
                                    </div>
                                </div>

                                <div class="tab-pane" id="groups" role="tabpanel">
                                    <h5 class="font-size-14 mb-3">Groups</h5>
                                    <ul class="list-unstyled chat-list" data-simplebar="init" style="max-height: 410px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; padding-right: 0px; padding-bottom: 0px; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                G
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">General</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                R
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">Reporting</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                M
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">Meeting</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                A
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">Project A</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                B
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">Project B</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div></ul>
                                </div>

                                <div class="tab-pane" id="contacts" role="tabpanel">
                                    <h5 class="font-size-14 mb-3">Contacts</h5>

                                    <div data-simplebar="init" style="max-height: 410px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; padding-right: 0px; padding-bottom: 0px; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
                                        <div>
                                            <div class="avatar-xs mb-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                    A
                                                </span>
                                            </div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Adam Miller</h5>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Alfonso Fisher</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-4">
                                            <div class="avatar-xs mb-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                    B
                                                </span>
                                            </div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Bonnie Harney</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-4">
                                            <div class="avatar-xs mb-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                    C
                                                </span>
                                            </div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Charles Brown</h5>
                                                    </a>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Carmella Jones</h5>
                                                    </a>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Carrie Williams</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-4">
                                            <div class="avatar-xs mb-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                    D
                                                </span>
                                            </div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Dolores Minter</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div></div>

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
                                    <h5 class="font-size-15 mb-1">Steven Franklin</h5>
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
                                <ul class="list-unstyled mb-0" data-simplebar="init" style="max-height: 486px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -20px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
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
                                                <div class="conversation-name">Steven Franklin</div>
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
                                                <div class="conversation-name">Henry Wells</div>
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
                                                <div class="conversation-name">Steven Franklin</div>
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
                                                <div class="conversation-name">Steven Franklin</div>
                                                <p>&amp; Next meeting tomorrow 10.00AM</p>
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
                                                <div class="conversation-name">Henry Wells</div>
                                                <p>
                                                    Wow that's great
                                                </p>

                                                <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:07</p>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    
                                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 645px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar simplebar-visible" style="height: 377px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></ul>
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
            </div> -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
@endsection
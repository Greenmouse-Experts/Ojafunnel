@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-13">PAGE BUILDER</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Page Builder</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Create A Page</h4>
                            <p>
                                Create a page and begin editing your pages with our ready made components.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            @if(App\Models\ExplainerContent::where('menu', 'Page-Builder')->exists())
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="bi bi-card-text"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="all-create">
                            <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">New Page</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- store data information-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block"><i class="bi bi-sliders2"></i> All</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#templates1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                            </ul> --}}


                            <!-- store data information-->
                            <div class="page-contentts">
                                <div class="templatee-content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- category content -->
                                                <div class="template-listing">
                                                    <div class="template-listing-grid">
                                                        <div class="single-template">
                                                            <div class="inner first-grid">
                                                                <div class="text-center">
                                                                    <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                                    <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">New Page</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @foreach($pages as $page)

                                                            <div class="single-template">
                                                                <h6 class="text-center pageName">{{$page->name}}</h6>
                                                                <div class="inner second-grid">
                                                                    @if($page->thumbnail)
                                                                    <img src="{{$page->thumbnail}}" alt="templates" width="100%" height="100%" />
                                                                    @else
                                                                    <img src="http://via.placeholder.com/640x1000" alt="templates" width="100%" height="100%" />
                                                                    @endif
                                                                    <div class="start-template">

                                                                        <i class="bi bi-bookmark-plus-fill fs-1 text-primary"></i>
                                                                        @if($page->type == "questionaire_page")
                                                                            <a class="btn btn-primary d-block mt-2" target="_blank" style="cursor: pointer;" href="
                                                                            {{route('user.page.builder.view.quiz.response', [Auth::user()->username, Crypt::encrypt($page->id)])}}
                                                                            ">View Responses</a>

                                                                            <a class="btn btn-primary d-block mt-2" target="_blank" href="
                                                                            {{route('user.page.builder.view.edit.quiz', [Auth::user()->username, Crypt::encrypt($page->id)])}}
                                                                            ">Edit Quiz Field</a>
                                                                        @endif
                                                                        <a class="btn btn-primary d-block mt-2" href="{{route('user.page.builder.view.editor', [Auth::user()->username, Crypt::encrypt($page->id)])}}">
                                                                            Edit Page
                                                                        </a>
                                                                        <a class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#Editing-{{$page->id}}">
                                                                            Update Page
                                                                        </a>
                                                                        <a class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#Delete-{{$page->id}}">
                                                                            Delete Page
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Edit Input modal -->
                                                            <div class="modal fade" id="Editing-{{$page->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                                Page Manager
                                                                            </h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="Edit-level">
                                                                                    <form method="POST" action="{{ route('user.page.builder.update', Crypt::encrypt($page->id))}}" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <div class="form">
                                                                                            <div class="col-lg-12">
                                                                                                <label>Title</label>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 mb-4">
                                                                                                        <input type="text" name="title" class="input" value="{{$page->title}}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <label>Page Name</label>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 mb-4">
                                                                                                        <input type="text" name="name" class="input" value="{{preg_replace('/\\.[^.\\s]{3,4}$/', '', $page->name)}}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-12">
                                                                                                    <label>Add Thumbnail</label>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12 mb-4">
                                                                                                            <input type="file" name="thumbnail" class="input">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row justify-content-between">
                                                                                                    <div class="col-6">
                                                                                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                            Cancel
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="col-6 text-end">
                                                                                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                                                                                            Update
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--Edit Input end modal -->
                                                            </div>
                                                            <!-- Modal START -->
                                                            <div class="modal fade" id="Delete-{{$page->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content pb-3">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body ">
                                                                            <div class="row">
                                                                                <div class="Editt">
                                                                                    <form method="POST" action="{{ route('user.page.builder.delete', Crypt::encrypt($page->id))}}">
                                                                                        @csrf
                                                                                        <div class="form">
                                                                                            <p><b>Delete Page</b></p>
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <p>This action cannot be undone. This will permanently delete {{$page->name}} page.</p>
                                                                                                    <label>Please type DELETE to confirm.</label>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12 mb-4">
                                                                                                            <input type="text" name="delete_field" class="input" required>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-12 mb-4">
                                                                                                    <div class="boding">
                                                                                                        <button type="submit" class="form-btn">
                                                                                                            I understand this consquences, Delete this page.
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end modal -->
                                                        @endforeach

                                                        {{-- <div class="single-template">
                                                            <div class="inner first-grid">
                                                                <div class="text-center">
                                                                    <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                                    <a href="{{ route('user.page.builder.template', ['username' =>  Auth::user()->username, 'id' =>  1]) }}" target="_blank" class="btn btn-primary d-block mt-2">View Opt-In Page</a>
                                                                    <button data-bs-toggle="modal" data-bs-target="#template1" class="btn btn-primary d-block mt-2">Use Template</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-template">
                                                            <div class="inner first-grid">
                                                                <div class="text-center">
                                                                    <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                                    <a href="{{ route('user.page.builder.template', ['username' =>  Auth::user()->username, 'id' =>  2]) }}" target="_blank" class="btn btn-primary d-block mt-2">View Order Form Page</a>
                                                                    <button data-bs-toggle="modal" data-bs-target="#template2" class="btn btn-primary d-block mt-2">Use Template</button>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>

                                                <div class="template-listing">
                                                    <div class="template-listing-grid">
                                                        {{-- <div class="single-template">
                                                            <div class="inner first-grid">
                                                                <div class="text-center">
                                                                    <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                                    <a href="{{ route('user.page.builder.template', ['username' =>  Auth::user()->username, 'id' =>  3]) }}" class="btn btn-primary d-block mt-2">View Order Bump / Upsell Page</a>
                                                                    <button data-bs-toggle="modal" data-bs-target="#template3" class="btn btn-primary d-block mt-2">Use Template</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="single-template">
                                                            <div class="inner first-grid">
                                                                <div class="text-center">
                                                                    <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                                    <a href="{{ route('user.page.builder.template', ['username' =>  Auth::user()->username, 'id' =>  4]) }}" target="_blank" class="btn btn-primary d-block mt-2">View Thank You Page</a>
                                                                    <button data-bs-toggle="modal" data-bs-target="#template4" class="btn btn-primary d-block mt-2">Use Template</button>
                                                                </div>
                                                            </div>
                                                        </div> --}}


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



            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">My Pages</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Folder</th>
                                            <th>Domain</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pages as $page)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $page->title }}</td>
                                                <td>
                                                    @if($page->type == "landing_page")
                                                        Landing Page
                                                    @elseif($page->type == "optin_page")
                                                        Opt-In Page
                                                    @elseif($page->type == "upsell_page")
                                                        Upsell Page
                                                    @elseif($page->type == "upsell_bump_page")
                                                        Upsell & Bump Page
                                                    @elseif($page->type == "questionaire_page")
                                                        Quiz Page
                                                    @elseif($page->type == "dynamic_timer_page")
                                                        Dynamic Timer for Product Page
                                                    @else
                                                        Thank You Page
                                                    @endif
                                                </th>
                                                <td>{{ $page->folder }}</td>
                                                <td>
                                                    @if (env('APP_ENV') == 'local')
                                                        {{ $page->file_location	}}
                                                    @else
                                                        @if ($page->name == 'index.html')
                                                            {{ 'https://' . $page->slug . '-page.ojafunnel.com' . '/' }}
                                                        @else
                                                            {{ 'https://' . $page->slug . '-page.ojafunnel.com' . '/' . explode('.', $page->name)[0] }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{ $page->created_at->toDayDateTimeString() }}</td>
                                                <td>
                                                    <div class="dropdown-center">
                                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Options
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            @if($page->type == "questionaire_page")
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" href="
                                                                {{route('user.page.builder.view.quiz.response', [Auth::user()->username, Crypt::encrypt($page->id)])}}
                                                                ">View Responses</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" href="
                                                                {{route('user.page.builder.view.edit.quiz', [Auth::user()->username, Crypt::encrypt($page->id)])}}
                                                                ">Edit Quiz Field</a>
                                                            </li>
                                                            @endif
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" href="
                                                                {{route('user.page.builder.view.editor', [Auth::user()->username, Crypt::encrypt($page->id)])}}
                                                                ">Edit Page</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" target="_blank" href="
                                                                    @if (env('APP_ENV') == 'local')
                                                                        {{ $page->file_location	}}
                                                                    @else
                                                                        @if ($page->name == 'index.html')
                                                                            {{ 'https://' . $page->slug . '-page.ojafunnel.com' . '/' }}
                                                                        @else
                                                                            {{ 'https://' . $page->slug . '-page.ojafunnel.com' . '/' . explode('.', $page->name)[0] }}
                                                                        @endif
                                                                    @endif
                                                                ">View Page</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" href="
                                                                {{ route('user.page.add.custom.domain', ['username' => Auth::user()->username, 'id' => $page->id])}}
                                                                ">Custom Domain</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            {{ 'No pages at the moment' }}
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end page title -->
</div>
</div>
</div>
<!-- END layout-wrapper -->

<!-- Modal START -->
<div class="modal fade" id="template" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{route('user.page.builder.create')}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        New Page
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label> Title </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="e.g Homepage" name="title" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Sub Domain</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="e.g Tola Cake And Pasteries" id="subdomain" name="file_folder" class="input" required>
                                                <small id="generateSubDomain"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Page Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="e.g Home" id="pagename" name="file_name" class="input" value="index" required>
                                                <small id="generatePage"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Page Type</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <select name="page_type" id="page_options" class="input" required style="height: 50px;" onchange="enableFields()">
                                                    <option value="">--Select Page Type--</option>
                                                    <option value="landing_page">Landing Page</option>
                                                    <option value="optin_page">Opt-In Page</option>
                                                    <option value="upsell_page">Upsell Form Page</option>
                                                    <option value="upsell_bump_page">Order Bump/Upsell Page</option>
                                                    <option value="questionaire_page">Quiz Page</option>
                                                    <option value="thank_you_page">Thank You Page</option>
                                                    <option value="dynamic_timer_page">Dynamic Timer for Product Page</option>
                                                </select>
                                                <small id="generatePage"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>List Management</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <select name="list_id" id="list_id" class="input" style="height: 50px;" required>
                                                    <option value="">--Select List --</option>
                                                    @foreach (\App\Models\ListManagement::where(['user_id' => Auth::user()->id, 'status' => 1])->get() as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="generatePage"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div  id="upsell_select" style="display: none">
                                        <div class="col-lg-12">
                                            <label>Product Name</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="text" placeholder="e.g Data Analytics Course" id="product_name" name="product_name" class="input">
                                                    <small id="generatePage"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Product Price</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="number" placeholder="e.g 1000" id="product_price" name="product_price" class="input">
                                                    <small id="generatePage"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Collection Account</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select name="collection_account" class="input">
                                                        @foreach (\App\Models\BankDetail::where('user_id', Auth::user()->id)->get() as $acc)
                                                            @if($acc->type != "PAYSTACK")
                                                                <option value="{{$acc->id}}">{{$acc->bank_name}} / {{$acc->account_number}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <small id="generatePage"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="bumpsell_select" class="col-lg-12" style="display: none">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label>Product Name</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <input type="text" placeholder="e.g Data Analytics Course" id="bump_product_name" name="bump_product_name_main" class="input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Product Price</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <input type="number" placeholder="e.g 10000" id="bump_product_price" name="bump_product_price_main" class="input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <legend style="font-size: 14px; font-weight: 600">Set Bump Products </legend>
                                        <div id="bumps">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <label>Product Name</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-2">
                                                            <input type="text" placeholder="e.g Data Analytics Course" id="bump_product_name" name="bump_product_name" class="input">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Product Price</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-2">
                                                            <input type="number" placeholder="e.g 10000" id="bump_product_price" name="bump_product_price" class="input">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <a href="#" onclick="addMore()">Add more fields</a>
                                        <div class="col-lg-12 mt-3">
                                            <label>Collection Account</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select name="collection_account" class="input">
                                                        @foreach (\App\Models\BankDetail::where('user_id', Auth::user()->id)->get() as $acc)
                                                            @if($acc->type != "PAYSTACK")
                                                                <option value="{{$acc->id}}">{{$acc->bank_name}} / {{$acc->account_number}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <small id="generatePage"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="success_select" class="col-lg-12" style="display: none">
                                        Select success page
                                    </div>

                                    <div id="dynamic_timer_div" class="col-lg-12" style="display: none">
                                        <div class="col-lg-12">
                                            <label>Product Name</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="text" placeholder="e.g Data Analytics Course" id="product_name" name="product_name" class="input">
                                                    <small id="generatePage"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Product Price</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="number" placeholder="e.g 1000" id="product_price" name="product_price" class="input">
                                                    <small id="generatePage"></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-7">
                                                <label>Offer Time (Interval) days</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <input id="offer_time" placeholder="No of days" type="number" name="offer_time" class="input" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Rate %</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <select name="rate" class="input">
                                                            <option value="10">+10%</option>
                                                            <option value="20">+20%</option>
                                                            <option value="50">+50%</option>
                                                            <option value="70">+70%</option>
                                                            <option value="100">+100%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="submit">
                                                Proceed
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@for($i=1; $i<=4; $i++)
<div class="modal fade" id="template{{$i}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{route('user.page.builder.create')}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        New Page
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label> Title </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="e.g Homepage" name="title" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Sub Domain</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="e.g Tola Cake And Pasteries" id="subdomain" name="file_folder" class="input" required>
                                                <small id="generateSubDomain"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Page Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="e.g Home" id="pagename" name="file_name" class="input" required>
                                                <small id="generatePage"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="page_type" value="{{$i}}"

                                    {{-- <div class="col-lg-12">
                                        <label>Page Type</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <select name="page_type" class="input" required style="height: 50px;">
                                                    <option>--Select Page Type--</option>
                                                    <option value="landing_page">Landing Page</option>
                                                    <option value="optin_page">Opt-In Page</option>
                                                    <option value="order_form_page">Order Form Page</option>
                                                    <option value="order_bump_upsell">Order Bump/Upsell Page</option>
                                                    <option value="thank_you_page">Thank You Page</option>
                                                </select>
                                                <small id="generatePage"></small>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="submit">
                                                Proceed
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endfor


<style>
    .pageName {
        background: #556ee6;
        padding: 0.7rem;
        border-radius: 20px;
        color: #fff;
    }
</style>
<script>
function enableFields() {
    const selectedOption = document.getElementById("page_options").value;
    const divOption1 = document.getElementById("upsell_select");
    const divOption2 = document.getElementById("bumpsell_select");
    const divOption3 = document.getElementById("success_select");
    const dynamic_timer_div = document.getElementById("dynamic_timer_div");

    // Hide all divs initially
    divOption1.style.display = "none";
    divOption2.style.display = "none";
    divOption3.style.display = "none";
    dynamic_timer_div.style.display = "none";

    // Show the corresponding div based on the selected option
    if (selectedOption === "upsell_page") {
        divOption1.style.display = "block";
    } else if (selectedOption === "upsell_bump_page") {
        divOption2.style.display = "block";
    } else if (selectedOption === "dynamic_timer_page") {
        dynamic_timer_div.style.display = "block";
    }
}
function removeField(e) {
    const field = e.parentNode.parentNode;
    // console.log(field);
    const container = document.getElementById('bumps');
    container.removeChild(field);
}

let fieldCounter = 1;
function addMore() {
    fieldCounter++;
    const container = document.getElementById('bumps');
    const field = document.createElement('div');
    field.className = 'row';
    field.innerHTML = `
            <div class="col-md-6">
                <label>Product Name</label>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input type="text" placeholder="e.g Data Analytics Course" id="bump_product_name" name="bump_product_name_${fieldCounter}" class="input">
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <label>Product Price</label>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input type="number" placeholder="e.g 10000" id="bump_product_price" name="bump_product_price_${fieldCounter}" class="input">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <a href="#" onclick="removeField(this)"><i class="fa fa-times"></i></a>
            </div>`;
    container.appendChild(field);
}



</script>
<script>
    let subdomain = document.getElementById('subdomain');
    let pagename = document.getElementById('pagename');

    let subdomaintext = document.getElementById('generateSubDomain');
    let pagetext = document.getElementById('generatePage');

    subdomain.addEventListener('input', (event) => {
        if('{{ env('APP_URL') }}'.startsWith('https'))
            subdomaintext.innerText = `https://${event.target.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase() + '-page'}.ojafunnel.com`

        subdomain.value = event.target.value.replace(/\s+/g, ' ')
    })

    pagename.addEventListener('input', (event) => {
        if('{{ env('APP_URL') }}'.startsWith('https'))
            pagetext.innerText = `${subdomaintext.innerText}/${event.target.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase()}`

        pagename.value = event.target.value.replace(/\s+/g, ' ')
    })
</script>
@if(App\Models\ExplainerContent::where('menu', 'Page-Builder')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Page-Builder')->first()->video}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
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
<!-- Modal Ends -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Text Explainer</h4>
                        <div class="aller">
                            <p>
                            {{App\Models\ExplainerContent::where('menu', 'Page-Builder')->first()->text}}
                            </p>
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
<!-- Modal Ends -->
@endif
@endsection

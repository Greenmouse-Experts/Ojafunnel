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
                            <h4 class="font-60">Choose A Template</h4>
                            <p>
                            Pick a ready made template to begin building your pages
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="bi bi-card-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="all-create">
                            <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">New Template</button>
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
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block"><i class="bi bi-sliders2"></i> All</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- store data information-->
            <div class="page-contentts">
                <div class="templatee-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10">
                                <!-- category content -->
                                <div class="template-listing">
                                    <div class="template-listing-grid">
                                        <div class="single-template">
                                            <div class="inner first-grid">
                                                <div class="text-center">
                                                    <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                    <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">New Template</button>
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
                                                    <a class="btn btn-primary d-block mt-2" href="{{route('user.page.builder.view.editor', [Auth::user()->username, Crypt::encrypt($page->id)])}}">
                                                        Use Template
                                                    </a>
                                                    <a class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#Editing-{{$page->id}}">
                                                        Edit Template
                                                    </a>
                                                    <a class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#Delete-{{$page->id}}">
                                                        Delete Template
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
                                                                        <p><b>Delete Contact</b></p>
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
                                </div>
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
                                                <input type="text" placeholder="Title" name="title" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Sub Domain</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="File Folder" id="subdomain" name="file_folder" class="input" required> 
                                                <small id="generateSubDomain"></small>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Page Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="File Name" id="pagename" name="file_name" class="input" required>
                                                <small id="generatePage"></small>
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

<style>
    .pageName {
        background: #556ee6;
        padding: 0.7rem;
        border-radius: 20px;
        color: #fff;
    }
</style>
<script>
    let subdomain = document.getElementById('subdomain');
    let pagename = document.getElementById('pagename');

    let subdomaintext = document.getElementById('generateSubDomain');
    let pagetext = document.getElementById('generatePage');

    subdomain.addEventListener('input', (event) => {
        if('{{ env('APP_URL') }}'.startsWith('https')) 
            subdomaintext.innerText = `https://${event.target.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase()}.ojafunnel.com`

        subdomain.value = event.target.value.replace(/\s+/g, ' ')
    })

    pagename.addEventListener('input', (event) => {
        if('{{ env('APP_URL') }}'.startsWith('https')) 
            pagetext.innerText = `${subdomaintext.innerText}/${event.target.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase()}`

        pagename.value = event.target.value.replace(/\s+/g, ' ')
    })
</script>
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="https://www.youtube.com/embed/9xwazD5SyVg" title="Dummy Video For YouTube API Test" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, ducimus iste. Consequuntur doloremque voluptatem officia, quos laborum delectus atque distinctio reprehenderit earum iure. Sequi voluptate architecto libero, repellat neque deserunt assumenda sunt in sit ipsam delectus nostrum qui ratione. Laboriosam aliquid obcaecati vitae voluptatum ea minus quidem! Pariatur soluta quasi modi harum aut quas veritatis et. Necessitatibus fuga illo ipsa dicta aut nisi laborum nam at, id eveniet consectetur praesentium enim, cum dignissimos ipsum rem odio. Atque, eaque magni aut incidunt quo laudantium repudiandae quae modi officiis in, iusto suscipit fugiat rem inventore non dolorum adipisci rerum dolorem. Nulla, vero!
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
@endsection

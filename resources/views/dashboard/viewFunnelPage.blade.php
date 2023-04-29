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
            <div class="row card begin">
                <div class="col-12 account-head">
                    <div class="row py-3 justify-content-between align-items-center">
                        <div class="col-md-9">
                            <div class="all-create">
                                <a href="{{route('user.choose.temp', Auth::user()->username)}}" style="background-color: #000; color: #fff; border: none; padding: 10px 20px 10px 20px;">
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="all-create">
                                <button data-bs-toggle="modal" data-bs-target="#template">
                                    + Create New Funnel Page
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex account-nav">
                        <p class="ps-0 active">
                            <a href="#" class="text-decoration-none text-dark">All</a>
                        </p>
                    </div>
                    <div class="acc-border"></div>
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
                                                    <a class="btn btn-primary d-block mt-2" href="{{route('user.funnel.builder.view.editor', [Auth::user()->username, Crypt::encrypt($page->id)])}}">
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
                                                    <div class="modal-body ">
                                                        <div class="row">
                                                            <div class="Editt">
                                                                <form method="POST" action="{{ route('user.funnel.builder.update.page', Crypt::encrypt($page->id))}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form">
                                                                        <p>
                                                                            <b>
                                                                                {{$page->title}} Page
                                                                            </b>
                                                                        </p>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <label>Title </label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input type="text" placeholder="Title" name="title" class="input" value="{{$page->title}}" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Sub Domain</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input value="{{$funnel->folder}}" class="input" readonly>
                                                                                        <input value="{{$funnel->id}}" name="file_folder" hidden>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Page Name </label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input type="text" placeholder="File Name" name="file_name"  value="{{preg_replace('/\\.[^.\\s]{3,4}$/', '', $page->name)}}" class="input" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Thumbnail </label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input type="file" name="thumbnail" class="input">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12 mb-4">
                                                                                <div class="boding">
                                                                                    <button type="submit">
                                                                                        Update
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
                                                                <form method="POST" action="{{ route('user.funnel.builder.delete.page', Crypt::encrypt($page->id))}}">
                                                                    @csrf
                                                                    <div class="form">
                                                                        <p><b>Delete Page</b></p>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <p>This action cannot be undone. This will permanently delete {{$page->title}}.</p>
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
                                                                                        I understand this consquences, Delete
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


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">My Funnel Pages</h4>
                                        <div class="table-responsive"> 
                                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                                <thead class="tread">
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Title</th>
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
                                                            <td>{{ $funnel->folder }}</td> 
                                                            <td>
                                                                @if (env('APP_ENV') == 'local')
                                                                    {{ $page->file_location	}}
                                                                @else
                                                                    @if ($page->name == 'index.html')
                                                                        {{ 'https://' . $funnel->slug . '-funnel.ojafunnel.com' . '/' }}
                                                                    @else
                                                                        {{ 'https://' . $funnel->slug . '-funnel.ojafunnel.com' . '/' . explode('.', $page->name)[0] }}
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
                                                                        <li>
                                                                            <a class="dropdown-item" style="cursor: pointer;" href="
                                                                            {{route('user.funnel.builder.view.editor', [Auth::user()->username, Crypt::encrypt($page->id)])}}
                                                                            ">Edit Page</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item" style="cursor: pointer;" target="_blank" href="
                                                                                @if (env('APP_ENV') == 'local')
                                                                                    {{ $page->file_location	}}
                                                                                @else
                                                                                    @if ($page->name == 'index.html')
                                                                                        {{ 'https://' . $funnel->slug . '-funnel.ojafunnel.com' . '/' }}
                                                                                    @else
                                                                                        {{ 'https://' . $funnel->slug . '-funnel.ojafunnel.com' . '/' . explode('.', $page->name)[0] }}
                                                                                    @endif 
                                                                                @endif
                                                                            ">View Page</a>
                                                                        </li> 
                                                                    </ul>
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        {{ 'No pages in this funnel at the moment' }}
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
            </div>
        </div>
    </div>
    <!-- End Page-content -->
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
                        <form method="POST" action="{{route('user.funnel.builder.create.page')}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        New Page
                                    </b> 
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Title </label>
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
                                                <input value="{{$funnel->id}}" name="file_folder" hidden>

                                                <input id="subdomain" value="{{$funnel->folder}}" class="input" readonly> 
                                                <small id="generateSubDomain"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Page Name </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="e.g Home" id="pagename" name="file_name" class="input" required>
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
<script>
    let subdomain = document.getElementById('subdomain');
    let pagename = document.getElementById('pagename');

    let subdomaintext = document.getElementById('generateSubDomain');
    let pagetext = document.getElementById('generatePage');

    if('{{ env('APP_URL') }}'.startsWith('https')) 
        subdomaintext.innerText = `https://${subdomain.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase() + '-funnel'}.ojafunnel.com`

    subdomain.value = subdomain.value.replace(/\s+/g, ' ')

    pagename.addEventListener('input', (event) => {
        if('{{ env('APP_URL') }}'.startsWith('https')) 
            pagetext.innerText = `${subdomaintext.innerText}/${event.target.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase()}`

        pagename.value = event.target.value.replace(/\s+/g, ' ')
    })
</script>
<!-- end modal -->

<style>
    .pageName {
        background: #556ee6;
        padding: 0.7rem;
        border-radius: 20px;
        color: #fff;
    } 
</style>
@endsection
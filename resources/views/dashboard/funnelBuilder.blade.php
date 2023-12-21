@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-13">FUNNEL BUILDER</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Funnel Builder</li>
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
                            <h4 class="font-60">Create A Funnel</h4>
                            <p>
                                Create a funnel templates to begin building your funnel
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            @if(App\Models\ExplainerContent::where('menu', 'Funnel-Builder')->exists())
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
                                <button data-bs-toggle="modal" data-bs-target="#template">
                                    + Create Funnel
                                </button>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Funnels</h4>
                            <div class="table-responsive mt-2">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Folder Name</th>
                                            <th scope="col">Number of Pages</th>
                                            <th scope="col">Actions</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @foreach($funnels as $funnel)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$funnel->created_at->toDayDateTimeString()}}</td>
                                            <td>{{\App\Models\Funnel::getCategory($funnel->category_id)}}</td>
                                            <td>{{$funnel->folder}}</td>
                                            <td>{{\App\Models\FunnelPage::where('folder_id', $funnel->id)->count()}}</td>
                                            <td>
                                                <div class="dropdown-center">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <a class="dropdown-item" href="{{route('user.view.funnel.pages', [Auth::user()->username, Crypt::encrypt($funnel->id)])}}">View Funnel Pages</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit-{{$funnel->id}}">Edit Funnel</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$funnel->id}}">Delete Funnel</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" style="cursor: pointer;" href="
                                                            {{ route('user.add.custom.domain', ['username' => Auth::user()->username, 'id' => $funnel->id])}}
                                                            ">Custom Domain</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="edit-{{$funnel->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('user.funnel.builder.update', Crypt::encrypt($funnel->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p>
                                                                                    <b>
                                                                                        Funnel Sub Domain
                                                                                    </b>
                                                                                </p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <label>Sub Domain</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" placeholder="File Folder" name="file_folder" id="subdomain1" class="input" value="{{$funnel->folder}}" required>
                                                                                                <small id="generateSubDomain1"></small>
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
                                                <!-- end modal -->
                                                <!-- Modal START -->
                                                <div class="modal fade" id="delete-{{$funnel->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('user.funnel.builder.delete', Crypt::encrypt($funnel->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete Funnel</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. This will permanently delete {{$funnel->folder}}.</p>
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
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
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
                        <form method="POST" action="{{route('user.funnel.builder.create.folder')}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        Funnel Sub Domain
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Select Category</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <select name="category_id" class="input" required>
                                                    <option>---Select Category---</option>
                                                    @foreach (\App\Models\FunnelCategory::all() as $rec)
                                                        <option value="{{$rec->id}}">{{$rec->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Sub Domain</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" id="subdomain" placeholder="e.g Tola Cake And Pasteries" name="file_folder" class="input" required>
                                                <small id="generateSubDomain"></small>
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
@if(App\Models\ExplainerContent::where('menu', 'Funnel-Builder')->exists())
<!-- end modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="{{App\Models\ExplainerContent::where('menu', 'Funnel-Builder')->first()->video}}" title="Dummy Video For YouTube API Test" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
                            {{App\Models\ExplainerContent::where('menu', 'Funnel-Builder')->first()->text}}
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
@endif
<script>
    let subdomain = document.getElementById('subdomain');
    let subdomaintext = document.getElementById('generateSubDomain');

    subdomain.addEventListener('input', (event) => {
        if('{{ env('APP_URL') }}'.startsWith('https'))
            subdomaintext.innerText = `https://${event.target.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase() + '-funnel'}.ojafunnel.com`

        subdomain.value = event.target.value.replace(/\s+/g, ' ')
    })

    let subdomain1 = document.getElementById('subdomain1');
    let subdomain1text = document.getElementById('generateSubDomain1');

    subdomain1.addEventListener('input', (event) => {
        if('{{ env('APP_URL') }}'.startsWith('https'))
            subdomain1text.innerText = `https://${event.target.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase() + '-funnel'}.ojafunnel.com`

        subdomain1.value = event.target.value.replace(/\s+/g, ' ')
    })
</script>
<!-- Modal Ends -->
@endsection

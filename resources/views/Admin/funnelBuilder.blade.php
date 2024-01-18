@extends('layouts.admin-frontend')

@section('page-content')
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
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Funnel Builder</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">View All Funnel</h4>
                            <p>
                                View all ojafunnel users funnel templates.
                            </p>
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
                                            <td>{{$funnel->folder}}</td>
                                            <td>{{\App\Models\FunnelPage::where('folder_id', $funnel->id)->count()}}</td>
                                            <td>
                                                <div class="dropdown-center">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('funnelBuilderView', ['id' => Crypt::encrypt($funnel->id)])}}">View Pages</a></li>
                                                    </ul>
                                                </div>
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
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Funnel-Builder')->first()->video}}" type="video/mp4">
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
@endsection

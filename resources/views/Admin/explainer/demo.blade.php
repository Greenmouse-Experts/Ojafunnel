@extends('layouts.admin-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">Demo Video</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Demo Video</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->

            <!-- start page title -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Demo Video</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="all-create">
                                <button type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Demo Video</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th class="align-middle">S/N</th>
                                            <th class="align-middle">Video</th>
                                            <th class="align-middle">Date Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($demo as $key => $demo)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="200">
                                                    <source src="{{ $demo->video }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($demo->created_at)->isoFormat('llll') }}
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

        </div>
    </div>
    <!-- End Page-content -->
</div>

<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{route('admin.update.demo.video')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="Editt">
                                <div class="form">
                                    <h4 class="card-title">Demo Video</h4>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <label for="video">Video</label>
                                            <input type="file" name="video" id="video" placeholder="Enter video" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn" style="color: #714091; border: 1px solid #714091">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ends -->
@endsection

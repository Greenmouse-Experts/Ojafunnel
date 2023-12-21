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
                        <h4 class="mb-sm-0 font-size-18">Explainer Contents</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Explainer Contents</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->

            <!-- start page title -->
            <!-- <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Explainer Contents</h4>
                            <p>
                                All explainer contents in one place
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="all-create">
                                <button type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">All Menues Explainer Contents</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th class="align-middle">S/N</th>
                                            <th class="align-middle">Menues</th>
                                            <th class="align-middle">Text</th>
                                            <th class="align-middle">Video</th>
                                            <th class="align-middle">Date Created</th>
                                            <th class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($explainers as $key => $explainer)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <p class='text-bold-600'>{{$explainer->menu}} </p>
                                            </td>
                                            <td>
                                                {{$explainer->text}}
                                            </td>
                                            <td>
                                                <iframe src="{{ $explainer->video }}" title="{{App\Models\ExplainerContent::where('menu', 'Dashboard')->first()->menu}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($explainer->created_at)->isoFormat('llll') }}
                                            </td>
                                            <td>
                                                <a style="cursor: pointer;" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#edit-{{$explainer->id}}">Edit</a>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="edit-{{$explainer->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="post" action="{{route('admin.update.general.explainer.content', Crypt::encrypt($explainer->id))}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="Editt">
                                                                                            <div class="form">
                                                                                                <h4 class="card-title">Explainer Contents for {{$explainer->menu}}</h4>
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12 mb-4">
                                                                                                        <label for="menu">Menu</label>
                                                                                                        <input type="text" id="menu" placeholder="Enter Menue" value="{{$explainer->menu}}" readonly/>
                                                                                                    </div>
                                                                                                    <div class="col-lg-12 mb-4">
                                                                                                        <label for="text">Text</label>
                                                                                                        <textarea type="text" name="text" id="text" value="{{$explainer->text}}" placeholder="Enter text">{{$explainer->text}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="col-lg-12 mb-4">
                                                                                                        <label for="video">Video</label>
                                                                                                        <input type="file" name="video" id="video" placeholder="Enter video" value="{{$explainer->video}}"/>
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
                                                                                    Submit
                                                                                </button>
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

        </div>
    </div>
    <!-- End Page-content -->
</div>

<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{route('user.withdraw')}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="Editt">
                                <div class="form">
                                    <h4 class="card-title">Withdrawal Information</h4>
                                    <p class="card-title-desc">Fill all information below to complete your Withdrawal</p>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Menues</label>
                                            <select name="payment_method" id="name" required>
                                                <option value="">-- Select Menu --</option>
                                                <option value="Dashboard">Dashboard</option>
                                                <option value="Email-Marketing">Dashboard</option>
                                                <option value="List-Management">Dashboard</option>
                                                <option value="Funnel-Builder">Dashboard</option>
                                                <option value="Transaction">Dashboard</option>
                                                <option value="Withdrawal">Dashboard</option>
                                                <option value="Subscription">Dashboard</option>
                                                <option value="Automation">Dashboard</option>
                                                <option value="Ecommerce">Dashboard</option>
                                                <option value="Market-Place">Dashboard</option>
                                                <option value="Affiliate-Marketing">Dashboard</option>
                                                <option value="Integration">Dashboard</option>
                                                <option value="Learning-Management">Dashboard</option>
                                                <option value="Birthday-Modules">Dashboard</option>
                                                <option value="Sales">Dashboard</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="text">text</label>
                                            <textarea type="text" name="text" id="text" placeholder="Enter text"></textarea>
                                        </div>
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
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ends -->
@endsection

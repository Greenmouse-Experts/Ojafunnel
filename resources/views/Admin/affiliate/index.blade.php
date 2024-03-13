@extends('layouts.admin-frontend')
@section('page-content')
@inject('uc', 'App\Http\Controllers\DashboardController')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Affiliate Levels</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Affiliate Levels</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Affiliate Level</h4>
                            <p>View and edit your affiliate level</p>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-2 aminn">
                    <div class="card account-head">
                        <div class="all-create" data-bs-toggle="modal" data-bs-target="#add">
                            <button>
                                + Add Level
                            </button>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Affiliate List</h4>
                            <div class="mb-4">These users below are sorted by the highest referrals</div>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Level</th>
                                            <th>Bonus Percent</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($levels as $key => $level)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <p class='text-bold-600'> {{$level->level}} </p>
                                            </td>
                                            <td>
                                                {{$level->bonus_percent}}%
                                            </td>
                                            <td>{{ $level->created_at->toDayDateTimeString() }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit-{{$level->id}}">Edit</a></li>
                                                        <!-- <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$level->id}}">Delete</a></li> -->
                                                    </ul>
                                                </div>

                                                <!-- Modal START -->
                                                <div class="modal fade" id="edit-{{$level->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <h4 class="card-title mb-4">Edit Level</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="Editt">
                                                                    <form method="POST" action="{{ route('affiliate-levels.update', Crypt::encrypt($level->id))}}">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="level">Level</label>
                                                                                    <input type="number" name="level" class="input me" placeholder="Enter level e.g (1, 2 ...)" id="level" value="{{$level->level}}" required />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="bonus_percent">Bonus Percent</label>
                                                                                    <input type="number" name="bonus_percent" class="input me" placeholder="Enter bonus percent" id="bonus_percent" value="{{$level->bonus_percent}}" required />
                                                                                </div>
                                                                                <div class="text-end mt-2">
                                                                                    <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
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
                                                <!-- end modal -->
                                                <!-- Modal START -->
                                                <div class="modal fade" id="delete-{{$level->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <h4 class="card-title mb-4">Delete Level</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('affiliate-levels.delete', Crypt::encrypt($level->id))}}">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <div class="form">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. </p>
                                                                                        <p>This will permanently delete this level.</p>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <div class="boding">
                                                                                            <button type="submit" class="form-btn">
                                                                                                I understand this consquences, Delete Level
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
        </div>
    </div>
</div>

<!-- Modal START -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h4 class="card-title mb-4">Add Level</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="Editt">
                    <form action="{{route('affiliate-levels.create')}}" method="POST">
                        @csrf
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <label for="level">Level</label>
                                    <select>
                                        <option></option>
                                    </select>
                                    <input type="number" name="level" class="input me" placeholder="Enter level e.g (1, 2 ...)" id="level" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="bonus_amount">Bonus Amount</label>
                                    <input type="number" name="bonus_amount" class="input me" placeholder="Enter bonus amount" id="bonus_amount" required />
                                </div>
                                <div class="text-end mt-2">
                                    <a href="#" class="text-decoration-none">
                                        <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                            Submit
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
@endsection
<!-- ============================================================== -->
<!-- Start right Content Ends -->
<!-- ============================================================== -->

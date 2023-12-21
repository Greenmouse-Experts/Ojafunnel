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
                    <div class="page-title-box d-sm-flex align-coupons-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Create Coupon</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-coupon"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-coupon active">Create Coupon</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-11">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">Create Coupon</h4>
                                    <p> All your store coupon in one place </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="#">
                                            <button type="submit" data-bs-toggle="modal" data-bs-target="#addCoupon">
                                                + Add Coupon
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            @if(App\Models\ExplainerContent::where('menu', 'Ecommerce')->exists())
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
            </div>
            <!-- store data information-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">All Stores</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Store Name</th>
                                            <th>Coupon Code</th>
                                            <th>Discount Percent</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(App\Models\StoreCoupon::latest()->where('user_id', Auth::user()->id)->count() > 0)
                                        @foreach (App\Models\StoreCoupon::latest()->where('user_id', Auth::user()->id)->get() as $coupon)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{App\Models\Store::latest()->find($coupon->store_id)->name}}</td>
                                            <td>{{$coupon->coupon_code}}</td>
                                            <td>{{$coupon->discount_percent}}</td>
                                            <td>{{$coupon->start_date}}</td>
                                            <td>{{$coupon->end_date}}</td>
                                            <td>
                                                @if($coupon->status == 'Active')
                                                <span class="badge badge-pill badge-soft-success text-success font-size-11">Active</span>
                                                @else
                                                <span class="badge badge-pill badge-soft-danger text-danger font-size-11">Expired</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" title="Edit Coupon" data-bs-target="#editStore-{{$coupon->id}}">Edit</a></li>
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" title="Delete  Coupon" data-bs-target="#deleteStore-{{$coupon->id}}">Delete</a></li>
                                                    </ul>
                                                </div>
                                                <div class="modal fade" id="deleteStore-{{$coupon->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 35%">
                                                        <div class="modal-content pb-3">

                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="Editt">
                                                                    <form action="{{route('user.store.delete.coupon', Crypt::encrypt($coupon->id))}}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <h3 style="text-align: center; margin-bottom: 15%;">Are you sure you want to delete this coupon</h3>
                                                                                <div class="row justify-content-between">
                                                                                    <div class="col-6">
                                                                                        <a href="#" class="text-decoration-none">
                                                                                            <button type="button" data-bs-dismiss="modal" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                Cancel
                                                                                            </button></a>
                                                                                    </div>
                                                                                    <div class="col-6 text-end">
                                                                                        <a href="#" class="text-decoration-none">
                                                                                            <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #BA0028">
                                                                                                Delete
                                                                                            </button>
                                                                                        </a>
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
                                                {{-- modal --}}
                                                <div class="modal fade" id="editStore-{{$coupon->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 45%">
                                                        <div class="modal-content pb-3">

                                                            <div class="modal-header border-bottom-0">
                                                                <h4 class="card-title mb-4">Update Coupon</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="Editt">
                                                                    <form action="{{route('user.store.update.coupon', Crypt::encrypt($coupon->id))}}" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="Name">Store Name</label>
                                                                                    <select name="store_id" required>
                                                                                        <option value="{{App\Models\Store::find($coupon->store_id)->id}}">{{App\Models\Store::find($coupon->store_id)->name}}</option>
                                                                                        <option value="">--Select Store--</option>
                                                                                        @foreach(App\Models\Store::latest()->where('user_id', Auth::user()->id)->get() as $store)
                                                                                        <option value="{{$store->id}}">{{$store->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="Name">Coupon Code</label>
                                                                                    <input type="text" name="coupon_code" placeholder="Enter coupon code" value="{{$coupon->coupon_code}}" required />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="Name">Discount Percent</label>
                                                                                    <input type="number" name="discount_percent" placeholder="Enter your discount percent" value="{{$coupon->discount_percent}}" required></input>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="Name">Start Date</label>
                                                                                    <input type="date" name="start_date" placeholder="Enter start date" value="{{$coupon->start_date}}" required />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="Name">End Date</label>
                                                                                    <input type="date" name="end_date" placeholder="Enter end date" value="{{$coupon->end_date}}" required />
                                                                                </div>
                                                                                <div class="text-end mt-2">
                                                                                    <a href="#" class="text-decoration-none">
                                                                                        <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                                            Update
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


                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
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
</div>

<!-- Modal -->
<div class="modal fade" id="addCoupon" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h4 class="card-title mb-4">Add Coupon</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="Editt">
                    <form action="{{route('user.store.create.coupon')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Store Name</label>
                                    <select name="store_id" required>
                                        <option value="">--Select Store--</option>
                                        @foreach(App\Models\Store::latest()->where('user_id', Auth::user()->id)->get() as $store)
                                        <option value="{{$store->id}}">{{$store->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Coupon Code</label>
                                    <input type="text" name="coupon_code" placeholder="Enter coupon code" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Discount Percent</label>
                                    <input type="number" name="discount_percent" placeholder="Enter your discount percent" required></input>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Start Date</label>
                                    <input type="date" name="start_date" placeholder="Enter start date" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">End Date</label>
                                    <input type="date" name="end_date" placeholder="Enter end date" required />
                                </div>
                                <div class="text-end mt-2">
                                    <a href="#" class="text-decoration-none">
                                        <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                            Save
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

@if(App\Models\ExplainerContent::where('menu', 'Ecommerce')->exists())
<!-- end modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="{{App\Models\ExplainerContent::where('menu', 'Ecommerce')->first()->video}}" title="Dummy Video For YouTube API Test" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
                                {{App\Models\ExplainerContent::where('menu', 'Ecommerce')->first()->text}}
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


@extends('layouts.admin-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">{{$plan->name}} Interval</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Plan Interval</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">{{$plan->name}} - Manage Plans</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500" style="display: flex; justify-content: flex-end;"> 
                                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                    Add Intervals
                                </button>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="col-md-12">
                <div class="card-body card">
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Price</th>
                                            <th>Type</th>
                                            <th>Currency</th>
                                            <th>Currency Sign</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\OjaPlanInterval::where('plan_id', $plan->id)->get() as $interval)
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                            <td>
                                                {{$interval->price}}
                                            </td>
                                            <td>
                                                {{$interval->type}}
                                            </td>
                                            <td>
                                                {{$interval->currency}}
                                            </td>
                                            <td>
                                                {{$interval->currency_sign}}
                                            </td>
                                            <td>{{$interval->created_at->toDayDateTimeString()}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#Edit-Update-{{$interval->id}}">Edit/Update</a></li>
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$interval->id}}">Delete</a></li>
                                                    </ul>
                                                </div>

                                                <!-- Modal VIEW START -->
                                                <div class="modal fade" id="Edit-Update-{{$interval->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <form method="POST" action="{{ route('admin.updatePlan.interval', Crypt::encrypt($interval->id))}}">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="col-lg-12">
                                                                                            <h4 class="card-title">Update Plan Interval</h4>
                                                                                            <div class="col-lg-12 mb-4">
                                                                                                <label for="">Price</label>
                                                                                                <input type="number" name="price" value="{{$interval->price}}"placeholder="Enter price" required />
                                                                                            </div>
                                                                                            <div class="col-lg-12 mb-4">
                                                                                                <label for="type">Type</label>
                                                                                                <select name="type">
                                                                                                    <option value="{{$interval->type}}">{{$interval->type}}</option>
                                                                                                    <option value="">-- Select Type --</option>
                                                                                                    <option value="monthly"> Monthly</option>
                                                                                                    <option value="yearly"> Yearly</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-12 mb-4">
                                                                                                <label for="currency">Currency</label>
                                                                                                <select name="currency" id="currency">
                                                                                                    <option value="{{$interval->currency}}">{{$interval->currency}}</option>
                                                                                                    <option value="" disabled="">-- Select Currency --</option>
                                                                                                    <option value="NGN">NGN - Naira</option>
                                                                                                    <option value="USD">USD - US Dollar</option>
                                                                                                    <option value="INR" >INR - Indian Rupee</option>
                                                                                                    <option value="EUR">EUR - Euro</option>
                                                                                                    <option value="PKR">PKR - Pakistani Rupee</option>
                                                                                                    <option value="AED">AED - Emirati Dirham</option>
                                                                                                    <option value="BRL">BRL - Brazilian Real</option>
                                                                                                    <option value="MYR">MYR - Malaysian Ringgit</option>
                                                                                                    <option value="SGD">SGD - Singapore Dollar</option>
                                                                                                    <option value="GBP">GBP - British pound sterling</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                                            Close
                                                                                        </button>
                                                                                        <button type="submit" class="btn" style="color: #714091; border: 1px solid #714091">
                                                                                            Update
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end VIEW modal -->
                                                <!-- Modal START -->
                                                <div class="modal fade" id="delete-{{$interval->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('admin.deletePlan.interval', Crypt::encrypt($interval->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete Contact</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. This will permanently delete this plan interval.</p>
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
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{route('admin.addPlan.interval', Crypt::encrypt($plan->id))}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="Editt">
                                <div class="form">
                                    <h4 class="card-title">Add Plan Interval</h4>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <label for="">Price</label>
                                            <input type="number" name="price" placeholder="Enter price" required />
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="type">Type</label>
                                            <select name="type">
                                                <option value="">-- Select Type --</option>
                                                <option value="monthly"> Monthly</option>
                                                <option value="yearly"> Yearly</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="currency">Currency</label>
                                            <select name="currency" id="currency">
                                                <option value="" disabled="">-- Select Currency --</option>
                                                <option value="NGN">NGN - Naira</option>
                                                <option value="USD">USD - US Dollar</option>
                                                <option value="INR" >INR - Indian Rupee</option>
                                                <option value="EUR">EUR - Euro</option>
                                                <option value="PKR">PKR - Pakistani Rupee</option>
                                                <option value="AED">AED - Emirati Dirham</option>
                                                <option value="BRL">BRL - Brazilian Real</option>
                                                <option value="MYR">MYR - Malaysian Ringgit</option>
                                                <option value="SGD">SGD - Singapore Dollar</option>
                                                <option value="GBP">GBP - British pound sterling</option>
                                            </select>
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
@endsection

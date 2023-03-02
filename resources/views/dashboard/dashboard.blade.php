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
            <div class="row">
                <div class="col-12">
                    <div class="start">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="start-main">
                                    <h1>Welcome, {{Auth::user()->first_name}} {{Auth::user()->last_name}} 👋</h1>
                                    <p>
                                        Start enjoying full control of your business all in
                                        one place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="click py-2">
                                    <button type="button" class="px-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        + Create
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-top-div">
                <div class="top-div">
                    <div class="Ensure row align-items-center">
                        <div class="col-8 font-500">
                            <h3>{{App\Models\User::where('referral_link', Auth::user()->id)->get()->count() ?? '0'}}</h3>
                            <p class="mb-0">Total Affiliate</p>
                        </div>
                        <div class="col-4 lead-img-div">
                            <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #edfbfc">
                                <img src="{{URL::asset('dash/assets/image/leads.png')}}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-div">
                    <div class="Ensure row align-items-center">
                        <div class="col-8 font-500">
                            @php
                            $store = \App\Models\Store::where('user_id', Auth::user()->id)->first();
                            @endphp
                            @if($store != null)
                            <h3>{{\App\Models\StoreProduct::where('store_id', $store->id)->count()}}</h3>
                            @else
                            <h3>0</h3>
                            @endif

                            <p class="mb-0">New Products</p>
                        </div>
                        <div class="col-4 lead-img-div">
                            <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #f5effc">
                                <img src="{{URL::asset('dash/assets/image/products.png')}}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-div">
                    <div class="Ensure row align-items-center">
                        <div class="col-8 font-500">
                            @if($store != null)
                            <h3>{{$store->count()}}</h3>
                            @else
                            <h3>0</h3>
                            @endif

                            <p class="mb-0">Total Store</p>
                        </div>
                        <div class="col-4 lead-img-div">
                            <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #f0fcef">
                                <img src="{{URL::asset('dash/assets/image/sales.png')}}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-div">
                    <div class="Ensure row align-items-center">
                        <div class="col-8 font-500">
                            @if($store != null)
                            <h3>{{\App\Models\StoreOrder::where('store_id', $store->id)->count()}}</h3>
                            @else
                            <h3>0</h3>
                            @endif
                            <p class="mb-0">Total Orders</p>
                        </div>
                        <div class="col-4 lead-img-div">
                            <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #fceff1">
                                <img src="{{URL::asset('dash/assets/image/bags.png')}}" alt="" width="28" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product & stores row-->
            <div class="products-stores-row mt-4">
                <div class="sales-analysis">
                    <div class="row mb-4">
                        <div class="col-6 font-500">
                            <h4>Sales Analysis</h4>
                        </div>
                        <div class="col-6 text-end">
                            <select name="duration" id="" disabled="disabled" class="px-2">
                                <option value="">weekly</option>
                                <option value="">yearly</option>
                            </select>
                        </div>
                    </div>
                    <div id="sales"></div>
                </div>
                <div class="campaign-div mt-1">
                    <div class="row mb-4">
                        <div class="col-6 font-500">
                            <h4>Email Campaign</h4>
                        </div>
                        <div class="col-6 text-end">
                            <select name="duration" id="" disabled="disabled" class="px-2">
                                <option value="">weekly</option>
                                <option value="">yearly</option>
                            </select>
                        </div>
                    </div>
                    <div id="emailAuto"></div>
                </div>
            </div>
            <!-- /product & stores -->
            <!-- end page title -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Latest Transaction</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th class="align-middle">Transaction No</th>
                                            <th class="align-middle">Date</th>
                                            <th class="align-middle">Amount</th>
                                            <th class="align-middle">Payment Status</th>
                                        </tr>
                                    </thead>
                                    @foreach(App\Models\Transaction::latest()->where('user_id', Auth::user()->id)->get()->take(5) as $transaction)
                                    <tbody>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$transaction->reference}}</a> </td>
                                            <td>
                                                {{$transaction->created_at->toDayDateTimeString()}}
                                            </td>
                                            <td>
                                                ₦{{number_format($transaction->amount, 2)}}
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-soft-success font-size-11">{{$transaction->status}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
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
<!-- end main content-->

<!-- Modal START -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content px-4 py-2">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Kindly Create...
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="dropover">
                            <div class="for-drop">
                                <i class="bi bi-1-circle"></i>
                            </div>
                            <h3>Create Pages</h3>
                            <p>
                                Design beautiful website, landing page or funnel with our
                                page editor.
                            </p>
                            <div class="con">
                                <a href="{{route('user.page.builder', Auth::user()->username)}}" class="text-purp">
                                    <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="dropover">
                            <div class="for-drop">
                                <i class="bi bi-2-circle"></i>
                            </div>
                            <h3>Create Store</h3>
                            <p>Create shops to sell your digital and physical products</p>
                            <div class="con">
                                <a href="{{route('user.my.store', Auth::user()->username)}}" class="text-purp">
                                    <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="dropover">
                            <div class="for-drop">
                                <i class="bi bi-3-circle"></i>
                            </div>
                            <h3>Create Emails</h3>
                            <p>
                                Create emails easily with our drag and drop editors readily
                                avaliable for you
                            </p>
                            <div class="con">
                                <a href="{{route('user.create.list', Auth::user()->username)}}" class="text-purp">
                                    <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="dropover">
                            <div class="for-drop">
                                <i class="bi bi-4-circle"></i>
                            </div>
                            <h3>Create Automations</h3>
                            <p>
                                Automate sms, chats and emails to reach subscribers at the
                                perfect time.
                            </p>
                            <div class="con">
                                <a href="{{route('user.automation.contact_list', Auth::user()->username)}}" class="text-purp">
                                    <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                </a>
                            </div>
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
@endsection

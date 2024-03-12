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
                        <h4 class="mb-sm-0 font-size-18">Payment Gateways</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Payment Gateways</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Payment Gateways</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>

            <div class="row">
                <!-- <div class="col-lg-2">
                </div> -->
                <div class="col-12">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b>
                                        Payment Gateways - Your integration starter kit
                                    </b>
                                </p>
                                <div class="col-lg-12">
                                    <div class="row">
                                        @foreach($gateways as $gateway)
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{ URL::asset($gateway->logo) }}" draggable="false" alt="{{ $gateway->name }}" width="100px">
                                                <span class="text-dark">{{ $gateway->name }} <span class="badge @if($gateway->status == 'Active') bg-success @else bg-danger @endif rounded-pill">{{$gateway->status}} </span></span>
                                            </div>

                                            <div class="zazu view-details-btn" data-gateway-id="{{ $gateway->id }}">
                                                <input type="radio" name="payment_gateways" value="{{ $gateway->name }}">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-2">
                </div> -->
            </div>

        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="paystack-modal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Paystack
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('updatePaymentGateway')}}">
                            @csrf
                            <input name="id" class="input id" hidden>
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" name="name" class="input name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>PAYSTACK PUBLIC KEY</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="8198fe19c3a7a410790b731e1e29fafa" name="PAYSTACK_PUBLIC_KEY" class="input PAYSTACK_PUBLIC_KEY" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>PAYSTACK SECRET KEY</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" name="PAYSTACK_SECRET_KEY" class="input PAYSTACK_SECRET_KEY" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>STATUS</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="status" class="input status">
                                                <option value="">-- Select Status --</option>
                                                <option value="Inactive">Inactive</option>
                                                <option value="Active">Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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
<!-- end modal -->

<!-- modal -->
<div class="modal fade" id="flutterwave-modal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Flutterwave
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('updatePaymentGateway')}}">
                            @csrf
                            <input name="id" class="input id" hidden>
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="ACe75dc47f94c7f33f7dd6128843c532ce" name="name" class="input name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>FLW PUBLIC KEY</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="8198fe19c3a7a410790b731e1e29fafa" name="FLW_PUBLIC_KEY" class="input FLW_PUBLIC_KEY" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>FLW SECRET KEY</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" name="FLW_SECRET_KEY" class="input FLW_SECRET_KEY" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>STATUS</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="status" class="input status">
                                                <option value="">-- Select Status --</option>
                                                <option value="Inactive">Inactive</option>
                                                <option value="Active">Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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
<!-- end modal -->

<!-- modal -->
<div class="modal fade" id="paypal-modal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Paypal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('updatePaymentGateway')}}">
                            @csrf
                            <input name="id" class="input id" hidden>
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Name</label>
                                     <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="ACe75dc47f94c7f33f7dd6128843c532ce" name="name" class="input name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>PAYPAL MODE</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Testing" name="PAYPAL_MODE" class="input PAYPAL_MODE" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>PAYPAL CURRENCY</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="NGN" name="PAYPAL_CURRENCY" class="input PAYPAL_CURRENCY" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>PAYPAL SANDBOX API CERTIFICATE</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="+15735333364" name="PAYPAL_SANDBOX_API_CERTIFICATE" class="input PAYPAL_SANDBOX_API_CERTIFICATE" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>PAYPAL CLIENT ID</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="+15735333364" name="PAYPAL_CLIENT_ID" class="input PAYPAL_CLIENT_ID" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>PAYPAL CLIENT SECRET</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="+15735333364" name="PAYPAL_CLIENT_SECRET" class="input PAYPAL_CLIENT_SECRET" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>STATUS</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="status" class="input status">
                                                <option value="">-- Select Status --</option>
                                                <option value="Inactive">Inactive</option>
                                                <option value="Active">Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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
<!-- end modal -->

<!-- modal -->
<div class="modal fade" id="stripe-modal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Stripe
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('updatePaymentGateway')}}">
                            @csrf
                            <input name="id" class="input id" hidden>
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="ACe75dc47f94c7f33f7dd6128843c532ce" name="name" class="input name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>STRIPE KEY</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="8198fe19c3a7a410790b731e1e29fafa" name="STRIPE_KEY" class="input STRIPE_KEY" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>STRIPE SECRET KEY</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" name="STRIPE_SECRET" class="input STRIPE_SECRET" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>STATUS</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="status" class="input status">
                                                <option value="">-- Select Status --</option>
                                                <option value="Inactive">Inactive</option>
                                                <option value="Active">Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </a>
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
<!-- end modal -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.view-details-btn', function () {
            var gatewayId = $(this).data('gateway-id');

            // Fetch and display job details (if needed)
            fetchGatewayDetails(gatewayId);
        });
    });

    function fetchGatewayDetails(gatewayId) {
        $.ajax({
            method: 'GET',
            url: '/admin/page/view/payment/gateway/' + gatewayId, // Replace with your actual backend endpoint
            success: function(response) {
                // Check the payment gateway and open the corresponding modal
                switch (response.name) {
                    case 'Paystack':
                        $('#paystack-modal input.id').val(response.id);
                        $('#paystack-modal input.name').val(response.name);
                        $('#paystack-modal input.PAYSTACK_PUBLIC_KEY').val(response.PAYSTACK_PUBLIC_KEY);
                        $('#paystack-modal input.PAYSTACK_SECRET_KEY').val(response.PAYSTACK_SECRET_KEY);
                        $('#paystack-modal select.status').val(response.status);

                        $('#paystack-modal').modal('show');
                        break;
                    case 'Flutterwave':
                        $('#flutterwave-modal input.id').val(response.id);
                        $('#flutterwave-modal .name').val(response.name);
                        $('#flutterwave-modal .FLW_PUBLIC_KEY').val(response.FLW_PUBLIC_KEY);
                        $('#flutterwave-modal .FLW_SECRET_KEY').val(response.FLW_SECRET_KEY);
                        $('#flutterwave-modal select.status').val(response.status);

                        $('#flutterwave-modal').modal('show');
                        break;
                    case 'Paypal':
                        $('#paypal-modal input.id').val(response.id);
                        $('#paypal-modal .name').val(response.name);
                        $('#paypal-modal .PAYPAL_MODE').val(response.PAYPAL_MODE);
                        $('#paypal-modal .PAYPAL_CURRENCY').val(response.PAYPAL_CURRENCY);
                        $('#paypal-modal .PAYPAL_SANDBOX_API_CERTIFICATE').val(response.PAYPAL_SANDBOX_API_CERTIFICATE);
                        $('#paypal-modal .PAYPAL_CLIENT_ID').val(response.PAYPAL_CLIENT_ID);
                        $('#paypal-modal .PAYPAL_CLIENT_SECRET').val(response.PAYPAL_CLIENT_SECRET);
                        $('#paypal-modal select.status').val(response.status);

                        $('#paypal-modal').modal('show');
                        break;
                    case 'Stripe':
                        $('#stripe-modal input.id').val(response.id);
                        $('#stripe-modal .name').val(response.name);
                        $('#stripe-modal .STRIPE_KEY').val(response.STRIPE_KEY);
                        $('#stripe-modal .STRIPE_SECRET').val(response.STRIPE_SECRET);
                        $('#stripe-modal select.status').val(response.status);

                        $('#stripe-modal').modal('show');
                        break;
                    default:
                        console.error("Unknown payment gateway:", response.name);
                }
            },
            error: function(error) {
                console.error("Error fetching payment details:", error);
            }
        });
    }
</script>
@endsection

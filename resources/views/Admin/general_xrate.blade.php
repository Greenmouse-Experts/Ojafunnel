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
                        <h4 class="mb-sm-0">Exchange Rate</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Exchange Rate</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Exchange Rate Listings</h4>
                            <p>
                                Browse through and view shops created by ojafunnel users.
                            </p>
                            <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">Set Rate</button>

                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row">
                <!-- table content of courses -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Exchange Rates List</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>From Currency</th>
                                            <th>Amount</th>
                                            <th>To Currency</th>
                                            <th>Amount</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $item)
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                            <td>
                                                {{$item->primary_currency}}
                                            </td>
                                            <td>
                                                @if($item->primary_currency == 'NGN')
                                                ₦{{$item->fx_amount}}
                                                @elseif($item->primary_currency == 'USD')
                                                ${{$item->fx_amount}}
                                                @elseif($item->primary_currency == 'GBP')
                                                £{{$item->fx_amount}}
                                                @else
                                                €{{$item->fx_amount}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$item->secondary_currency}}
                                            </td>
                                            <td>
                                                @if($item->secondary_currency == 'NGN')
                                                ₦{{$item->fiat}}
                                                @elseif($item->secondary_currency == 'USD')
                                                ${{$item->fiat}}
                                                @elseif($item->secondary_currency == 'GBP')
                                                £{{$item->fiat}}
                                                @else
                                                €{{$item->fiat}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$item->created_at->toDayDateTimeString()}}
                                            </td>
                                            <td>
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit-{{$item->id}}">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Store" class="material-icons-outlined">
                                                        Edit
                                                    </span>
                                                </button>
                                                <!-- Modal VIEW START -->
                                                <div class="modal fade" id="edit-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <div class="form">
                                                                            <form method="POST" action="{{route('admin.update.general.exchange.rate', Crypt::encrypt($item->id))}}">
                                                                                {{ csrf_field() }}
                                                                                <div class="form">
                                                                                    <p>
                                                                                        <b>
                                                                                            Update Exchange Rate
                                                                                        </b>
                                                                                    </p>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-5">
                                                                                            <label>Currency </label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="integer" placeholder="0.00" name="from_amount" value="{{$item->fx_amount}}" class="input" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-2">
                                                                                            <label>To</label>
                                                                                        </div>
                                                                                        <div class="col-lg-5">
                                                                                            <label>Currency</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="integer" placeholder="0.00" name="to_amount" value="{{$item->fiat}}" class="input" required>
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
                                                </div>
                                                <!-- end VIEW modal -->
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
<div class="modal fade" id="template" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{route('admin.add.general.exchange.rate')}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        Set Exchange Rate
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <label>Currency </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <select name="from_currency" class="from-currency">
                                                    <option value="">-- Select Currency --</option>
                                                    <option value="NGN">Naira</option>
                                                    <option value="USD">Dollar</option>
                                                    <option value="GBP">Pounds</option>
                                                    <option value="EUR">Euro</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-4 from-amount" style="display: none;">
                                                <input type="integer" placeholder="0.00" name="from_amount" value="1.00" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>To</label>
                                    </div>
                                    <div class="col-lg-5">
                                        <label>Currency</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <select name="to_currency" class="to-currency">
                                                    <option value="">-- Select Currency --</option>
                                                    <option value="NGN">Naira</option>
                                                    <option value="USD">Dollar</option>
                                                    <option value="GBP">Pounds</option>
                                                    <option value="EUR">Euro</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-4 to-amount" style="display: none;">
                                                <input type="integer" placeholder="0.00" name="to_amount" value="1.00" class="input" required>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Update "To" input when "From" currency changes
        $(".from-currency").change(function() {
            // updateConversion();
            showHideInput();
        });

        // Update "From" input when "To" currency changes
        $(".to-currency").change(function() {
            // updateConversion();
            showHideInput();
        });

        // Initial conversion
        // updateConversion();

        function updateConversion() {
            var fromCurrency = $(".from-currency").val();
            var toCurrency = $(".to-currency").val();
            var exchangeRate = 1.0; // You need to implement logic to fetch actual exchange rates

            // Assuming a simple conversion (1:1)
            var fromAmount = parseFloat($("[name='from_amount']").val());
            var toAmount = fromAmount * exchangeRate;

            $("[name='to_amount']").val(toAmount.toFixed(2));
        }

        function showHideInput() {
            var fromCurrency = $(".from-currency").val();
            var toCurrency = $(".to-currency").val();

            // Show or hide input based on selected currency
            $(".from-currency").change(function() {
                var selectedCurrency = $(this).val();
                if (selectedCurrency === 'NGN' || selectedCurrency === 'USD' || selectedCurrency === 'GBP' || selectedCurrency === 'EUR') {
                    $(".from-amount").show();
                } else {
                    $(".from-amount").hide();
                }
            });
            $(".to-currency").change(function() {
                var selectedCurrency = $(this).val();
                if (selectedCurrency === 'NGN' || selectedCurrency === 'USD' || selectedCurrency === 'GBP' || selectedCurrency === 'EUR') {
                    $(".to-amount").show();
                } else {
                    $(".to-amount").hide();
                }
            });
        }
    });
</script>
@endsection

@extends('layouts.dashboard-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">Bank Details </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Bank Information</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="py-2">
                                    <h4>Bank Details </h4>
                                    <p>
                                        All your bank details in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <p class="cash">Explainer Video Here</p> -->
                                        @if(App\Models\ExplainerContent::where('menu', 'Withdrawal')->exists())
                                        <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop13">
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
                                            <a href="#">
                                                <button type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                                    Add Bank Details
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Bank Details</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th class="align-middle">S/N</th>
                                            <th class="align-middle">Account Name</th>
                                            <th class="align-middle">Account Number</th>
                                            <th class="align-middle">Bank Name</th>
                                            <th class="align-middle">Bank Code</th>
                                            <th class="align-middle">Date Created</th>
                                            <th class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bank_details as $key => $bank)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <p class='text-bold-600'> {{$bank->account_name}} </p>
                                            </td>
                                            <td>
                                                {{$bank->account_number}}
                                            </td>
                                            <td>
                                                {{ $bank->bank_name }}
                                            </td>
                                            <td>
                                                {{ $bank->bank_code }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($bank->created_at)->isoFormat('llll') }}
                                            </td>
                                            <td>
                                                <a style="cursor: pointer;" class="btn btn-sm btn-soft-danger" data-bs-toggle="modal" data-bs-target="#delete-{{$bank->id}}">Delete</a>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="delete-{{$bank->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('user.delete.bank.details', Crypt::encrypt($bank->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete Bank Details</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. This will permanently delete.</p>
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
            <form method="post" action="{{route('user.add.bank.details')}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="Editt">
                                <div class="form">
                                    <h4 class="card-title">Add Bank Details</h4>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <label for="">Account Number</label>
                                            <input type="text" name="account_number" placeholder="Enter acount number" required />
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="bank">Bank</label>
                                            <select name="bank_code">
                                                <option value="">-- Select Bank --</option>
                                                <option value="120001"> 9mobile 9Payment Service Bank</option>
                                                <option value="801"> Abbey Mortgage Bank</option>
                                                <option value="51204"> Above Only MFB</option>
                                                <option value="51312"> Abulesoro MFB</option>
                                                <option value="044"> Access Bank</option>
                                                <option value="063"> Access Bank (Diamond)</option>
                                                <option value="602"> Accion Microfinance Bank</option>
                                                <option value="50036"> Ahmadu Bello University Microfinance Bank</option>
                                                <option value="120004"> Airtel Smartcash PSB</option>
                                                <option value="035A"> ALAT by WEMA</option>
                                                <option value="50926"> Amju Unique MFB</option>
                                                <option value="50083"> Aramoko MFB</option>
                                                <option value="401"> ASO Savings and Loans</option>
                                                <option value="MFB50094"> Astrapolaris MFB LTD</option>
                                                <option value="51229"> Bainescredit MFB</option>
                                                <option value="50117"> Banc Corp Microfinance Bank</option>
                                                <option value="50931"> Bowen Microfinance Bank</option>
                                                <option value="565"> Carbon</option>
                                                <option value="50823"> CEMCS Microfinance Bank</option>
                                                <option value="50171"> Chanelle Microfinance Bank Limited</option>
                                                <option value="023"> Citibank Nigeria</option>
                                                <option value="50204"> Corestep MFB</option>
                                                <option value="559"> Coronation Merchant Bank</option>
                                                <option value="51297"> Crescent MFB</option>
                                                <option value="50162"> Dot Microfinance Bank</option>
                                                <option value="050"> Ecobank Nigeria</option>
                                                <option value="50263"> Ekimogun MFB</option>
                                                <option value="098"> Ekondo Microfinance Bank</option>
                                                <option value="50126"> Eyowo</option>
                                                <option value="51318"> Fairmoney Microfinance Bank</option>
                                                <option value="070"> Fidelity Bank</option>
                                                <option value="51314"> Firmus MFB</option>
                                                <option value="011"> First Bank of Nigeria</option>
                                                <option value="214"> First City Monument Bank</option>
                                                <option value="107"> FirstTrust Mortgage Bank Nigeria</option>
                                                <option value="50315"> FLOURISH MFB</option>
                                                <option value="501"> FSDH Merchant Bank Limited</option>
                                                <option value="812"> Gateway Mortgage Bank LTD</option>
                                                <option value="00103"> Globus Bank</option>
                                                <option value="100022"> GoMoney</option>
                                                <option value="50739"> Goodnews Microfinance Bank</option>
                                                <option value="562"> Greenwich Merchant Bank</option>
                                                <option value="058"> Guaranty Trust Bank</option>
                                                <option value="51251"> Hackman Microfinance Bank</option>
                                                <option value="50383"> Hasal Microfinance Bank</option>
                                                <option value="030"> Heritage Bank</option>
                                                <option value="120002"> HopePSB</option>
                                                <option value="51244"> Ibile Microfinance Bank</option>
                                                <option value="50439"> Ikoyi Osun MFB</option>
                                                <option value="50442"> Ilaro Poly Microfinance Bank</option>
                                                <option value="50457"> Infinity MFB</option>
                                                <option value="301"> Jaiz Bank</option>
                                                <option value="50502"> Kadpoly MFB</option>
                                                <option value="082"> Keystone Bank</option>
                                                <option value="50200"> Kredi Money MFB LTD</option>
                                                <option value="50211"> Kuda Bank</option>
                                                <option value="90052"> Lagos Building Investment Company Plc.</option>
                                                <option value="50549"> Links MFB</option>
                                                <option value="031"> Living Trust Mortgage Bank</option>
                                                <option value="303"> Lotus Bank</option>
                                                <option value="50563"> Mayfair MFB</option>
                                                <option value="50304"> Mint MFB</option>
                                                <option value="120003"> MTN Momo PSB</option>
                                                <option value="100002"> Paga</option>
                                                <option value="999991"> PalmPay</option>
                                                <option value="104"> Parallex Bank</option>
                                                <option value="311"> Parkway - ReadyCash</option>
                                                <option value="999992"> Paycom</option>
                                                <option value="51146"> Personal Trust MFB</option>
                                                <option value="50746"> Petra Mircofinance Bank Plc</option>
                                                <option value="076"> Polaris Bank</option>
                                                <option value="50864"> Polyunwana MFB</option>
                                                <option value="105"> PremiumTrust Bank</option>
                                                <option value="101"> Providus Bank</option>
                                                <option value="51293"> QuickFund MFB</option>
                                                <option value="502"> Rand Merchant Bank</option>
                                                <option value="90067"> Refuge Mortgage Bank</option>
                                                <option value="50767"> ROCKSHIELD MICROFINANCE BANK</option>
                                                <option value="125"> Rubies MFB</option>
                                                <option value="51113"> Safe Haven MFB</option>
                                                <option value="951113"> Safe Haven Microfinance Bank Limited</option>
                                                <option value="50582"> Shield MFB</option>
                                                <option value="50800"> Solid Rock MFB</option>
                                                <option value="51310"> Sparkle Microfinance Bank</option>
                                                <option value="221"> Stanbic IBTC Bank</option>
                                                <option value="068"> Standard Chartered Bank</option>
                                                <option value="51253"> Stellas MFB</option>
                                                <option value="232"> Sterling Bank</option>
                                                <option value="100"> Suntrust Bank</option>
                                                <option value="50968"> Supreme MFB</option>
                                                <option value="302"> TAJ Bank</option>
                                                <option value="090560"> Tanadi Microfinance Bank</option>
                                                <option value="51269"> Tangerine Money</option>
                                                <option value="51211"> TCF MFB</option>
                                                <option value="102"> Titan Bank</option>
                                                <option value="100039"> Titan Paystack</option>
                                                <option value="MFB51322"> Uhuru MFB</option>
                                                <option value="50870"> Unaab Microfinance Bank Limited</option>
                                                <option value="50871"> Unical MFB</option>
                                                <option value="51316"> Unilag Microfinance Bank</option>
                                                <option value="032"> Union Bank of Nigeria</option>
                                                <option value="033"> United Bank For Africa</option>
                                                <option value="215"> Unity Bank</option>
                                                <option value="566"> VFD Microfinance Bank Limited</option>
                                                <option value="035"> Wema Bank</option>
                                                <option value="057"> Zenith Bank</option>
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
@if(App\Models\ExplainerContent::where('menu', 'Withdrawal')->exists())
<div class="modal fade" id="staticBackdrop13" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="{{App\Models\ExplainerContent::where('menu', 'Withdrawal')->first()->video}}" title="Explainer Video" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
                                {{App\Models\ExplainerContent::where('menu', 'Withdrawal')->first()->text}}
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

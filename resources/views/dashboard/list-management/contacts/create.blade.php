@extends('layouts.dashboard-frontend')

@section('page-content')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
<style>
    .hide {
        display: none !important;
    }
    #valid-msg,  #confirmvalid-msg{
        color: green !important;
        font-size: 12px !important;
    }
    #error-msg, #confirmerror-msg, #emailError, #confirmEmailError{
        color: red !important;
        font-size: 12px !important;
    }
</style>
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
                        <h4 class="mb-sm-0 font-size-18">List Management Contact</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Create new contact list</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4>List Management Contact</h4>
                                    <p>
                                        Create new contact for {{$list->name}} list
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body" style="padding: 4rem;">
                        <form method="post" action="{{ route('user.create.contact', Crypt::encrypt($list->id)) }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control"  value="{{old('name')}}" placeholder="Enter name" required />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Email Address</label>
                                    <input type="email" name="email" class="form-control"  value="{{old('email')}}" placeholder="Enter email" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Address 1</label>
                                    <textarea type="text" name="address_1" class="form-control" value="{{old('address_1')}}" placeholder="Enter address one"></textarea>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Address 2</label>
                                    <textarea type="text" name="address_2" class="form-control" value="{{old('address_2')}}" placeholder="Enter address two"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Country</label>
                                <select class="form-control" name="country">
                                    <optgroup>-- Select Country --</optgroup>
                                    @foreach(App\Models\Country::get() as $country)
                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">State</label>
                                    <input type="text" name="state" class="form-control" value="{{old('state')}}" placeholder="Enter State" />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Zip</label>
                                    <input type="text" name="zip" class="form-control" value="{{old('zip')}}" placeholder="Enter Zip" />
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{old('phone')}}" id="phonee" placeholder="Enter Phone Number" />
                                <span id="valid-msg" class="help-block hide">✓ Valid</span>
					            <span id="error-msg" class="help-block hide"></span>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control"  value="{{old('date_of_birth')}}" placeholder="Enter Date of Birth" />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Anniversary Date</label>
                                    <input type="date" name="anniv_date" class="form-control"  value="{{old('anniv_date')}}" placeholder="Enter Anniversary Date" />
                                </div>
                            </div>
                            <!-- <div class="col-lg-12 mb-4">
                                <label for="">Subscribe</label>
                                <p class="text-xs text-gray-500">
                                    Will be sent emails
                                </p>
                                <input type="radio" id="subscribe" name="subscribe" value="1"/> Yes &nbsp;
                                <input type="radio" id="subscribe" name="subscribe" value="0"/> No
                            </div> -->
                            <div class="text-end mt-2">
                                <a href="{{route('user.view.list', Crypt::encrypt($list->id))}}">
                                    <button type="button" class="btn px-4 py-1 btn-danger">
                                        Cancel
                                    </button>
                                </a>
                                <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#phonee").intlTelInput({
            // preferredCountries: ["us", "ca"],
            separateDialCode: true,
            initialCountry: ""
        }).on('countrychange', function(e, countryData) {
            $("#phonee").val('+' + ($("#phonee").intlTelInput("getSelectedCountryData").dialCode));
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script>
    const input = document.querySelector("#phonee");
    const errorMsg = document.querySelector("#error-msg");
    const validMsg = document.querySelector("#valid-msg");
    let validationTimeout;

    // here, the index maps to the error code returned from getValidationError - see readme
    const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    // initialise plugin
    const iti = window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
        initialCountry: "auto", // Automatically select the user's country
        separateDialCode: true, // Add a space between the country code and the phone number
        placeholderNumberType: "MOBILE", // Set the placeholder to match the user's mobile number format
        nationalMode: false, // Do not automatically switch to national mode
    });

    const updateMessages = () => {
        clearTimeout(validationTimeout);
        reset();
        if (input.value.trim()) {
            validationTimeout = setTimeout(() => {
                if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");
                } else {
                    input.classList.add("error");
                    const errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }, 300); // Adjust the delay time as needed (in milliseconds)
        }
    };

    const reset = () => {
        input.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        validMsg.classList.add("hide");
    };

    // on input: validate with slight delay
    input.addEventListener('input', updateMessages);

    // on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);

    // Set the initial value of the input to include the selected country code
    input.addEventListener('countrychange', () => {
        const countryCodeValue = iti.getSelectedCountryData().dialCode;
        input.value = `+${countryCodeValue}`;
    });
</script>
<style>
    .iti {
        display: block !important;
    }

    .iti__country-list {
        z-index: 2000 !important;
    }

    .iti__country-name {
        color: #000 !important;
    }

    .iti__dial-code {
        color: #000 !important;
    }
</style>
@endsection

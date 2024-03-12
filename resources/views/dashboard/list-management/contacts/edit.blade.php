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
                        <h4 class="mb-sm-0 font-size-18">Edit Contact List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Edit Contact List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">Edit Contact List</h4>
                                    <p>
                                        Edit your contact list
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
                        <form method="post" action="{{ route('user.update.contact', Crypt::encrypt($contact->id)) }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control"  value="{{$contact->name}}" placeholder="Enter name" required />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Email Address</label>
                                    <input type="email" name="email" class="form-control"  value="{{$contact->email}}" placeholder="Enter email" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Address 1</label>
                                    <textarea type="text" name="address_1" class="form-control" value="{{$contact->address_1}}" placeholder="Enter address one">{{$contact->address_1}}</textarea>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Address 2</label>
                                    <textarea type="text" name="address_2" class="form-control" value="{{$contact->address_2}}" placeholder="Enter address two">{{$contact->address_2}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Country</label>
                                <select class="form-control" name="country">
                                <option value="{{$contact->country}}">{{$contact->country}}</option>
                                    <optgroup>-- Select Country --</optgroup>
                                    @foreach(App\Models\Country::get() as $country)
                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">State</label>
                                    <input type="text" name="state" class="form-control"  value="{{$contact->state}}" placeholder="Enter State" />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Zip</label>
                                    <input type="text" name="zip" class="form-control"  value="{{$contact->zip}}" placeholder="Enter Zip" />
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control" id="phonee" value="{{$contact->phone}}" placeholder="Enter Phone Number" />
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Date of Birth</label>

                                    @php $dob = $contact->date_of_birth !== null ? date("Y-m-d", strtotime($contact->date_of_birth)) : "" @endphp
                                    <input type="date" name="date_of_birth" class="form-control"  value="{{$dob}}" placeholder="Enter Date of Birth" />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Anniversary Date</label>
                                    @php $anni = $contact->anniv_date !== null ? date("Y-m-d", strtotime($contact->anniv_date)) : date("Y-m-d", time()) @endphp
                                    <input type="date" name="anniv_date" class="form-control"  value="{{$anni}}" placeholder="Enter Anniversary Date" />
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Add Tags</label>
                                <textarea type="text" name="tags" class="form-control" placeholder="Enter tags separated with comma" style="height:7em!important">{{$contact->tags}}</textarea>
                            </div>
                            <!-- <div class="col-lg-12 mb-4">
                                <label for="">Subscribe</label>
                                <p class="text-xs text-gray-500">
                                    Will be sent emails
                                </p>
                                <input type="radio" id="subscribe" name="subscribe" value="1" {{$contact->subscribe == 1 ? 'checked' : ''}}/> Yes &nbsp;
                                <input type="radio" id="subscribe" name="subscribe" value="0" {{$contact->subscribe == 0 ? 'checked' : ''}}/> No
                            </div> -->
                            <div class="text-end mt-2">
                                <a href="{{route('user.view.list', Crypt::encrypt($contact->list_management_id))}}">
                                    <button type="button" class="btn px-4 py-1 btn-danger">
                                        Cancel
                                    </button>
                                </a>
                                <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
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
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script>
    const input = document.querySelector("#phonee");
    const errorMsg = document.querySelector("#error-msg");
    const validMsg = document.querySelector("#valid-msg");
    let validationTimeout;

    // here, the index maps to the error code returned from getValidationError - see readme
    const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    // initialise plugin with Nigeria as the default country
    const iti = window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
        separateDialCode: true, // Add a space between the country code and the phone number
        placeholderNumberType: "MOBILE", // Set the placeholder to match the user's mobile number format
        nationalMode: false, // Do not automatically switch to national mode
        initialCountry: "us" // Set Nigeria as the default country
    });

    const updateMessages = () => {
        clearTimeout(validationTimeout);
        reset();
        if (input.value.trim()) {
            validationTimeout = setTimeout(() => {
                if (input.value.startsWith('+') && iti.isValidNumber()) {
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

    // Set the initial value of the input to include the selected country code only if input is empty
    window.addEventListener('DOMContentLoaded', () => {
        if (input.value.trim() === '') {
            const countryCodeValue = iti.getSelectedCountryData().dialCode;
            input.value = `+${countryCodeValue}`;
        }
    });

    // on input: validate with slight delay
    input.addEventListener('input', updateMessages);

    // on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);

    // Update input value on country change
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
</style>
@endsection

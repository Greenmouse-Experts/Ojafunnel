<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{URL::asset('assets/images/Logo-fav.png')}}" type="image/x-icon">
    <title>{{config('app.name')}} | Sign Up</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <!-- <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert-timeout").fadeTo(500, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 8000);
    </script> -->
</head>

<body id="lent">
    <!-- Alerts  Start-->
    <div style="position: fixed; top: 10px; right: 20px; z-index: 100000; width: auto;">
        @include('layouts.alert')
    </div>
    <!-- Alerts End -->
    <div id='loader'>
        <div class="loader-inner">
            <div class="loading-content"></div>
        </div>
    </div>
    <!-- Sign Up  -->
    <section class="register">
        <div class="container-fuild">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="sign">
                        <form class="sign-div" action="{{ route('register')}}" method="post">
                            @csrf
                            <a href="{{route('index')}}">
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" draggable="false" alt="OjaFunnel Logo">
                            </a>
                            <h4>
                                Create an account and get started today
                            </h4>
                            <div class="row">
                                <!--First Name-->
                                <div class="col-lg-12">
                                    <label class="name">First Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <i class="bi bi-person"></i>
                                            <input type="text" placeholder="Enter First Name" name="first_name" class="input" value="{{ old('first_name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <!--Last Name-->
                                <div class="col-lg-12">
                                    <label class="name">Last Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <i class="bi bi-person"></i>
                                            <input type="text" placeholder="Enter Last Name" name="last_name" class="input" value="{{ old('last_name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <!--User Name-->
                                <div class="col-lg-12">
                                    <label class="username">Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <i class="bi bi-person"></i>
                                            <input type="text" id="username" placeholder="Enter User Name" name="username" value="{{ old('username') }}" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <!--Email-->
                                <div class="col-lg-12">
                                    <label>Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <i class="bi bi-envelope"></i>
                                            <input type="email" placeholder="Enter your email address" name="email" value="{{ old('email') }}" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <!--Phone Number-->
                                <div class="col-lg-12">
                                    <label>Phone Number</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <i class="bi bi-phone"></i>
                                            <input type="tel" placeholder="Enter your Phone Number" name="phone_number" id="phonee" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <!--Phone Number-->
                                <div class="col-lg-12">
                                    <label>Referral Code (Optional)</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <i class="bi bi-phone"></i>
                                            @if ($referrer_id == true)
                                            <input type="text" class="input" name="referral_link" class="input" placeholder="{{$referrer_id}}" value="{{$referrer_id}}" readonly autofocus>
                                            @else
                                            <input type="text" class="input" placeholder="Enter Referral Code (if any)" name="referral_link" autocomplete="referral_link" autofocus>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            @include('helpers.form_control', [
                                            'type' => 'select',
                                            'class' => 'input',
                                            'name' => 'timezone',
                                            'value' => $customer->timezone,
                                            'options' => $tz,
                                            'include_blank' => trans('messages.choose'),
                                            'rules' => $user->registerRules()
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            @include('helpers.form_control', [
                                            'type' => 'select',
                                            'name' => 'language_id',
                                            'label' => trans('messages.language'),
                                            'value' => $customer->language_id,
                                            'options' => App\Models\Language::getSelectOptions(),
                                            'include_blank' => trans('messages.choose'),
                                            'rules' => $user->registerRules()
                                            ])
                                        </div>
                                    </div>
                                </div> -->
                                <!--Password-->
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <i class="bi bi-file-lock"></i>
                                            <input type="password" placeholder="Enter your prefered password" name="password" class="input" required>
                                            <i class="toggle-password fa fa-fw fa-eye-slash" title="Toggle to show/hide password"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Confirm Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <i class="bi bi-file-lock"></i>
                                            <input type="password" placeholder="Enter your prefered password" name="password_confirmation" class="input" required>
                                            <i class="toggle-password fa fa-fw fa-eye-slash" title="Toggle to show/hide password"></i>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    By clicking Sign Up, you agree to the terms and conditions
                                </p>
                                <div class="col-md-12 mb-2">
                                    <button type="submit">Sign Up </button>
                                </div>
                                <!--Message-->
                                <p style="text-align: center;">Already have an account ? <a href="{{route('login')}}">Login</a> </p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3">
                    <!-- <div class="http">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1662630837/OjaFunnel-Images/signup-image_ecquqt.png" draggable="false">
                        </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Sign Up Ends -->

    <script>
        $(function() {
            $("form").submit(function() {
                $('#loader').show();
            });
        });

        // Script for Show/Hide Password
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(document).ready(function() {
            $("#phonee").intlTelInput({
                // preferredCountries: ["us", "ca"],
                preferredCountries: ["ng"],
                separateDialCode: true,
                initialCountry: ""
            }).on('countrychange', function(e, countryData) {
                // $("#phonee").val('+' + ($("#phonee").intlTelInput("getSelectedCountryData").dialCode));
                // $("#phonee").val('+234');
                $("#phonee").val('')
            });
        });
    </script>
    <script>
        var input = document.querySelector("#phonee");
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
        window.addEventListener("load", function() {

            errorMsg = document.querySelector("#error-msg"),
                validMsg = document.querySelector("#valid-msg");
            var iti = window.intlTelInput(input, {
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.2/build/js/utils.js"
            });
            window.intlTelInput(input, {
                geoIpLookup: function(callback) {
                    $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";

                        callback(countryCode);
                    });
                },
                initialCountry: "auto",
                placeholderNumberType: "MOBILE",
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.2/build/js/utils.js",
            });
            $(validMsg).addClass("hide");
            input.addEventListener('blur', function() {
                reset();
                if (input.value.trim()) {
                    if (iti.isValidNumber()) {
                        validMsg.classList.remove("hide");
                    } else {
                        input.classList.add("error");
                        var errorCode = iti.getValidationError();
                        errorMsg.innerHTML = errorMap[errorCode];
                        errorMsg.classList.remove("hide");
                    }
                }
            });

            input.addEventListener('change', reset);
            input.addEventListener('keyup', reset);
        });


        var reset = function() {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };
        $(document).ready(function() {
            // $("#phonee").val("+234");
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
</body>

</html>

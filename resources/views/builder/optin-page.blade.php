
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"><style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style><style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style><style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style><style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <link rel="shortcut icon" href="{{URL::asset('dash/assets/images/Logo-fav.png')}}" />
        <meta name="author" content="">
        <title>$title</title>
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
        <style>
            html, body
            {
                width:100%;
                height:100%;
            }

            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                background: #000;
                min-height: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .footer p {
                color: #fff;
                margin: 5px 0 5px 0;
                font-size: 0.6rem;
                font-weight: 300;
            }
            .success-message {
                color: green !important;
                font-size: 12px !important;
            }
            .font-red-mint {
                color: red !important;
                font-size: 12px;
            }
            .alert-success {
                color: green !important;
                font-size: 14px !important;
            }
            .text-red, .alert-danger {
                color: red !important;
            }
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
        <style id="vvvebjs-styles"></style>
    </head>

    <body data-new-gr-c-s-check-loaded="14.1034.0" data-gr-ext-installed="" data-new-gr-c-s-loaded="14.1116.0">
        <!-- Page Content -->
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-12 text-center">
                <h1 class="mt-5"> Ojafunnel Opt-In Page</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>We are giving out 30% discount on out top demanding courses.</h3>
                    <p class="lead">Please fill out the Opt-In form to receive notification on the discount.</p>
                </div>
            </div>

            <div>
                <div class="col-lg-6" style="margin: 0 auto;">
                    <form method="POST" action="$action">
                        <div class="form-group">
                            <lable>Full name</lable>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group mt-3">
                            <lable>Email addres</lable>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group mt-3">
                            <lable>Phone number</lable>
                            <input type="tel" id="phone" class="form-control" name="phone" required>
                            <span id="valid-msg" class="help-block hide">✓ Valid</span>
					        <span id="error-msg" class="help-block hide"></span>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <footer class="footer">
            <p>Built with <a href="https://ojafunnel.com" class="text-white">Ojafunnel</a></p>
        </footer>

        <grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
        <script>
            const input = document.querySelector("#phone");
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

            .iti__country-name {
                color: #000 !important;
            }

            .iti__dial-code {
                color: #000 !important;
            }
        </style>
    </body>
</html>

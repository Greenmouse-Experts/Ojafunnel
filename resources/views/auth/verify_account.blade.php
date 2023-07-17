<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{URL::asset('assets/images/Logo-fav.png')}}" type="image/x-icon">
    <title>{{config('app.name')}} | Verify Account</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert-timeout").fadeTo(500, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 8000);
    </script>
</head>

<body>
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
    <!-- Fogotten -->
    <section class="Fogotten">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="btn-div">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sidelist">
                                    <a href="{{route('index')}}">
                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" draggable="false" alt="">
                                    </a>
                                    <h4 class="mb-0 mt-5">Verify Your Account</h4>
                                    <p class="pt-1 opacity-50">Before proceeding, please check your email for a verification code.</p>
                                    <p class="pt-1 opacity-50">If you don't hear from us within the next few minutes, please make sure to check your spam folder or use a different email address</p>
                                    <form class="sign-div" method="POST" action="{{ route('email.confirmation', Crypt::encrypt($user->id))}}">
                                    @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Code</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <input type="text" placeholder="Enter Code" name="code" class="input" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <button type="submit">Verify Account</button>
                                            </div>
                                        </div> 
                                    </form>
                                    <div class="text-center">
                                        <form method="POST" action="{{ route('email.verify.resend', Crypt::encrypt($user->email)) }}">
                                            @csrf
                                            <div class="login-input continue">
                                                {{ __('If you did not receive the email') }},
                                                <button style="border: none; background: transparent; color: #EA5B0C;"type="submit">{{ __('Click here to request another') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section>
    <!-- login Ends -->
    <script>
        $(function() {
            $("form").submit(function() {
                $('#loader').show();
            });
        });
    </script>
</body>
</html>
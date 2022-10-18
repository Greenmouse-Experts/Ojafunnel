<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{URL::asset('assets/images/Logo-fav.png')}}" type="image/x-icon">
        <title>Sign Up | OjaFunnel </title>
        <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            window.setTimeout(function() {
                $(".alert-timeout").fadeTo(500, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 8000);
        </script>
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
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4" >
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
                                    <!--Name-->
                                    <div class="col-lg-12">
                                        <label class="name">Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <i class="bi bi-person"></i>
                                                <input type="text" value="{{ old('subdomain') }}" placeholder="Enter a sub - domain name" name="subdomain" class="input" required>
                                                <p>
                                                    Please enter a sub - domain in the above field. E.g ayo<br>
                                                    <span style="color:#f00;">NB:</span> It must be a signle word without white space
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Email-->
                                    <div class="col-lg-12">
                                        <label>Email</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <i class="bi bi-envelope"></i>
                                                <input type="email" value="{{old('email')}}" placeholder="Enter your email address" name="email" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Phone Number-->
                                    <div class="col-lg-12">
                                        <label>Phone Number</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <i class="bi bi-phone"></i>
                                                <input type="tel" value="{{old('phone')}}" placeholder="Enter your Phone Number" name="phone" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Phone Number-->
                                    <div class="col-lg-12">
                                        <label>Referral Code</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <i class="bi bi-phone"></i>
                                                <input type="text" value="{{old('referral_code')}}" placeholder="Enter referral code" name="referral_code" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <!--Password-->
                                    <div class="col-lg-12">
                                        <label>Password</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <i class="bi bi-file-lock"></i>
                                                <input type="password" placeholder="Enter your prefered password" name="password" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Confirm Password</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <i class="bi bi-file-lock"></i>
                                                <input type="password" placeholder="Enter your prefered password" name="password_confirmation" class="input" required>
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
                                    <p style="text-align: center;">Already have an account ?  <a href="{{route('login')}}">Login</a> </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-6">
                        <div class="http">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1662630837/OjaFunnel-Images/signup-image_ecquqt.png" draggable="false">
                        </div>
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
        </script>
    </body>
</html>
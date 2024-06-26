<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{URL::asset('assets/images/Logo-fav.png')}}" type="image/x-icon">
    <title>{{config('app.name')}} | Reset Password </title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <h4>
                                        Reset Password
                                    </h4>
                                    <p>
                                        To complete the reset password process, Please enter the code sent to the email address
                                        <code>{{$email}}</code>
                                    </p>
                                    <form class="sign-div"  method="POST" action="{{ route('user.update.password')}}">
                                        @csrf
                                        <div class="row">
                                            <!--Email-->
                                            <div class="col-lg-12">
                                                <label>Code</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <input type="text" placeholder="Enter your Code" name="code" class="input" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                    <label>New Password</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <input type="password" placeholder="Enter your new password" name="password" class="input" required>
                                                            <i class="toggle-password fa fa-fw fa-eye-slash" title="Toggle to show/hide password"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label>Confirm New Password</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <input type="password" placeholder="Enter your confirm new password" name="password_confirmation" class="input" required>
                                                            <i class="toggle-password fa fa-fw fa-eye-slash" title="Toggle to show/hide password"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="col-md-12 mb-2">
                                                <button type="submit">
                                                    Reset Password
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
</body>
<script>
    $(function() {
        $("form").submit(function() {
            $('#loader').show();
        });
    });
</script>
<script>
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
    </script>

</html>
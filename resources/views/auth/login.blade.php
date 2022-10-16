<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{URL::asset('assets/images/Logo-fav.png')}}" type="image/x-icon">
        <title>Login | {{config('app.name')}} </title>
        <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    </head>
    <body>
        <!-- login -->
            <section class="login">
                <div class="container-fuild">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-div">
                                        <div class="sidelist">
                                            <a href="{{route('index')}}">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" draggable="false" alt="">
                                            </a>
                                            <h4></h4>
                                            <form class="sign-div">
                                                <div class="row">
                                                    <!--Email-->
                                                    <div class="col-lg-12">
                                                        <label>Email or username</label>
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <i class="bi bi-envelope"></i>
                                                                <input type="email" placeholder="Enter your email address" name="email" class="input" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Password-->
                                                    <div class="col-lg-12">
                                                        <label>Password</label>
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <i class="bi bi-file-lock"></i>
                                                                <input type="password" placeholder="Enter your prefered password" name="phone" class="input" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        <a href="{{route('forgot')}}">
                                                            Forgot Password ?
                                                        </a>
                                                    </p>
                                                    <div class="col-md-12 mb-2">
                                                        <button type="submit">
                                                            <a href="{{route('user.dashboard')}}">
                                                            Log in
                                                            </a>
                                                        </button>
                                                    </div>
                                                    <p class="have">
                                                        Don't have an account ?
                                                        <a href="{{route('signup')}}">
                                                        Sign Up
                                                        </a>
                                                    </p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="btn-divv">
                                <div class="portlog">
                                    <a href="index">
                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1662630837/OjaFunnel-Images/signup-image_ecquqt.png" draggable="false">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- login Ends -->
    </body>
</html>
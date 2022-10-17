<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/images/Logo-fav.png" type="image/x-icon">
        <title> Home | {{config('app.name')}} </title>
        <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    </head>
    <body>        
        <!-- Header -->
            @includeIf('layouts.frontend-header')
        <!-- Header Ends -->
        
        <!-- Page-Content -->
            @yield('page-content')
        <!-- Page-Content Ends -->

        <!-- Footer -->
            @includeIf('layouts.frontend-footer')
        <!-- Footer Ends -->         

        <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
        <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('assets/js/main.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
         $(".menu-list .menu-page .text-btn a").mouseover( function() { // Changes the .image-holder's img src to the src defined in .list a's data attribute.
        var value=$(this).attr('data-src');
        $(".menu-image-holder img").attr("src", value);
            })
                $(".menu-list .menu-page .text-btn a").mouseout( function() {
                $( '.menu-image-holder img' ).attr("src","https://res.cloudinary.com/greenmouse-tech/image/upload/v1660737789/OjaFunnel-Images/Stripe_bfhh6m_yk9kmo-removebg-preview_jih215.png");
                });
        </script>
    </body>
</html>
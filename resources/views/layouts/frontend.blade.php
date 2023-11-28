<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{URL::asset('assets/images/Logo-fav.png')}}" type="image/x-icon">
    <title> Home | {{config('app.name')}} </title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    {!! NoCaptcha::renderJs() !!}
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
    <!-- Header -->
    @includeIf('layouts.frontend-header')
    <!-- Header Ends -->

    <!-- Page-Content -->
    @yield('page-content')
    <!-- Page-Content Ends -->

    <!-- Footer -->
    @includeIf('layouts.frontend-footer')
    <!-- Footer Ends -->
    <script>
        $(function() {
            $("form").submit(function() {
                $('#loader').show();
            });
        });
    </script>
    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/main.js')}}"></script>
    <script>
        $(".menu-list .menu-page .text-btn a").mouseover(function() { // Changes the .image-holder's img src to the src defined in .list a's data attribute.
            var value = $(this).attr('data-src');
            $(".menu-image-holder img").attr("src", value);
        })
        $(".menu-list .menu-page .text-btn a").mouseout(function() {
            $('.menu-image-holder img').attr("src", "https://res.cloudinary.com/greenmouse-tech/image/upload/v1660737789/OjaFunnel-Images/Stripe_bfhh6m_yk9kmo-removebg-preview_jih215.png");
        });

        //
        // pricing switch button
        let pricingIsYearly = false;
        $('.js-switch-button-period').on('click', function(e) {
            e.preventDefault();
            $(this).parent().toggleClass('-yearly');
            pricingIsYearly = !pricingIsYearly;

            if (pricingIsYearly) {
                $('.js-price-big-wrapper').addClass('-yearly');
                $('.js-price-big-wrapper-month').addClass('-monthly');
                $('.price-switcher-period__monthly').removeClass('active');
                $('.price-switcher-period__yearly').addClass('active');
            } else {
                $('.js-price-big-wrapper').removeClass('-yearly');
                $('.js-price-big-wrapper-month').removeClass('-monthly');
                $('.price-switcher-period__monthly').addClass('active');
                $('.price-switcher-period__yearly').removeClass('active');
            }
        });
    </script>
    <script>
        function accessCouseVideo(lessonId, sectionId, courseId)
        {


            if(!lessonId && !sectionId && !courseId)
            {
                return;
            }

            // check if the container is active.
            $('#loader').show();
            $.ajax({
                url: `{{ route('check.eligibility') }}?lessonId=${lessonId}&sectionId=${sectionId}&courseId=${courseId}`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#loader').hide();
                    if(!data.success) {
                        // send error message
                        const err = `<div style="position: fixed; top: 20px; right: 20px; z-index: 100000; width: auto;">
                            <div class="col-12 mb-2">
                                <div class="alert alert-danger alert-timeout alert-dismissible fade show" role="alert">
                                    ${data.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>`;
                        $('body').append(err);
                        return;
                    }
                    localStorage.setItem(':is-current', `open:${lessonId}`);
                    localStorage.setItem('lessonId', lessonId);
                    localStorage.setItem('sectionId', sectionId);
                    localStorage.setItem('courseId', courseId);
                    $('#show-' + lessonId).modal('show');
                },
                error: function(error) {
                    $('#loader').hide();
                    console.log('error: ', error)
                }
            });
        }

        function authorizedVideoListener(lessonId, sectionId, courseId, email) {
            // register the credentials
            let switcher = false;
            const isOpen = localStorage.getItem(':is-current');
            if(isOpen === `open:${lessonId}`) {
                // open modal
                $('#show-' + lessonId).modal('show');
            } else {
                accessCouseVideo(lessonId, sectionId, courseId);
            }
        }

        function recordVideoProgress() {

            const lessonId = localStorage.getItem('lessonId');
            const sectionId = localStorage.getItem('sectionId');
            const courseId = localStorage.getItem('courseId');

            if(!lessonId && !sectionId && !courseId)
            {
                return;
            }

            const isOpen = $('#show-' + lessonId).hasClass('show');

            if($('#show-' + lessonId).hasClass('show')) {
                $.ajax({
                    url: `{{ route('check.eligibility') }}?lessonId=${lessonId}&sectionId=${sectionId}&courseId=${courseId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // do nothing
                    },
                    error: function(error) {
                        // do nothing
                    }
                });
            }
        }

        setInterval(recordVideoProgress, 30000);

        function generate_certificate(courseId) {
            $('#loader').show();
            $.ajax({
                url: `{{ route('generate.certificate') }}?courseId=${courseId}`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#loader').hide();
                    if(!data.success) {
                        // send error message
                        const err = `<div style="position: fixed; top: 20px; right: 20px; z-index: 100000; width: auto;">
                            <div class="col-12 mb-2">
                                <div class="alert alert-danger alert-timeout alert-dismissible fade show" role="alert">
                                    ${data.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>`;
                        $('body').append(err);
                        return;
                    } else {
                        // redirect to certificate page
                        window.open("{{route('issue.certificate')}}?courseId="+courseId, "_blank");
                    }
                },
                error: function(error) {
                    $('#loader').hide();
                    console.log('error: ', error)
                }
            });
        }
    </script>
</body>

</html>

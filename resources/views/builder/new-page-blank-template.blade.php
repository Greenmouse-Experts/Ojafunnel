<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>My page</title>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <style>
		html, body
		{
			width:100%;
			height:100%;
		}

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #713F93;
            min-height: 100px;
            padding: 20px 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .social-icon,
        .menu {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .social-icon__item,
        .menu__item {
            list-style: none;
        }

        .social-icon__link {
            font-size: 2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
        }
        .social-icon__link:hover {
            transform: translateY(-10px);
        }

        .menu__link {
            font-size: 1.2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
            text-decoration: none;
            opacity: 0.75;
            font-weight: 300;
        }

        .menu__link:hover {
            opacity: 1;
        }

        .footer p {
            color: #fff;
            margin: 15px 0 10px 0;
            font-size: 1rem;
            font-weight: 300;
        }
    </style>
    <style id="vvvebjs-styles"></style>
    </head>

    <body data-new-gr-c-s-check-loaded="14.1096.0" data-gr-ext-installed="" data-new-gr-c-s-loaded="14.1096.0">
        <!-- Page Content -->
        <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
            <h1 class="mt-5"> Ojafunnel start page</h1>
            <p class="lead">Start by dragging components to page or double click to edit text</p>
            </div>
        </div>
        </div>


        <footer class="footer">
            <div class="waves">
              <div class="wave" id="wave1"></div>
              <div class="wave" id="wave2"></div>
              <div class="wave" id="wave3"></div>
              <div class="wave" id="wave4"></div>
            </div>
            <ul class="social-icon">
                <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-facebook"></ion-icon>
                    </a></li>
                <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-twitter"></ion-icon>
                    </a></li>
                <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-linkedin"></ion-icon>
                    </a></li>
                <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-instagram"></ion-icon>
                    </a></li>
            </ul>
            <ul class="menu">
                <li class="menu__item"><a class="menu__link" href="#">Home</a></li>
                <li class="menu__item"><a class="menu__link" href="#">About</a></li>
                <li class="menu__item"><a class="menu__link" href="#">Services</a></li>
                <li class="menu__item"><a class="menu__link" href="#">Team</a></li>
                <li class="menu__item"><a class="menu__link" href="#">Contact</a></li>
            </ul>
            <p>&copy; <script>document.write(new Date().getFullYear())</script> Ojafunnel | All Rights Reserved</p>
        </footer>
    
        <grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>
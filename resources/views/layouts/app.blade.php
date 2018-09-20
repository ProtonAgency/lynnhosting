<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>Lynn Hosting - Affordable Web Hosting</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,400i,500,600,700,800,900" rel="stylesheet">
    <link href="/css/slicknav.min.css" rel="stylesheet">
    <link href="/css/magnific-popup.css" rel="stylesheet">
    <link href="/css/owl.carousel.min.css" rel="stylesheet">

    @if (Route::currentRouteName() === 'settings')
        <link href="/css/bootstrap.min.css" rel="stylesheet">
    @else 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    @endif
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animate.min.css" rel="stylesheet">
    <link href="/style.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <script>window.__theme = 'bs4';</script>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    @if (session('notification') !== null)
        <meta http-equiv="refresh" content="10" />
    @endif

    @if (Route::currentRouteName() === 'terminal')
        <script src="/js/echo.js"></script>
        <script src="/js/app.js"></script>
    @endif

    @if (Route::currentRouteName() === 'terminal')
        <link rel="stylesheet" type="text/css" href="/css/jquery.terminal-1.23.1.min.css">
    @endif
</head>

<body style="overflow-x: hidden;">
    <!-- preloader start -->
    <div id="cssload-wrapper">
        <div class="cssload-loader">
            <div class="cssload-line"></div>
            <div class="cssload-line"></div>
            <div class="cssload-line"></div>
            <div class="cssload-line"></div>
            <div class="cssload-line"></div>
            <div class="cssload-line"></div>
            <div class="cssload-subline"></div>
            <div class="cssload-subline"></div>
            <div class="cssload-subline"></div>
            <div class="cssload-subline"></div>
            <div class="cssload-subline"></div>
            <div class="cssload-loader-circle-1">
                <div class="cssload-loader-circle-2"></div>
            </div>
            <div class="cssload-needle"></div>
            <div class="cssload-loading">loading</div>
        </div>
    </div>
    <!-- preloader End -->

    <!-- header start -->
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-1 col-xs-3 logo">
                    <a href="/"><img src="/img/logo.png" alt=""></a>
                </div>
                <div class="col-sm-8 col-xs-9 mainmenu">
                    <ul id="mainmenu">
                        <li><a href="#">Containers</a>
                            <ul class="drop-menu">
                                <li><a href="/containers">Your Containers</a></li>
                                <li><a href="/containers/new">Create Container</a></li>
                            </ul>
                        </li>
                        <li><a href="/databases">Databases</a></li>
                        <li><a href="/settings">Settings</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 col-xs-6 header-right">
                    <div class="login-btn-area"> <a href="/logout" class="login-btn">Logout</a> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header End -->

    @yield('content')

    <!-- map End -->
    <!-- footer start -->
    <footer class="footer-area">
        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="single-widget fadeIn wow" data-wow-delay="0.3s">
                            <h3>Products</h3>
                            <ul>
                                <li><a href="#">Web Hosting</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget fadeIn wow" data-wow-delay="0.3s">
                            <h3>Resources</h3>
                            <ul>
                                <li><a href="/status">Server Status</a></li>
                                <li><a href="/legal">Legal</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget fadeIn wow" data-wow-delay="0.3s">
                            <h3>Information</h3>
                            <ul>
                                <li><a href="/pricing">Pricing</a></li>
                                <li><a href="/contact">Contact Sales</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget fadeIn wow" data-wow-delay="0.3s">
                            <h3>Company</h3>
                            <ul>
                                <li><a href="https://lynndigital.com">Home</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row footer-bottom-content">
                    <div class="col-md-10">
                        <div class="footer-paragraph">
                            <p>
                                Copyright 2018 © Lynn Hosting is a brand of <a style="color: white;" href="https://lynndigital.com">Jacob Casto DBA Lynn Digital</a>. All rights reserved.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2 pull-right">
                        <div class="footer-social-icon">
                            <ul>
                                <li>
                                    <a href="twitter.com/lynnhosting"> <i class="fa fa-twitter"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer End -->


    <script src="/js/jquery-2.1.4.min.js"></script>
    <!--    <script src="js/jquery.magnific-popup.min.js"></script>-->
    <script src="/js/jquery.slicknav.min.js"></script>
    <!--    <script src="js/isotope.pkgd.min.js"></script>-->
    <script src="/js/owl.carousel.min.js"></script>
    <!-- ================= wow Js ======== -->
    <script src="/js/wow.min.js"></script>
    @if (Route::currentRouteName() === 'settings')
        <script src="/js/bootstrap.min.js"></script>
    @else 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    @endif
    <script src="/js/main.js"></script>

    @if (Route::currentRouteName() === 'terminal')
        <script src="/js/jquery.terminal-1.23.1.min.js"></script>
    @endif
    @yield ('js')
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="lynndigital_icense_key" content="{{ env('LYNNHOSTING_LICENSE_KEY', null) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lynn Hosting - Affordable Web Hosting</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,400i,500,600,700,800,900" rel="stylesheet">
    <link href="/css/slicknav.min.css" rel="stylesheet">
    <link href="/css/magnific-popup.css" rel="stylesheet">
    <link href="/css/owl.carousel.min.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animate.min.css" rel="stylesheet">
    <link href="/style.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>
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
                    <a href="/"><img src="img/logo.png" data-retina="img/logo2.png" alt=""></a>
                </div>
                <div class="col-sm-8 col-xs-9 mainmenu">
                    <ul id="mainmenu">
                        <li><a href="/">Home</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 col-xs-6 header-right">
                    <div class="login-btn-area"> <a href="/login" class="login-btn">Log In</a> </div>
                    <div class="account-btn"> <a href="/register" class="create-account-btn button-hover">create an account</a> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header End -->
    <!-- hero start -->
    <div class="hero-area">
        <div class="banner-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="hero-area-content fadeIn wow" data-wow-delay="0.2s">
                            <h4>Starting at $1.95/month*</h4>
                            <h1>Affordable Web Hosting</h1>
                            <ul class="hero-option-menu">
                                <li><span><i class="fa fa-check"></i></span>Free SSL Certificate</li>
                                <li><span><i class="fa fa-check"></i></span>High Performance SSD Server</li>
                                <li><span><i class="fa fa-check"></i></span>Awesome customer support</li>
                            </ul>
                            <a href="/register" class="getstarted-btn button-hover hero-btn">Get Started Now</a> </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="hero-img"><img src="img/hero-img.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- hero End -->
    <!-- pricing start -->
    <section id="pricing" class="pricing-area section-padding">
        <div class="container">
            <div class="section-heading">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title-heading">
                            <h2>Affordable pricing for you</h2>
                            <p>Our Web hosting plans include easy setup, automated updates and backups, 100%
                                <br> network uptime and 24/7 Tech support. <span class="blue-text">Starting at $1.95/mo</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="price-area fadeIn wow" data-wow-delay="0.15s">
                <div class="row">
                    <div class="col-md-12 price-silder-wrapper">
                        @foreach (\App\Plan::all() as $plan)
                            <div class="single-price-slide">
                                <div class="single-price">
                                    <div class="price-quality">
                                        <h4>{{ $plan->name }}</h4>
                                        <h2>${{ $plan->price }}/mo</h2>
                                    </div>
                                    <div class="price-details">
                                        <ul>
                                            <li>{{ $plan->storage }}GB SSD</li>
                                            <li>{{ $plan->databases}} Database(s)</li>
                                            <li>{{ $plan->emails }} Email Accounts</li>
                                            <li><b>{{ $plan->domains }}</b> Projects</li>
                                        </ul>
                                        <div class="get-btn-area">
                                            <a href="/register" class="price-btn button-hover">Get Started Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach      
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pricing End -->
    <!-- service start -->
    <section class="service-area">
        <div class="container">
            <div class="row service-top-area">
                <div class="col-md-4 col-sm-6 fadeIn wow" data-wow-delay="0.12s">
                    <div class="single-service">
                        <div class="service-img">
                            <img src="img/service-img1.png" alt="">
                        </div>
                        <h3>Fastest Server</h3>
                        <p>Your websites and databases run on powerful enterprise servers.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 fadeIn wow" data-wow-delay="0.13s">
                    <div class="single-service">
                        <div class="service-img">
                            <img src="img/service-img2.png" alt="">
                        </div>
                        <h3>99.99% Server Uptime</h3>
                        <p>We guarentee a 99 uptime for all of your websites and databases.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 fadeIn wow" data-wow-delay="0.2s">
                    <div class="single-service">
                        <div class="service-img">
                            <img src="img/service-img6.png" alt="">
                        </div>
                        <h3>Secured Storage</h3>
                        <p>All of your files and databases are secured behind a strong firewall.</p>
                    </div>
                </div>
            </div>
            <div class="service-btm-area">
                <div class="row">
                    <div class="col-md-9">
                        <div class="service-btm-text">
                            <h3>With Lynn Hosting you'll feel safe like you're at home. <br> Deliver your content at lightning fast speeds. <span class="bold-text">Get started from $1.95/mo.</span></h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="service-get-btn">
                            <a href="/register" class="getstarted-btn button-hover">Get started now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service End -->
    <!-- map start -->
    <section class="map-area">
        <div class="container section-padding">
            <div class="section-heading">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title-heading">
                            <h2>We Bring Cloud Hosting To You!</h2>
                            <p>We have powerful web hosting servers all over the world.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row fadeIn wow" data-wow-delay="0.1s">
                <div class="col-md-8 col-md-offset-2 map-location-area">
                    <div class="our-brances ">
                        <div class="single-location newyork">
                            <h6>New York</h6>
<!--                             <div class="Dropdown-content">
                                <div class="map-dropdown-title">
                                    <p>Speed Test</p>
                                </div>
                                <div class="map-dropdown-address">
                                    <a href="#">NYC1</a>
                                    <br>
                                    <a href="#">NYC2</a>
                                    <br>
                                    <a href="">NYC3</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <a href="/register" class="getstarted-btn button-hover">Get Started Now</a>
                </div>
            </div>
        </div>
    </section>

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
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <div class="header-area signup-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 logo">
                    <a href="index.html"><img src="/img/logo.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <!-- header End -->
    <!-- signup Start -->
    <section class="signup-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="signup-box">
                        <div class="signup-form">
                            <form action="/register" method="post">
                                @csrf

                                <div class="signup-title">
                                    <h2>Create an account</h2>
                                    <p>Have an account on Lynn Hosting? <a href="/login">Login here</a></p>
                                </div>
                                <div class="signup-input-area">
                                    <input type="text" placeholder="Full Name" name="name" required>
                                    @if ($errors->has('name'))
                                        <span style="color: red;">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <input type="email" placeholder="Email Address" name="email" required>
                                    @if ($errors->has('email'))
                                        <span style="color: red;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <input type="password" placeholder="Password" name="password" required>
                                    @if ($errors->has('password'))
                                        <span style="color: red;">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <input type="password" placeholder="Retype Password" name="password_confirmation" required>
                                    <div class="signup-submit-button">
                                        <button class="button-hover" type="submit" >Create account now</button>
                                    </div>
                                </div>
                            </form>

                            <div class="signup-bottom-text">
                                <p>By clicking Create Account Now, you accept the <a href="/legal">Terms and Conditions</a> and <a href="/legal">Privacy Policy</a> of Lynn Hosting.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- signup End -->
    <script src="/js/jquery-2.1.4.min.js"></script>
    <!-- ================= wow Js ======== -->
    <script src="/js/wow.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>
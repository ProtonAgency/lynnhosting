<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lynn Hosting</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&subset=latin" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://demo.cachethq.io/build/dist/css/all-2812406e36.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <style type="text/css">
            body.status-page {
            background-color: #F0F3F4;
            color: #333333;
            }
            p, strong { color: #333333 !important; }
            .reds { color: #ff6f6f !important; }
            .blues { color: #3498db !important; }
            .greens { color: #7ED321 !important; }
            .yellows { color: #F7CA18 !important; }
            .oranges { color: #FF8800 !important; }
            .metrics { color: #0dccc0 !important; }
            .links { color: #7ED321 !important; }
            /**
            * Banner background
            */
            .app-banner {
            background-color:  !important;
            }
            .app-banner-padding {
            padding: 40px 0 !important;
            }
            /**
            * Alert overrides.
            */
            .alert {
            background-color: #F7CA18;
            border-color: #deb515;
            color: white;
            }
            .alert.alert-success {
            background-color: #7ED321;
            border-color: #71bd1d;
            color: white;
            }
            .alert.alert-info {
            background-color: #3498db;
            border-color: #2e88c5;
            color: white;
            }
            .alert.alert-danger {
            background-color: #ff6f6f;
            border-color: #e56363;
            color: white;
            }
            /**
            * Button Overrides
            */
            .btn.links {
            color: #ac8d10;
            }
            .btn.btn-success {
            background-color: #7ED321;
            border-color: #71bd1d;
            color: white;
            }
            .btn.btn-success.links {
            color: #589317;
            }
            .btn.btn-success.btn-outline {
            background-color: transparent;
            border-color: #7ED321;
            color: #7ED321;
            }
            .btn.btn-success.btn-outline:hover {
            background-color: #7ED321;
            border-color: #71bd1d;
            color: white;
            }
            .btn.btn-info {
            background-color: #3498db;
            border-color: #2e88c5;
            color: white;
            }
            .btn.btn-info.links {
            color: #246a99;
            }
            .btn.btn-danger {
            background-color: #ff6f6f;
            border-color: #e56363;
            color: white;
            }
            .btn.btn-danger.links {
            color: #b24d4d;
            }
            /**
            * Background fills Overrides
            */
            .component {
            background-color: #FFFFFF;
            border-color: #e5e5e5;
            }
            .sub-component {
            background-color: #FFFFFF;
            border-color: #e5e5e5;
            }
            .incident {
            background-color: #FFFFFF;
            border-color: #e5e5e5;
            }
            .status-icon {
            background-color: #FFFFFF;
            border-color: #e5e5e5;
            }
            .panel.panel-message:before {
            border-left-color: #FFFFFF !important;
            border-right-color: #FFFFFF !important;
            }
            .panel.panel-message:after {
            border-left-color: #FFFFFF !important;
            border-right-color: #FFFFFF !important;
            }
            .footer a {
            color: #333333;
            }
        </style>
        <script type="text/javascript">
            var Global = {};
            Global.locale = 'en';
        </script>
        <script src="https://demo.cachethq.io/build/dist/js/all-b2c62d4294.js"></script>
    </head>
    <body class="status-page ">
        <div class="container">
            @foreach (\App\Location::all() as $location)
                <div class="section-components">
                    <ul class="list-group components">
                        <li class="list-group-item group-name">
                            <strong>{{ $location->name }} Server</strong>
                            <div class="pull-right">
                                <i class="fa fa-circle text-component-1 greens" data-toggle="tooltip" title="{{ (bool) $location->http_online === true && (bool) $location->database_online === true ? 'All Systems Operational' : 'Some Systems Offline'}}"></i>
                            </div>
                        </li>
                        <div class="group-items ">
                            <li class="list-group-item sub-component">
                                HTTP Servers
                                <div class="pull-right">
                                    <small class="text-component-1 {{ $location->http_online ? 'greens' : 'reds'}}" data-toggle="tooltip" title="Last updated {{ $location->last_updated }}">
                                        {{ $location->http_online ? 'Operational' : 'Offline'}}
                                    </small>
                                </div>
                            </li>
                            <li class="list-group-item sub-component">
                                Proxy Servers
                                <div class="pull-right">
                                    <small class="text-component-1 {{ $location->proxy_online ? 'greens' : 'reds'}}" data-toggle="tooltip" title="Last updated {{ $location->last_updated }}">
                                        {{ $location->proxy_online ? 'Operational' : 'Offline'}}
                                    </small>
                                </div>
                            </li>
                            <li class="list-group-item sub-component">
                                Database Provider
                                <div class="pull-right">
                                    <small class="text-component-1 {{ $location->database_online ? 'greens' : 'reds'}}" data-toggle="tooltip" title="Last updated {{ $location->last_updated }}">
                                        {{ $location->database_online ? 'Operational' : 'Offline'}}
                                    </small>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
            @endforeach
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <p>Powered by <a href="https://cachethq.io" class="links">Cachet</a>.</p>
                    </div>
                    <div class="col-sm-7">
                        <ul class="list-inline">
                            <li>
                                <a class="btn btn-link" href="/">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
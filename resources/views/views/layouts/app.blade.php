<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/assets/js/modernizr.min.js"></script>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/assets/plugins/morris/morris.css">
    <link href="/assets/plugins/custombox/css/custombox.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Multi Item Selection examples -->
    <link href="/assets/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="fixed-left">
    <div id="wrapper">
        <div class="topbar">
            <div class="topbar-left">
                <div class="text-center">
                    <a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Flex-lead</span></a>
                    <!-- Image Logo here -->
                    <!--<a href="index.html" class="logo">-->
                    <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                    <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                    <!--</a>-->
                </div>
            </div>
            {{--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">--}}
                {{--<div class="container">--}}
                    {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                        {{--{{ config('app.name', 'Laravel') }}--}}
                    {{--</a>--}}
                    {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
                        {{--<span class="navbar-toggler-icon"></span>--}}
                    {{--</button>--}}

                    {{--<div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
                        {{--<!-- Left Side Of Navbar -->--}}
                        {{--<ul class="navbar-nav mr-auto">--}}

                        {{--</ul>--}}

                        {{--<!-- Right Side Of Navbar -->--}}
                        {{--<ul class="navbar-nav ml-auto">--}}
                            {{--<!-- Authentication Links -->--}}
                            {{--@guest--}}
                            {{--<li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>--}}
                            {{--<li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>--}}
                            {{--@else--}}
                                {{--<li class="nav-item dropdown">--}}
                                    {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                                        {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                                    {{--</a>--}}

                                    {{--<div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
                                        {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                                           {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                            {{--{{ __('Logout') }}--}}
                                        {{--</a>--}}

                                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                            {{--@csrf--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--@endguest--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</nav>--}}
            <nav class="navbar-custom">

                <ul class="list-inline float-right mb-0">
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-bell noti-icon"></i>
                            <span class="badge badge-pink noti-icon-badge">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                                <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                                <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
                            </a>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                View All
                            </a>

                        </div>
                    </li>

                    <li class="list-inline-item notification-list">
                        <a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
                            <i class="dripicons-expand noti-icon"></i>
                        </a>
                    </li>

                    <li class="list-inline-item notification-list">
                        <a class="nav-link right-bar-toggle waves-light waves-effect" href="#">
                            <i class="dripicons-message noti-icon"></i>
                        </a>
                    </li>

                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="text-overflow"><small>Welcome ! John</small> </h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="md md-account-circle"></i> <span>Profile</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="md md-settings"></i> <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-lock-open"></i> <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="md md-settings-power"></i> <span>Logout</span>
                            </a>

                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-light waves-effect">
                            <i class="dripicons-menu"></i>
                        </button>
                    </li>
                    <li class="hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>

            </nav>
        </div>
        <!-- ========== Left Sidebar Start ========== -->
        @guest
        @else
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>

                        <li class="text-muted menu-title">Navigation</li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="/dashboard">Dashboard 1</a></li>

                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-paint-bucket"></i> <span> Services </span> <span class="menu-arrow"></span> </a>
                            <ul class="list-unstyled">
                                <li><a href="/delivery">Delivary</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="/client"><i class="ti-light-bulb"></i><span> Clients </span></a>
                        </li >
                        <li class="has_sub">
                            <a href="/transporter"><i class="ti-light-bulb"></i><span> Transporter </span></a>
                        </li >
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->
        @endguest


        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/detect.js"></script>
    <script src="/assets/js/fastclick.js"></script>
    <script src="/assets/js/jquery.slimscroll.js"></script>
    <script src="/assets/js/jquery.blockUI.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/jquery.nicescroll.js"></script>
    <script src="/assets/js/jquery.scrollTo.min.js"></script>

    <script src="/assets/plugins/peity/jquery.peity.min.js"></script>

    <!-- jQuery  -->
    <script src="/assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="/assets/plugins/counterup/jquery.counterup.min.js"></script>

    <script src="/assets/plugins/morris/morris.min.js"></script>
    <script src="/assets/plugins/raphael/raphael-min.js"></script>

    <script src="/assets/plugins/jquery-knob/jquery.knob.js"></script>

    <script src="/assets/pages/jquery.dashboard.js"></script>

    <script src="/assets/js/jquery.core.js"></script>
    <script src="/assets/js/jquery.app.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.counter').counterUp({
                delay: 100,
                time: 1200
            });

            $(".knob").knob();

        });
    </script>
    @yield('script')
</body>

</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Security Marketplace | GuardMe</title>
    <meta name="csrf-token" content="{{csrf_token()}}" >
    <meta name="fid" content="{{env('FACEBOOK_ID','1966592423622448')}}" >
    <meta name="_aut" content="{{getAuthUserToken()}}" >
    <meta name="api-token" content="{{auth()->user() ? auth()->user()->api_token : null}}" >

    <link rel="stylesheet" href="/build/css/app.vendors.bundle.css">
    <link rel="stylesheet" href="/build/css/app.bundle.css">

    @stack('styles')

</head>
<body>

<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="app">
    @stack('modals')
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg "
               href="javascript:void(0)" data-toggle="collapse"
               data-target=".navbar-collapse">
                <i class="ti-menu"></i>
            </a>
            <!-- Logo -->
            <div class="top-left-part">
                <a class="logo uk-text-middle" href="/">
                    <b>
                        <div class="d-inline-block p-2 ui image grey lighten-4"
                             style="width: 50px; height: 50px;">
                            <div class="h-100 fluid white circular">
                                <div class="ui image uk-background-contain
                            white h-100 fluid"
                                     style="background-image: url(/assets/img/logo_icon.png)">
                                </div>
                            </div>
                        </div>
                    </b>
                    <span class="hidden-xs">
                        <span class="fg-site-blue">Guard</span><span class="fg-site-green">Me</span>
                    </span>
                </a>
            </div>
            <!-- /Logo -->
            <!-- This is for mobile view search and menu icon -->
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li>
                    <a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
                        <i class="icon-arrow-left-circle ti-menu"></i>
                    </a>
                </li>
                <li>
                    <form role="search" class="app-search hidden-xs">
                        <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                </li>
            </ul>
            <!-- This is the message dropdown -->
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <img src="/assets/eliteAdmin/plugins/images/users/varun.jpg" alt="user-img"
                             width="36" class="img-circle">
                        <b class="hidden-xs">
                            @{{ $root.greetPerson() }}
                        </b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="ti-user"></i> My Profile</a></li>

                        <li role="separator" class="divider"></li>
                        <li><a href="/account/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

                <!-- /.Megamenu -->
                <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- Left navbar-header -->
@include('app::partials.app.sidebar')
<!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper" style="padding-bottom: 0px;">
        <div class="container-fluid">
        @if (auth()->user()->isDisapproved())
        <div class="alert alert-warning" role="alert">Your account needs to be verified.</div>
        @endif

        @if (! auth()->user()->email_verified)
            <div class="alert alert-warning" role="alert">
                <strong>Warning</strong> You need verify your e-mail address. <a href="/confirm/resend">Send confirmation letter again.</a>
            </div>
        @endif
        @yield('app')
        <!-- .right-sidebar -->
            <div class="right-sidebar">
                <div class="slimscrollright">
                    <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                    <div class="r-panel-body">
                        <ul>
                            <li><b>Layout Options</b></li>
                            <li>
                                <div class="checkbox checkbox-info">
                                    <input id="checkbox1" type="checkbox" class="fxhdr">
                                    <label for="checkbox1"> Fix Header </label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox checkbox-warning">
                                    <input id="checkbox2" type="checkbox" checked="" class="fxsdr">
                                    <label for="checkbox2"> Fix Sidebar </label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox4" type="checkbox" class="open-close">
                                    <label for="checkbox4"> Toggle Sidebar </label>
                                </div>
                            </li>
                        </ul>
                        <ul id="themecolors" class="m-t-20">
                            <li><b>With Light sidebar</b></li>
                            <li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
                            <li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
                            <li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
                            <li><a href="javascript:void(0)" theme="blue" class="blue-theme working">4</a></li>
                            <li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
                            <li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
                            <li><b>With Dark sidebar</b></li>
                            <br/>
                            <li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
                            <li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
                            <li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>
                            <li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
                            <li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
                            <li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
                        </ul>
                        <ul class="m-t-20 chatonline">
                            <li><b>Chat option</b></li>
                            <li>
                                <a href="javascript:void(0)"><img src="/assets/eliteAdmin/plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="/assets/eliteAdmin/plugins/images/users/genu.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="/assets/eliteAdmin/plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="/assets/eliteAdmin/plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="/assets/eliteAdmin/plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="/assets/eliteAdmin/plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="/assets/eliteAdmin/plugins/images/users/john.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="/assets/eliteAdmin/plugins/images/users/pawandeep.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.right-sidebar -->
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center" style="position: inherit; left: 0; bottom: 0"> {{date('Y')}} &copy; {{config('app.name', 'GuardMe')}}</footer>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<script src="/assets/canvas/js/jquery.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY', 'AIzaSyB6lc7ZEn9sp6wAK9QgmxbiMoxkkiz99JU') }}" ></script>
<script src="/assets/canvas/js/jquery.gmap.js"></script>

<script src="/build/js/app.vendors.bundle.js"></script>
<script src="/build/js/app.min.js"></script>

@stack('scripts')
</body>
</html>

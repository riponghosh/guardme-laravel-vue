<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Security Marketplace | GuardMe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{csrf_token()}}" >
    <meta name="fid" content="{{env('FACEBOOK_ID','1966592423622448')}}" >
    <meta name="_aut" content="{{getAuthUserToken()}}" >
    <meta name="api-token" content="{{auth()->user() ? auth()->user()->api_token : null}}" >

    <!-- Stylesheets
    ============================================= -->
    <link async href="https://fonts.googleapis.com/css?family=Lora:400,400i|Roboto:300,400,500,700|Rubik:400,600" rel="stylesheet">
    <link rel="stylesheet" href="" type="text/css" />

    <style>
        @php
            include(public_path().'/assets/canvas/css/bootstrap.css');
            include(public_path().'/build/css/site.theme.min.css');
            include(public_path().'/build/css/site.vendors.bundle.min.css');
            include(public_path().'/build/css/site.main.min.css');
        @endphp
    </style>

    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    @stack('styles')
</head>


<body class="stretched side-push-panel">

@includeWhen(auth()->guest(), 'app::partials.site.auth')


<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">


    @section('removable-site-head')
        @include('app::partials.site.top-bar')
        @include('app::partials.site.header')

        @yield('feature')

    @show
    <!-- Content
    ============================================= -->
    <section id="content">

        <div id="app" class="w-100">
            @include('app::partials.splashscreen')

            @yield('content')
        </div>

    </section><!-- #content end -->


    @include('app::partials.site.footer')


</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>


<!-- Google Map JavaScripts
============================================= -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY', 'AIzaSyB6lc7ZEn9sp6wAK9QgmxbiMoxkkiz99JU') }}" ></script>
<script src="/build/js/site.vendors.bundle.min.js"></script>

<script src="/build/js/site.min.js"></script>
<script src="/build/js/app.min.js"></script>
@stack('scripts')

</body>
</html>
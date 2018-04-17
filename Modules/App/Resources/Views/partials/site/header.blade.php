<!-- Header
    ============================================= -->
<header id="header" class="static-sticky transparent-header semi-transparent uk-position-relative">


    <div id="header-wrap" class="bg-white">

        <div class="container clearfix ">

            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            <!-- Logo
            ============================================= -->
            <div id="logo"  class="">
                <a href="/" data-dark-logo="/assets/img/logo.png" class="standard-logo">
                    <img src="/assets/img/logo.png" alt="GuardMe">
                </a>
                {{--<a href="/" data-dark-logo="/assets/img/logo.png" class="retina-logo">
                    <img src="/assets/img/logo.png" alt="GuardMe">
                </a>--}}
            </div>
            <!-- #logo end -->

            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu" class="with-arrows">

                <ul>
                    <li class="{{isPath('/') ? 'current' : ''}}"><a href="/"><div>Home</div></a></li>
                    <li><a href=""><div>About Us</div></a></li>
                    <li><a href=""><div>Security Personnel</div></a></li>
                    <li class="{{isPath('jobs') ? 'current' : ''}}"><a href="/jobs"><div>Job Openings</div></a></li>
                    <li><a href=""><div>Blog</div></a></li>
                    <li><a href=""><div>FAQ</div></a></li>
                    <li>
                        <a href="/jobs/new" class="button button-border button-rounded button-green">
                            <i class="icon-plus-sign"></i>
                            Post new job
                        </a>
                    </li>
                </ul>

            </nav><!-- #primary-menu end -->

        </div>

    </div>

</header><!-- #header end -->
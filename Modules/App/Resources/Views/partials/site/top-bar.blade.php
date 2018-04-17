<!-- Top Bar
    ============================================= -->
<div id="top-bar" class="transparent-topbar">
    <div class="row">
        <div class="col-9 p-1 bg-site-blue"></div>
        <div class="col-3 p-1 bg-site-green"></div>
    </div>

    <div class="container clearfix">

        <div class="col_half fright col_last clearfix nobottommargin">

            <!-- Top Links
            ============================================= -->
            <div class="top-links">
                <ul>
                    <li><a href="javascript:void(0);"><i class="icon-download-alt"></i> Download App</a></li>
                    @if(!auth()->guest())
                        <li>
                            <a href="/account/dashboard" target="_blank" class="">
                                <i class="icon-dashboard"></i>
                                My Account
                            </a>
                        </li>
                        <li>
                            <a href="/account/logout" class="">
                                <i class="icon-signout"></i>
                                Log out
                            </a>
                        </li>
                    @endif

                    @if(auth()->guest())
                        <li><a href="#" class="side-panel-trigger">Login/Register</a></li>
                    @endif
                </ul>
            </div><!-- .top-links end -->

        </div>

    </div>

</div><!-- #top-bar end -->
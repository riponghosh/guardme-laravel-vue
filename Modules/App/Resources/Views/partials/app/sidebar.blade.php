<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                <!-- /input-group -->
            </li>
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <li>
                <a href="/account/dashboard" class="waves-effect">
                    <i class="fa fa-home"></i>
                    <span class="hide-menu"> Dashboard</span>
                </a>
            </li>

            <li>
                <a href="/account/teams" class="waves-effect">
                    <i class="fa fa-users"></i>
                    <span class="hide-menu"> Teams <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="/account/teams"><i class="fa fa-circle-o"></i> Overview</a> </li>
                    <li> <a href="/account/teams/edit"><i class="fa fa-pencil"></i> Edit Team</a> </li>
                    <li> <a href="/account/teams/favourites"><i class="fa fa-heart red-text"></i> Favourites</a> </li>
                    <li> <a href="/account/teams/report-user"><i class="fa fa-circle"></i> Report Freelancer</a> </li>
                </ul>
            </li>


            <li>
                <a href="/account/profile" class="{{ isPath('account/profile') ? 'active' : '' }} waves-effect">
                    <i class="fa fa-user"></i>
                    <span class="hide-menu"> Profile <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li><a href="/account/profile"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="/account/profile/verification"><i class="fa fa-check"></i> Verification</a></li>
                    {{--<li><a href="/account/feedback"><i class="fa fa-reply"></i> Feedback</a></li>--}}
                    <li><a href="/account/profile/delete"><i class="fa fa-remove"></i> Delete Account</a></li>
                </ul>
            </li>

            @if(hasRole(config('guardme.acl.Admin')))
            <li><a href="/account/profile/users"><i class="fa fa-users"></i> Security personnel</a></li>
            <li><a href="/account/profile/users/employers"><i class="fa fa-users"></i> Employers</a></li>
            <li><a href="/account/profile/users/suspended"><i class="fa fa-users"></i> Suspended Accounts</a></li>
            @endif

            <li >
                <a href="/account/wallet" class="{{ isPath('account/wallet') ? 'active' : '' }}">
                    <i class="ti ti-wallet"></i>
                    <span class="hide-menu"> Wallet <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li><a href="/account/escrow"><i class="fa fa-circle-o"></i> Escrow</a></li>
                    <li><a href="/account/wallet/add-funds"><i class="fa fa-plus-circle"></i> Add Funds</a></li>
                    <li><a href="/account/wallet/approve-payment"><i class="fa fa-check"></i> Approve Payment</a></li>
                </ul>
            </li>

            <li>
                <a href="/account/schedules" class="{{ isPath('account/schedules') ? 'active' : '' }}">
                    <i class="fa fa-tasks"></i>
                    <span class="hide-menu"> Jobs <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li><a href="/account/jobs/schedule"><i class="fa fa-calendar-check-o"></i> Active Schedule</a></li>
                    <li><a href="/account/jobs/completed"><i class="fa fa-check"></i> Completed</a></li>
                    <li><a href="/account/jobs/on-going"><i class="fa fa-circle-o"></i> On-going</a></li>
                </ul>
            </li>

            <li>
                <a href="/account/reports" class="{{ isPath('account/reports') ? 'active' : '' }} ">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="hide-menu"> Reports</span>
                </a>
            </li>

            <li >
                <a href="/account/support" class="{{ isPath('account/support') ? 'active' : '' }}">
                    <i class="icon handshake"></i>
                    <span class="hide-menu"> Support <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li><a href="/account/support/tickets"><i class="fa fa-list"></i> Tickets</a></li>
                    <li><a href="/account/support/tickets/create"><i class="fa fa-plus-circle"></i> Create Ticket</a></li>
                    <li><a href="/account/support/tickets"><i class="fa fa-circle-o"></i> Open Ticket</a></li>
                    <li><a href="/account/support/tickets"><i class="fa fa-remove"></i> Closed Ticket</a></li>
                </ul>
            </li>

            <li>
                <a href="/account/settings" class="{{ isPath('account/settings') ? 'active' : '' }}">
                    <i class="fa fa-cog"></i>
                    <span class="hide-menu"> Settings <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li class="{{ isPath('account/privacy') ? 'active' : '' }} ">
                        <a href="/account/privacy" class="">
                            <i class="fa fa-lock"></i> <span>Privacy</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="/loyalty" class="{{ isPath('account/loyaltly_program') ? 'active' : '' }}">
                    <i class="fa fa-cog"></i>
                    <span class="hide-menu"> Loyaltly Program <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li class="{{ isPath('loyalty') ? 'active' : '' }} ">
                        <a href="/loyalty" class="">
                            <i class="fa fa-lock"></i> <span> New Referrals</span>
                        </a>
                    </li>
                    <li class="{{ isPath('loyalty/credit-history') ? 'active' : '' }} ">
                        <a href="/loyalty/credit-history" class="">
                            <i class="fa fa-lock"></i> <span> Credit History</span>
                        </a>
                    </li>
                    <li class="{{ isPath('loyalty/redeem-credit') ? 'active' : '' }} ">
                        <a href="/loyalty/redeem-credit" class="">
                            <i class="fa fa-lock"></i> <span> Redeem Credit</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#invite-friends-modal">
                    <i class="fa fa-share-alt"></i>
                    <span class="hide-menu"> Invite Users</span>

                </a>
            </li>

            @if(hasRole(config('guardme.acl.Admin')) || hasRole(config('guardme.acl.Super_Admin')))
            <li>
                <a href="/users" class="{{ isPath('users') ? 'active' : '' }} ">
                    <i class="fa fa-users"></i>
                    <span class="hide-menu"> Users</span>
                </a>
            </li>
            @endif

            @if(hasRole(config('guardme.acl.Super_Admin')))
            <li>
                <a href="/account/acl" class="{{ isPath('account/acl') ? 'active' : '' }} ">
                    <i class="fa fa-lock"></i>
                    <span class="hide-menu"> Access Control</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>

<!--the modal, needs to be on an outside div of the link to open/close properly-->
<div class="modal fade" id="invite-friends-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="text-center modal-title" id="exampleModalLabel">Invite Your Friends!</h5>
            </div>

            <!--body-->
            <div class="modal-body">
                <div class="social-links">
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://www.guarddme.com">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://twitter.com/intent/tweet?text=Your Message! https://www.guarddme.com">
                                <i class="fa fa-twitter-square"></i>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=https://www.guarddme.com&title=Guard Me - Security Marketplace">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://plus.google.com/share?url=https://www.guarddme.com">
                                <i class="fa fa-google-plus-square"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/the modal-->

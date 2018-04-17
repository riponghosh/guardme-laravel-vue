@extends("app::layouts.site")

@section("site")
    <div class="uk-width-1-1 uk-background-cover uk-background-center-right uk-position-relative"
         style="background-image: url(/assets/security_man.jpg); height: 270px">
        <div class="overlay uk-position-top uk-height-1-1 grey lighten-4" style="opacity: 0.76;"></div>

        <div class="uk-position-center" style="z-index: 100;">
            <h1 class="uk-text-center logo-heading">
                <span class="guard slant-background">Guard</span><span class="me slant-background">Me</span>
                <span class="uk-text-bold">Job Vacancies</span>
            </h1>
        </div>
    </div>
    <div class="p-1 bg-site-blue "></div>

    <div class="uk-width-1-1 uk-padding-large uk-padding-remove-horizontal">
        <div class="uk-container">
            <div class="uk-width-1-1 uk-margin-remove-left" uk-grid>
                <div class="uk-width-1-4@m">
                    <div class="uk-width-1-1 mb-5">
                        <h5 class="heading-underline site-green-underline mb-4">Search jobs</h5>
                        <div>
                            <div class="form-group">
                                <input type="password" class="form-control"
                                       placeholder="Enter search keyword">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control"
                                       placeholder="Pay per hour">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control"
                                       placeholder="Location">
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-1 mb-5">
                        <h5 class="heading-underline site-green-underline mb-4">Filter by contract type</h5>
                        <div class="uk-form-controls uk-flex uk-flex-column">
                            <label>
                                <input class="uk-checkbox"
                                       type="checkbox">
                                One time
                            </label>

                            <label>
                                <input class="uk-checkbox"
                                       type="checkbox">
                                One-going
                            </label>
                        </div>
                    </div>

                    <div class="uk-width-1-1 mb-3">
                        <h5 class="heading-underline site-green-underline mb-4">Filter by rating</h5>
                        <div id="double_number_range" style=""></div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <button class="btn btn-success">Search</button>
                        </div>
                    </div>
                </div>
                <div class="uk-width-2-3@m">
                    <p>Search result:</p>
                    <div class="uk-width-1-1">
                        <div class="listing-container">
                            <div class="listing">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div style="position: relative;">
                                            <a href="">
                                                <img src="/assets/company_logo_sample.jpg" alt="Dmitrii G.'s avatar"
                                                     class="vertical-align-middle img-thumbnail m-0">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 p-0-left">
                                        <div class="mb-1">
                                            <h4 class="main-heading"><a href="/jobs/details">Surveillance Manager</a></h4>
                                            <h4 class="m-0 freelancer-tile-title ellipsis sub-heading">
                                                Caja Studios, Inc.
                                                <div class="ui star rating mini" data-rating="4"></div>
                                            </h4>
                                        </div>

                                        <div class="my-3">
                                            <p>
                                                Under construction... I start my IT career since 1992 using FoxBase by IBM-compatible 286AT computer. Today my phone have more powerfull CPU :-) In Linux from ...
                                            </p>

                                        </div>

                                        <div class="my-3" uk-margin>
                                            <a class="ui tag label tiny">
                                                <i class="fa fa-pin"></i>
                                                3 days ago
                                            </a>

                                            <a class="ui tag label tiny violet">
                                                <i class="marker icon"></i>
                                                Chelsea
                                            </a>

                                            <a class="ui blue image label tiny">
                                                £35
                                                <div class="detail">Hourly</div>
                                            </a>

                                            <a href="" class="ui label tiny green">
                                                <i class="eye icon"></i>
                                                See details
                                            </a>
                                        </div>
                                    </div>
                                    <!--Right Slot-->
                                </div>
                            </div>

                            <div class="listing">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div style="position: relative;">
                                            <a href="/">
                                                <img src="/assets/company_logo_sample.jpg" alt="Dmitrii G.'s avatar"
                                                     class="vertical-align-middle img-thumbnail m-0">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 p-0-left">
                                        <div class="mb-1">
                                            <h4 class="main-heading"><a href="">Surveillance Manager</a></h4>
                                            <h4 class="m-0 freelancer-tile-title ellipsis sub-heading">
                                                Caja Studios, Inc.
                                                <div class="ui star rating mini" data-rating="4"></div>
                                            </h4>
                                        </div>

                                        <div class="my-3">
                                            <p>
                                                Under construction... I start my IT career since 1992 using FoxBase by IBM-compatible 286AT computer. Today my phone have more powerfull CPU :-) In Linux from ...
                                            </p>

                                        </div>

                                        <div class="my-3" uk-margin>
                                            <a class="ui tag label tiny">
                                                <i class="fa fa-pin"></i>
                                                3 days ago
                                            </a>

                                            <a class="ui blue image label tiny">
                                                £35
                                                <div class="detail">Hourly</div>
                                            </a>

                                            <a href="" class="ui label tiny green">
                                                <i class="eye icon"></i>
                                                See details
                                            </a>
                                        </div>
                                    </div>
                                    <!--Right Slot-->
                                </div>
                            </div>

                            <div class="listing">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div style="position: relative;">
                                            <a href="/">
                                                <img src="/assets/company_logo_sample.jpg" alt="Dmitrii G.'s avatar"
                                                     class="vertical-align-middle img-thumbnail m-0">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 p-0-left">
                                        <div class="mb-1">
                                            <h4 class="main-heading"><a href="">Surveillance Manager</a></h4>
                                            <h4 class="m-0 freelancer-tile-title ellipsis sub-heading">
                                                Caja Studios, Inc.
                                                <div class="ui star rating mini" data-rating="4"></div>
                                            </h4>
                                        </div>

                                        <div class="my-3">
                                            <p>
                                                Under construction... I start my IT career since 1992 using FoxBase by IBM-compatible 286AT computer. Today my phone have more powerfull CPU :-) In Linux from ...
                                            </p>

                                        </div>

                                        <div class="my-3" uk-margin>
                                            <a class="ui tag label tiny">
                                                <i class="fa fa-pin"></i>
                                                3 days ago
                                            </a>

                                            <a class="ui blue image label tiny">
                                                £35
                                                <div class="detail">Hourly</div>
                                            </a>

                                            <a href="" class="ui label tiny green">
                                                <i class="eye icon"></i>
                                                See details
                                            </a>
                                        </div>
                                    </div>
                                    <!--Right Slot-->
                                </div>
                            </div>

                            <div class="listing">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div style="position: relative;">
                                            <a href="/">
                                                <img src="/assets/company_logo_sample.jpg" alt="Dmitrii G.'s avatar"
                                                     class="vertical-align-middle img-thumbnail m-0">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 p-0-left">
                                        <div class="mb-1">
                                            <h4 class="main-heading"><a href="">Surveillance Manager</a></h4>
                                            <h4 class="m-0 freelancer-tile-title ellipsis sub-heading">
                                                Caja Studios, Inc.
                                                <div class="ui star rating mini" data-rating="4"></div>
                                            </h4>
                                        </div>

                                        <div class="my-3">
                                            <p>
                                                Under construction... I start my IT career since 1992 using FoxBase by IBM-compatible 286AT computer. Today my phone have more powerfull CPU :-) In Linux from ...
                                            </p>

                                        </div>

                                        <div class="my-3" uk-margin>
                                            <a class="ui tag label tiny">
                                                <i class="fa fa-pin"></i>
                                                3 days ago
                                            </a>

                                            <a class="ui blue image label tiny">
                                                £35
                                                <div class="detail">Hourly</div>
                                            </a>

                                            <a href="" class="ui label tiny green">
                                                <i class="eye icon"></i>
                                                See details
                                            </a>
                                        </div>
                                    </div>
                                    <!--Right Slot-->
                                </div>
                            </div>

                            <div class="listing">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div style="position: relative;">
                                            <a href="/">
                                                <img src="/assets/company_logo_sample.jpg" alt="Dmitrii G.'s avatar"
                                                     class="vertical-align-middle img-thumbnail m-0">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 p-0-left">
                                        <div class="mb-1">
                                            <h4 class="main-heading"><a href="">Surveillance Manager</a></h4>
                                            <h4 class="m-0 freelancer-tile-title ellipsis sub-heading">
                                                Caja Studios, Inc.
                                                <div class="ui star rating mini" data-rating="4"></div>
                                            </h4>
                                        </div>

                                        <div class="my-3">
                                            <p>
                                                Under construction... I start my IT career since 1992 using FoxBase by IBM-compatible 286AT computer. Today my phone have more powerfull CPU :-) In Linux from ...
                                            </p>

                                        </div>

                                        <div class="my-3" uk-margin>
                                            <a class="ui tag label tiny">
                                                <i class="fa fa-pin"></i>
                                                3 days ago
                                            </a>

                                            <a class="ui blue image label tiny">
                                                £35
                                                <div class="detail">Hourly</div>
                                            </a>

                                            <a href="" class="ui label tiny green">
                                                <i class="eye icon"></i>
                                                See details
                                            </a>
                                        </div>
                                    </div>
                                    <!--Right Slot-->
                                </div>
                            </div>

                            <div class="listing">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div style="position: relative;">
                                            <a href="/">
                                                <img src="/assets/company_logo_sample.jpg" alt="Dmitrii G.'s avatar"
                                                     class="vertical-align-middle img-thumbnail m-0">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 p-0-left">
                                        <div class="mb-1">
                                            <h4 class="main-heading"><a href="">Surveillance Manager</a></h4>
                                            <h4 class="m-0 freelancer-tile-title ellipsis sub-heading">
                                                Caja Studios, Inc.
                                                <div class="ui star rating mini" data-rating="4"></div>
                                            </h4>
                                        </div>

                                        <div class="my-3">
                                            <p>
                                                Under construction... I start my IT career since 1992 using FoxBase by IBM-compatible 286AT computer. Today my phone have more powerfull CPU :-) In Linux from ...
                                            </p>

                                        </div>

                                        <div class="my-3" uk-margin>
                                            <a class="ui tag label tiny">
                                                <i class="fa fa-pin"></i>
                                                3 days ago
                                            </a>

                                            <a class="ui blue image label tiny">
                                                £35
                                                <div class="detail">Hourly</div>
                                            </a>

                                            <a href="" class="ui label tiny green">
                                                <i class="eye icon"></i>
                                                See details
                                            </a>
                                        </div>
                                    </div>
                                    <!--Right Slot-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push("styles")

@endpush

@push("scripts")

@endpush
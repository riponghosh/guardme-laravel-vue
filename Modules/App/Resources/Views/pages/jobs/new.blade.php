@extends("app::layouts.site")

@section("site")
    <div class="uk-width-1-1 uk-background-cover uk-background-center-right uk-position-relative"
         style="background-image: url(/assets/security_man.jpg); height: 370px">
        <div class="overlay uk-position-top uk-height-1-1 grey lighten-4" style="opacity: 0.76;"></div>

        <div class="uk-position-center" style="z-index: 100;">
            <h1 class="uk-text-center uk-heading-bullet site-green-bullet">Post A Job</h1>
        </div>

        <div class="search-control-region uk-position-bottom" style="z-index: 200;">

            <div class="uk-container">
                <div class="uk-width-1-1">
                    <form class="uk-flex uk-flex-center" uk-grid>
                        <div class="uk-width-1-4@m">
                            <input class="uk-input" type="text" placeholder="What are you looking for?">
                        </div>

                        <div class="uk-width-1-4@m">
                            <input class="uk-input" type="text" placeholder="Region">
                        </div>

                        <div class="uk-width-1-5@m">
                            <button class="uk-button bg-site-green white-text">
                                Find Freelancers
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="uk-container uk-padding-large" >
        <div class="uk-width-2-5@m uk-margin-auto">
            <form class="" uk-grid>
                <div class="uk-width-1-1@m">
                    <div class="md-form">
                        <input placeholder="Enter company name" type="text" id="company_name" class="form-control">
                        <label for="company_name">Company</label>
                    </div>
                </div>

                <div class="uk-width-1-1@m">
                    <div class="md-form">
                        <input placeholder="Enter job title" type="text" id="title" class="form-control">
                        <label for="title">Job title:</label>
                    </div>
                </div>

                <div class="uk-width-1-1@m">
                    <div class="md-form">
                        <textarea type="text" id="description" class="md-textarea"
                                  placeholder="Enter job description..."></textarea>
                        <label for="description">Job description:</label>
                    </div>
                </div>

                <div class="uk-width-1-1@m">
                    <label for="description">Job categories:</label>
                    <div class="uk-form-controls uk-flex uk-flex-column">
                        <label><input class="uk-checkbox" type="checkbox"> Accounting</label>
                        <label><input class="uk-checkbox" type="checkbox"> Admin & HR</label>
                        <label><input class="uk-checkbox" type="checkbox"> Banking & Finance</label>
                        <label><input class="uk-checkbox" type="checkbox"> Beauty & care</label>
                    </div>
                </div>

                <div class="uk-width-1-1@m">
                    <div class="md-form">
                        <input placeholder="Enter job location" type="text" id="locations" class="form-control">
                        <label for="locations">Locations (options):</label>
                    </div>
                </div>

                <div class="uk-width-1-1@m">
                    <div class="md-form">
                        <button type="button" class="btn btn-success">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push("styles")
    <link rel="stylesheet" href="/build/css/pages/find-job.min.css">
    <style>
        div.text-animation div {
            display:inline-block;
            overflow:hidden;
            white-space:nowrap;
        }

        div.text-animation div:first-of-type {    /* For increasing performance
                       ID/Class should've been used.
                       For a small demo
                       it's okaish for now */
            animation: showup 7s infinite;
        }

        div.text-animation div:last-of-type {
            width:0px;
            animation: reveal 7s infinite;
        }

        div.text-animation div:last-of-type span {
            margin-left:-355px;
            animation: slidein 7s infinite;
        }

        @keyframes showup {
            0% {opacity:0;}
            20% {opacity:1;}
            80% {opacity:1;}
            100% {opacity:0;}
        }

        @keyframes slidein {
            0% { margin-left:-800px; }
            20% { margin-left:-800px; }
            35% { margin-left:0px; }
            100% { margin-left:0px; }
        }

        @keyframes reveal {
            0% {opacity:0;width:0px;}
            20% {opacity:1;width:0px;}
            30% {width:355px;}
            80% {opacity:1;}
            100% {opacity:0;width:355px;}
        }


        div.text-animation p {
            font-size:3rem;
            color:white;
            text-align: center;
            text-transform: capitalize;
        }
    </style>
@endpush

@push("scripts")

@endpush
@extends("app::layouts.site")

@section("site")
    <div class="uk-width-1-1 details-page uk-background-cover uk-background-center-right uk-position-relative hero-section"
         style="background-image: url(/assets/security_lady_man.jpg); ">
        <div class="overlay uk-position-top uk-height-1-1 grey lighten-4" style="opacity: 0.76;"></div>

        <div class="uk-position-center uk-width-large" style="z-index: 100; max-width: 700px;">
            <div class="row uk-flex uk-flex-middle">
                <div class="col-md-4" style="position: relative;">
                    <div class="circular-image-icons">
                        <div class="item z-depth-1" style="">
                            <div style="background-image: url(/assets/company_logo_sample.jpg)"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 p-0-left">
                    <h1 class="main-heading details-heading">Caja Studios, Inc.</h1>
                    <div class="ui star rating mini" data-rating="3"></div>
                </div>
                <!--Right Slot-->
            </div>
        </div>
    </div>

    <div class="p-1 bg-site-blue "></div>

    <div class="uk-width-1-1 uk-padding-large uk-padding-remove-horizontal">
        <div class="uk-container">
            <div class="uk-width-1-1 uk-margin-remove-left" uk-grid>
                <div class="uk-width-2-3@m">
                    <h2 class="uk-flex uk-flex-middle fg-site-blue">
                        <div class="ui right pointing label">
                            Job title:
                        </div>
                        Surveillance Manager
                    </h2>
                    <div>
                        <a class="ui tag label tiny violet">
                            <i class="marker icon"></i>
                            Chelsea
                        </a>

                        <a class="ui tag label tiny orange">
                            <i class="wait icon"></i>
                            Full time
                        </a>

                        <a class="ui blue image label tiny">
                            £35
                            <div class="detail">Hourly</div>
                        </a>
                    </div>
                    <div class="ui divider my-4"></div>
                    <div class="uk-margin-top">
                        <p>
                            Sed quis velit eleifend, vulputate lacus eu, porttitor leo. Nunc non urna quis eros vulputate
                            pellentesque a auctor dolor. Nulla non massa nec sem iaculis bibendum sed vitae quam.
                            Nullam non nibh augue. Aenean vestibulum pharetra mattis. Curabitur magna lectus, ornare ac ex et,
                            dapibus suscipit quam. Praesent ante dui, ornare a augue eget, luctus finibus nisl.
                            Vestibulum ut finibus enim.
                        </p>
                        <dl class="uk-description-list">
                            <dt>Experience</dt>
                            <dd> Experienced Krossover is looking for a Web Application Developer to join our team of
                                smart developers. We build web and mobile applications and games for coaches, athletes
                                and fans. If you're a talented programmer, and like sports and sports analytics, this is
                                the position for you.
                            </dd>
                        </dl>
                        <h4 class="uk-margin-large-top">What you will do:</h4>
                        <ul class="list">
                            <li>Build operations related applications for daily use</li>
                            <li>Create dashboards and daily / weekly reports</li>
                            <li>Architect features with the development team</li>
                            <li>PHP and/or JavaScript development. (We use Silex and AngularJS.)</li>
                        </ul>
                        <h4 class="uk-margin-top">What we are looking for:</h4>
                        <ul class="list">
                            <li>Experience with the web. Know your GET vs. POST</li>
                            <li>OOP concepts</li>
                            <li>A love of clean, understandable code and interface</li>
                            <li>You can SELECT, INSERT, UPDATE and DELETE in your SQL database all day</li>
                            <li>Experience working on a team</li>
                            <li>Smarts, humility, and the desire to teach and learn</li>
                        </ul>
                        <p> Krossover is a sports media and analytics startup that brings easy video breakdown and
                            in-depth analytics to coaches and athletes at all levels. Think Friday Night Lights meets
                            Moneyball. We're located in New York's Chelsea neighborhood. It's a spacious, sunny office
                            with not a single grey wall anywhere. Our culture is one of intelligence and collaboration.
                            Every now and then we talk sports. </p>
                        <p> We offer a competitive salary and benefits. </p>
                    </div>
                </div>
                <div class="uk-width-1-4@m">
                   <div class="uk-width-1-1">
                       <div>
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.288961208131!2d-0.08991633475780307!3d51.507914468487336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876035159bb13c5%3A0xa61e28267c3563ac!2sLondon+Bridge!5e0!3m2!1sen!2sng!4v1515159818514" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                       </div>
                       <div class="py-5">
                           <div class="details-controls uk-flex uk-flex-column uk-flex-right" uk-margin>
                               <button class="ui green button">Apply for this Job!</button>
                               <button class="ui green basic button"><i class="icon check"></i> Save this job</button>
                               <button class="ui red basic button"><i class="icon heart"></i> Add to favourites</button>
                               <button class="ui violet basic button"><i class="icon share alternate"></i> Share this job</button>
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

    <script>
        $('.ui.rating')
            .rating({
                initialRating: 3,
                maxRating: 5
            })
        ;
    </script>
@endpush
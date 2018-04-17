@extends('app::layouts.site')

@section('content')
    <div class="content-wrap">


    </div>
@endsection

@section('feature')
    <!-- Slider
    ============================================= -->
    <section id="slider" class="slider-element force-full-screen full-screen dark clearfix">

        <div class="force-full-screen full-screen">
            <div class="fslider" data-speed="3000" data-pause="7500" data-animation="fade" data-arrows="false" data-pagi="false" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; background-color: #333; z-index: 1;">
                <div class="flexslider" style="height: 100% !important;">
                    <div class="slider-wrap" style="height: inherit;">
                        <div class="slide uk-background-cover h-100"
                             style="background-image: url(/assets/img/security_lady_man.jpg) !important;"></div>
                        <div class="slide uk-background-cover h-100"
                             style="background-image: url(/assets/img/security_2.jpg) !important;"></div>
                        <div class="slide uk-background-cover h-100"
                             style="background-image: url(/assets/img/rail_security.jpg) !important;"></div>
                    </div>
                </div>
            </div>
            <div class="uk-position-bottom" style="z-index: 3; bottom: 0;">
                <div class="container clearfix ">
                    <div class="row">
                        <div class="col-sm-5 ">
                            <div class="">
                                <h2 class="display-3" style="line-height: 1em !important;">Manned Security Marketplace</h2>
                                <span class="t300 d-inline-block mt-1" style="font-size: 18px; color: rgba(255,255,255,0.9);">
                                    Choose from thousands of SIA vetted security staff
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-7 d-flex justify-content-end">
                            <div class="tabs advanced-real-estate-tabs nomargin clearfix" style="max-width: 450px;">
                                <div class="tab-container" style="background: rgba(8, 9, 12, 0.86) none repeat scroll 0 0;">
                                    <div class="tab-content clearfix" id="tab-buy">
                                        <h3 class="display-5 bottommargin-sm">Search Now</h3>
                                        <div class="row clearfix">
                                            <div class="col-12 bottommargin-sm">
                                                <input type="text" name="keyword"
                                                       placeholder="What are you looking for?"
                                                       class="form-control p-3 d-inline-block" />
                                            </div>
                                            <div class="col-12 bottommargin-sm">
                                                <input type="text" name="location"
                                                       placeholder="Location"
                                                       class="form-control p-3 d-inline-block" />
                                            </div>
                                            <div class="col-12">
                                                <button class="button button-3d button-rounded btn-block nomargin">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%; z-index:1;">
                <div class="video-overlay real-estate-video-overlay" style="z-index: 1;"></div>
            </div>
        </div>

    </section><!-- #slider end -->

@endsection

@push('styles')

@endpush
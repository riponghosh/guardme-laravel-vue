@extends('app::layouts.site')

@section('content')
    <div class="content-wrap">
        <div class="container clearfix" v-if="job">
            <div class="col_three_fifth nobottommargin listings">
                <div class="listing-item">
                    <div class="fancy-title ">
                        <h2>
                            @{{ job.title }}
                        </h2>
                    </div>

                    <div class="mb-3 mt-0">
                      <span v-for="category in job.categories" class="d-inline-block mr-3">
                         <i class="tag icon"></i>
                         @{{ category.name }}
                      </span>
                    </div>

                    <p v-html="job.description"></p>

                    <div class="mb-3">
                        <a class="ui blue image label tiny">
                            @{{ job.offer | currency }}
                            <div class="detail">Hourly</div>
                        </a>
                    </div>

                    @if(hasRole(config('guardme.acl.Job_Seeker')))
                        <a href="#" class="button button-3d button-black nomargin">Apply Now</a>
                    @endif

                    <div class="divider divider-short"><i class="icon-star3"></i></div>
                </div>
            </div>

            <div class="col_two_fifth nobottommargin col_last px-5">
                <google-map :name="job.id"
                            :height="450"
                            :markers="[{latitude: job.location.latitude,
                                        longitude: job.location.longitude}]">
                </google-map>
            </div>
        </div>
    </div>
@endsection

@section('feature')
    <!-- Page Title
		============================================= -->
    <section id="page-title" class="page-title-parallax page-title-dark page-title-center"
             style="background: url('/assets/img/security_lady_man.jpg') no-repeat center center / cover; padding: 90px 0;"
             data-stellar-background-ratio="1">

        <div class="container clearfix">
            <h1>Job Details</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/jobs">Job Listings</a></li>
                <li class="breadcrumb-item active">Details</li>
            </ol>
        </div>

        <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%; z-index:1;">
            <div class="video-overlay" style="background: rgba(0,0,0,0.8);"></div>
        </div>

    </section><!-- #page-title end -->
@endsection

@push('scripts')
    <script src="/build/js/jobs/job-details.min.js"></script>

@endpush

@push('styles')
    <meta name="jt" content="{{$job_token}}" >

@endpush
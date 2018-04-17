@extends("app::layouts.app")

@section('app')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-tasks"></i> Active Job Schedule </h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 uk-text-right uk-lead">
            You are logged in as: <span class="fg-site-theme">@{{ $root.app.user ? $root.app.user.primaryRole.name : '' }}</span>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-9">
            <div class="white-box">
                <div class="mb-2 uk-flex uk-flex-middle uk-flex-between">
                    <div class="ui mini icon input">
                        <input type="text" v-model="search_keyword" placeholder="Search...">
                        <i class="search icon"></i>
                    </div>
                    <div class="">
                        <div class="ui icon buttons">
                            <button class="ui button" @click="prev()"><i class="arrow left icon"></i></button>
                            <button class="ui button" @click="next()"><i class="arrow right icon"></i></button>
                        </div>
                    </div>
                </div>
                <div class="comment-center ui form" :class="{'loading' : jobs.loading}">
                    <div class="comment-body w-100" v-for="job in jobs.data">
                        <div class="h-100 user-img" style="width: 180px !important;">
                            <google-map :name="job.id"
                                        :height="130"
                                        :markers="[{latitude: job.location.latitude,
                                        longitude: job.location.longitude}]">
                            </google-map>
                        </div>
                        <div class="mail-contnet">
                            <h5><a :href="'/account/jobs/schedule/' + job.slug">@{{ job.title }}</a></h5>
                            <span class="mail-desc fluid d-block uk-overflow-hidden" v-html="job.description"></span>

                            <a href="#" class="label label-rouded label-info"><i class="icon pause"></i> Pause</a>
                            <a href="#" class="label label-rouded label-inverse"><i class="icon edit"></i> Edit</a>
                            <a :href="'/jobs/' + job.slug" target="_blank" class="label label-rouded label-warning">
                                <i class="icon unhide"></i> Preview
                            </a>
                            <span class="time pull-right uk-text-middle">
                                <i class="icon clock large "></i>
                                @{{ job.publishedOn.diff }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box text-center">
                        <h1 class="counter">@{{ jobs.total }}</h1>
                        <p class="">Active</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="white-box bg-info text-center">
                        <h1 class="counter text-white">0</h1>
                        <p class="text-white">Completed</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="white-box bg-warning text-center">
                        <h1 class="counter text-white">0</h1>
                        <p class="text-white">On-going</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .comment-center .mail-contnet .mail-desc {
            height: 76px;
        }
    </style>
@endpush

@push('scripts')
    <script src="/build/js/backend/jobs/active-schedule.min.js"></script>
@endpush
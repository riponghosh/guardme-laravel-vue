<div id="side-panel">


    <div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="icon-line-cross"></i></a></div>

    <div class="side-panel-wrap" id="auth">

        @include('app::partials.splashscreen')
        <div class="widget clearfix notopborder mt-0">

            <div class="uk-text-center mb-5">
                <div class="d-inline-block p-1 circular ui image bg-light"
                     style="width: 130px; height: 130px;">
                    <div class="p-2 h-100 fluid bg-white circular">
                        <div class="ui image uk-background-cover
                            white h-100 fluid"
                             style="background-image: url(/assets/img/logo.png)">
                        </div>
                    </div>
                </div>
            </div>

            <div v-show="page == 'login'">
                <gm-login></gm-login>
            </div>

            <div v-show="page == 'register'">
                <gm-register></gm-register>
            </div>

        </div>

    </div>

</div>

@push('scripts')

    <script src="/build/js/auth.min.js"></script>
@endpush
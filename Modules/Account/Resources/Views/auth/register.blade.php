@extends("app::layouts.pages")

@section("page_title")
    <h1 class="uk-text-center logo-heading">
        <span class="guard slant-background">Guard</span><span class="me slant-background">Me</span>
        <span class="uk-text-bold">Sign up</span>
    </h1>
@overwrite

@section('page')
    <div class="uk-width-1-3@m uk-margin-auto" id="app">

        <header class="main-header uk-text-center">
            <a href="/" class="main-logo"></a>
        </header>

        <h1 class="uk-text-center mb-4">Create your account</h1>

        <div class="my-5">
            <div class="social-connect uk-text-center" >
                <div class="uk-text-center uk-text-small p-0 mb-1">join with:</div>
                <div uk-margin>
                    <button class="ui circular facebook icon button">
                        <i class="facebook icon"></i>
                    </button>
                    <button class="ui circular twitter icon button">
                        <i class="twitter icon"></i>
                    </button>
                    <button class="ui circular linkedin icon button">
                        <i class="linkedin icon"></i>
                    </button>
                    <button class="ui circular google plus icon button">
                        <i class="google plus icon"></i>
                    </button>
                </div>
            </div>

            <h5 class="uk-heading-line uk-text-center my-5"><span>or</span></h5>

            <form @submit.prevent="register()" class="p-3">

                <div class="form-group">
                    <div class="ui left icon input fluid">
                        <input type="text" placeholder="Your Email:" v-model="registration.email">
                        <i class="envelope icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="ui left icon input fluid">
                        <input type="password" placeholder="Your password:" v-model="registration.password">
                        <i class="lock icon"></i>
                    </div>
                </div>

                <div class=" uk-margin-top">
                    <button class="ui button black tiny" type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>

        <div id="reg-modal" uk-modal="bgClose: false">
            <div class="uk-modal-dialog uk-modal-body uk-position-relative">

                <div class="uk-width-1-1 uk-position-top uk-margin-remove-left" uk-grid style="z-index: 20">
                    <div class="uk-width-3-4 p-1 bg-site-green"></div>
                    <div class="uk-width-1-4 p-1 bg-site-blue"></div>
                </div>

                <div class="uk-position-top uk-height-1-1 grey lighten-4"
                     style="z-index: 10"
                     v-show="sending">
                    <div class="loading p-4 uk-position-center uk-text-center">
                        <div class="ui active inline loader mini"></div>
                        <span class="fg-site-green d-inline-block ml-2">
                            @{{ message }}
                        </span>
                    </div>
                </div>

                <div class="my-3">
                    <img class="ui centered small image" src="/assets/guarddme_site_logo.png">
                </div>

                <form @submit.prevent="register()" class="py-3">

                    <div class="form-group">
                        <div class="ui left icon input fluid">
                            <input type="text" placeholder="Your Email:" v-model="registration.email">
                            <i class="envelope icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="ui left icon input fluid">
                            <input type="password" placeholder="Your password:" v-model="registration.password">
                            <i class="lock icon"></i>
                        </div>
                    </div>

                    <div class=" uk-margin-top">
                        <button class="ui button black tiny" type="submit">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @include("app::partials.app.splashscreen")
    </div>
@endsection

@push('scripts')
    <script src="/build/js/init.min.js"></script>
    <script src="/build/js/system.min.js"></script>
    <script src="/build/js/register.min.js"></script>
@endpush
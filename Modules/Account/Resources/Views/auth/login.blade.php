@extends("app::layouts.app")

@section("page_title")
    <h1 class="uk-text-center logo-heading">
        <span class="guard slant-background">Guard</span><span class="me slant-background">Me</span>
        <span class="uk-text-bold">Sign in</span>
    </h1>
@overwrite

@section('page')
    <div class="uk-width-1-3@m uk-margin-auto" id="app">

        <header class="main-header uk-text-center">
            <a href="/" class="main-logo"></a>
        </header>

        <h1 class="uk-text-center mb-4">Login to your account</h1>

        <div class="my-5">
            <form @submit.prevent="login()" class="px-4">

                <div class="form-group">
                    <div class="ui left icon input fluid">
                        <input type="text" placeholder="Your Email:" v-model="credentials.email">
                        <i class="envelope icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="ui left icon input fluid">
                        <input type="password" placeholder="Your Password:" v-model="credentials.password">
                        <i class="lock icon"></i>
                    </div>
                </div>

                <div class="text-center uk-margin-top">
                    <button class="ui blue bg-site-green button fluid tiny" type="submit">
                        Login
                    </button>
                </div>
            </form>

            <div class="divider ui my-5"></div>

            <div class="social-connect uk-text-center" >
                <div class="uk-text-center uk-text-small p-0 mb-1">or connect with:</div>
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
        </div>

        @include("app::partials.app.splashscreen")
    </div>
@endsection

@push('scripts')
    <script src="/build/js/system.min.js"></script>
    <script src="/build/js/login.min.js"></script>
@endpush
@extends('app::layouts.site')

@section('removable-site-head')

@overwrite
@section('content')
    <div class="content-wrap">

        <div class="container center clearfix">

            <div class="heading-block center">
                <div class="d-inline-block p-1 circular ui image grey lighten-4"
                     style="width: 260px; height: 260px;">
                    <div class="p-2 h-100 fluid white circular">
                        <div class="ui image uk-background-contain
                            white h-100 fluid"
                             style="background-image: url(/assets/img/logo.png)">
                        </div>
                    </div>
                </div>
                <h1>Your Account Has Been Created</h1>
                <span>Please check your mail to complete your profile.</span>
            </div>

            <p>

            </p>

            <a href="/" class="btn btn-secondary topmargin-sm">&lArr; Back to Site</a>

        </div>

    </div>

@endsection


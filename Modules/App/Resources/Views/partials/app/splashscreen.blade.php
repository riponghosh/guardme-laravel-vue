<div class="ui page inverted dimmer" id="splashscreen">
    <div class="content uk-position-relative">

        <div class="uk-width-1-1 uk-height-1-1 uk-position-top uk-position-fixed" style="z-index: 700"></div>

        <div class="center">
            <h1 class="uk-text-center logo-heading">
                <span class="guard slant-background">Guard</span><span class="me slant-background">Me</span>
            </h1>
            <div class="uk-text-center fg-site-green">
                <div class="ui active inline loader tiny"></div>

                @{{ $root.app.splashscreen.message.length ? $root.app.splashscreen.message : 'Please wait...' }}
            </div>
        </div>
    </div>
</div>
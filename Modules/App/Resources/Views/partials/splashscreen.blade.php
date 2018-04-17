<div class="ui inverted dimmer" id="splashscreen" style="z-index: 100000">
    <div class="content uk-position-relative">

        <div class="uk-width-1-1 uk-height-1-1 white uk-position-top uk-position-fixed"
             style="z-index: -10; opacity: 1"></div>

        <div class="h-100 fluid" style="z-index: 100000;">
            <div class='pin' style="z-index: 1000000;"></div>
            <div class='pulse' style="z-index: 100000;"></div>
        </div>

        <div class="white uk-text-center uk-position-bottom-center w-100 uk-position-large fg-site-blue"
             style="z-index: 100000; color: black" v-show="$root.app.splashscreen.message.length">
            @{{ $root.app.splashscreen.message }}
        </div>
    </div>
</div>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ config('app.name') }}</title>
</head>
<body>
<section id="content">

    <div class="content-wrap">

        <div class="container center clearfix">

            <div class="heading-block center">
                <div class="d-inline-block p-1 circular ui image grey lighten-4"
                     style="width: 160px; height: 160px;">
                    <div class="p-2 h-100 fluid white circular">
                        <div class="ui image uk-background-contain
                            white h-100 fluid"
                             style="background-image: url(/assets/img/logo.png)">
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

        </div>

    </div>

</section>
</body>
</html>
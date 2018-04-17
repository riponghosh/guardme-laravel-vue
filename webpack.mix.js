let mix = require('laravel-mix');

mix
    .sass('Sass/canvas/style.scss', 'public/build/css/site.theme.min.css')
    .sass('Sass/site/main.scss', 'public/build/css/site.main.min.css')
    .sass('Scripts/app.vendors.scss', 'public/build/css/app.vendors.bundle.css')
    .sass('Sass/backend/app.main.scss', 'public/build/css/app.bundle.css')

    .styles([
        'public/assets/canvas/theme/real-estate.css',
        'public/assets/canvas/theme/css/font-icons.css',
        'public/assets/canvas/css/font-icons.css',
        'public/assets/canvas/css/animate.css',
        'public/assets/canvas/css/magnific-popup.css',
        'public/assets/canvas/theme/fonts.css',
        'public/assets/canvas/css/components/bs-select.css',
        'public/assets/canvas/css/components/radio-checkbox.css',
        'public/assets/canvas/css/components/ion.rangeslider.css',
        'public/assets/canvas/css/responsive.css'
    ], 'public/build/css/site.vendors.bundle.min.css')

    .scripts([
        'Scripts/eliteAdmin/plugins/bower_components/jquery/dist/jquery.min.js',
        'Scripts/eliteAdmin/bootstrap/dist/js/tether.min.js',
        'Scripts/eliteAdmin/bootstrap/dist/js/bootstrap.min.js',
        'Scripts/eliteAdmin/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js',
        'Scripts/eliteAdmin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
        'Scripts/eliteAdmin/js/jquery.slimscroll.js',
        'Scripts/eliteAdmin/js/waves.js',
        'Scripts/eliteAdmin/js/custom.min.js',
        'Scripts/eliteAdmin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
        'public/assets/semantic-ui/semantic.min.js',
        'node_modules/uikit/dist/js/uikit.min.js'
    ], 'public/build/js/app.vendors.bundle.js')

    .scripts([
        'public/assets/canvas/js/jquery.js',
        'public/assets/canvas/js/plugins.js',
        'public/assets/canvas/js/jquery.gmap.js',
        'public/assets/canvas/js/components/bs-select.js',
        'public/assets/canvas/js/components/bs-switches.js',
        'public/assets/canvas/js/components/rangeslider.min.js',
        'public/assets/canvas/js/functions.js'
    ], 'public/build/js/site.vendors.bundle.min.js')

    .js('Vue/bootstrap/site.js', 'public/build/js/site.min.js')
    .ts('Vue/bootstrap/app.ts', 'public/build/js/app.min.js')
    .js('Vue/pages/auth.js', 'public/build/js/auth.min.js')
    .js('Vue/pages/dashboard/dashboard.js', 'public/build/js/backend/dashboard.min.js')
    
	.js('Vue/pages/jobs/create-job.js', 'public/build/js/jobs/create-job.min.js')
    .js('Vue/pages/jobs/active-schedule.js', 'public/build/js/backend/jobs/active-schedule.min.js')
    .js('Vue/pages/jobs/job-details.js', 'public/build/js/jobs/job-details.min.js')
    .js('Vue/pages/jobs/job-payment.js', 'public/build/js/jobs/job-payment.min.js')
    .js('Vue/pages/jobs/job-listing.js', 'public/build/js/jobs/job-listings.min.js')
    .js('Vue/pages/jobs/manage-job-schedule.js', 'public/build/js/backend/jobs/manage-job-schedule.min.js')
    
	.js('Vue/pages/tickets/tickets.js', 'public/build/js/backend/tickets/tickets.min.js')
    .js('Vue/pages/profile/profile.js', 'public/build/js/backend/profile/profile.min.js')
    
	.js('Vue/pages/profile/delete-request.js', 'public/build/js/backend/profile/delete-request.min.js')
    .js('Vue/pages/profile/users.js', 'public/build/js/backend/profile/users.min.js')
    .js('Vue/pages/profile/phone.js', 'public/build/js/backend/profile/phone.min.js')
    .js('Vue/pages/profile/email.js', 'public/build/js/backend/profile/email.min.js')
    .js('Vue/pages/users/index.js', 'public/build/js/backend/users/index.min.js')
    .js('Vue/pages/loyalty/loyalty.js', 'public/build/js/backend/loyalty/loyalty.min.js')
    .js('Vue/pages/loyalty/credit-history.js', 'public/build/js/backend/loyalty/credit-history.min.js')
    .js('Vue/pages/loyalty/redeem-credit.js', 'public/build/js/backend/loyalty/redeem-credit.min.js')
;

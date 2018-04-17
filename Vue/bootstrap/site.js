require('../../public/assets/semantic-ui/semantic.min');
window.UIkit = require('../../node_modules/uikit/dist/js/uikit.min.js');

jQuery(document).ready(function(){

    $(".price-range-slider").ionRangeSlider({
        type: "double",
        prefix: "$",
        min: 200,
        max: 10000,
        max_postfix: "+"
    });

    $(".area-range-slider").ionRangeSlider({
        type: "double",
        min: 50,
        max: 20000,
        from: 50,
        to: 20000,
        postfix: " sqm.",
        max_postfix: "+"
    });

    jQuery(".bt-switch").bootstrapSwitch();

});

jQuery(window).on( 'load', function(){

    // Google Map
    jQuery('#headquarters-map').gMap({
        address: 'New York, USA',
        maptype: 'ROADMAP',
        zoom: 13,
        markers: [
            {
                address: "New York, USA",
                html: "New York, USA",
                icon: {
                    image: "images/icons/map-icon-red.png",
                    iconsize: [32, 36],
                    iconanchor: [14,44]
                }
            }
        ],
        doubleclickzoom: false,
        controls: {
            panControl: false,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            overviewMapControl: false
        },
        styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"color":"#F0AD4E"},{"lightness":60}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#2C3E50"},{"visibility":"on"}]}]
    });

});
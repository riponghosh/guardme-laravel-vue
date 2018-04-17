(function () {
    // TODO setup side nav toggle
    $('.app-wrapper .side-nav ul.app-menu > li').click(function (e) {
        e.stopPropagation();

        var menu = $(this);
        var shouldToggleActive = !menu.hasClass('active');

        var openedMenu = $('.app-wrapper .side-nav ul.app-menu > li.active');
        openedMenu
            .removeClass('active')
            .children('ul.sub-menu')
            .removeClass('sub-menu-open')
        ;

        if(shouldToggleActive){
            menu.addClass('active');
            menu.children('ul.sub-menu')
                .addClass('sub-menu-open')
            ;

        }

        $(document).click(function () {
            menu
                .removeClass('active')
                .children('ul.sub-menu').removeClass('sub-menu-open');
        })
    })
})();
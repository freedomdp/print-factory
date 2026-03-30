jQuery(document).ready(function ($) {
    const $header = $('#site-header');
    const $drawer = $('#contacts-drawer');
    const $overlay = $('#contacts-drawer-overlay');
    const $toggle = $('#contacts-drawer-toggle');
    const $close = $('#contacts-drawer-close');
    const $body = $('body');

    // Sticky effect on scroll
    $(window).scroll(function () {
        if ($(this).scrollTop() > 10) {
            $header.addClass('scrolled');
        } else {
            $header.removeClass('scrolled');
        }
    });

    // Toggle Drawer
    function openDrawer() {
        $drawer.addClass('active');
        $overlay.addClass('active');
        $body.addClass('drawer-open');
    }

    function closeDrawer() {
        $drawer.removeClass('active');
        $overlay.removeClass('active');
        $body.removeClass('drawer-open');
    }

    $toggle.on('click', function (e) {
        e.preventDefault();
        openDrawer();
    });

    $close.on('click', function (e) {
        e.preventDefault();
        closeDrawer();
    });

    // Close on overlay click
    $overlay.on('click', function () {
        closeDrawer();
    });

    // Close on Escape key
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && $drawer.hasClass('active')) {
            closeDrawer();
        }
    });
});

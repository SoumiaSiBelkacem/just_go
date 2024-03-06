(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            $('#spinner').removeClass('show');
        }, 1);
    };
    spinner();
    
    // Initiate the wowjs
    new WOW().init();

    // Sticky Navbar
    $(window).scroll(function () {
        var navbar = $('.navbar');
        if ($(this).scrollTop() > 45) {
            navbar.addClass('sticky-top shadow-sm');
        } else {
            navbar.removeClass('sticky-top shadow-sm');
        }
    });

    // Back to top button
    var backToTop = $('.back-to-top');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            backToTop.fadeIn('slow');
        } else {
            backToTop.fadeOut('slow');
        }
    });

    backToTop.click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });
})(jQuery);

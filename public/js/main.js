(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            const spinner = $('#spinner')
            console.log('spinner', spinner[0]);
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('shadow-sm').css('top', '-100px');
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        loop: true,
        nav: false,
        dots: true,
        items: 1,
        dotsData: true,
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            }
        }
    });


    // Portfolio isotope and filter
    var portfolioIsotope = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
    });
    $('#portfolio-flters li').on('click', function () {
        $("#portfolio-flters li").removeClass('active');
        $(this).addClass('active');

        portfolioIsotope.isotope({filter: $(this).data('filter')});
    });


})(jQuery);
// $(document).ready(function () {
// //  SLIDER
//     var slider = $('#slider-wp .section-detail');
//     slider.owlCarousel({
//         autoPlay: 4500,
//         navigation: false,
//         navigationText: false,
//         paginationNumbers: false,
//         pagination: true,
//         items: 1, //10 items above 1000px browser width
//         itemsDesktop: [1000, 1], //5 items between 1000px and 901px
//         itemsDesktopSmall: [900, 1], // betweem 900px and 601px
//         itemsTablet: [600, 1], //2 items between 600 and 0
//         itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
//     });
//
// //  ZOOM PRODUCT DETAIL
//     $("#zoom").elevateZoom({gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});
//
// //  LIST THUMB
//     var list_thumb = $('#list-thumb');
//     list_thumb.owlCarousel({
//         navigation: true,
//         navigationText: false,
//         paginationNumbers: false,
//         pagination: false,
//         stopOnHover: true,
//         items: 5, //10 items above 1000px browser width
//         itemsDesktop: [1000, 5], //5 items between 1000px and 901px
//         itemsDesktopSmall: [900, 5], // betweem 900px and 601px
//         itemsTablet: [768, 5], //2 items between 600 and 0
//         itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
//     });
//
// //  FEATURE PRODUCT
//     var feature_product = $('#feature-product-wp .list-item');
//     feature_product.owlCarousel({
//         autoPlay: true,
//         navigation: true,
//         navigationText: false,
//         paginationNumbers: false,
//         pagination: false,
//         stopOnHover: true,
//         items: 4, //10 items above 1000px browser width
//         itemsDesktop: [1000, 4], //5 items between 1000px and 901px
//         itemsDesktopSmall: [800, 3], // betweem 900px and 601px
//         itemsTablet: [600, 2], //2 items between 600 and 0
//         itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
//     });
//
// //  SAME CATEGORY
//     var same_category = $('#same-category-wp .list-item');
//     same_category.owlCarousel({
//         autoPlay: true,
//         navigation: true,
//         navigationText: false,
//         paginationNumbers: false,
//         pagination: false,
//         stopOnHover: true,
//         items: 4, //10 items above 1000px browser width
//         itemsDesktop: [1000, 4], //5 items between 1000px and 901px
//         itemsDesktopSmall: [800, 3], // betweem 900px and 601px
//         itemsTablet: [600, 2], //2 items between 600 and 0
//         itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
//     });
//
// //  SCROLL TOP
//     $(window).scroll(function () {
//         if ($(this).scrollTop() != 0) {
//             $('#btn-top').stop().fadeIn(150);
//         } else {
//             $('#btn-top').stop().fadeOut(150);
//         }
//     });
//     $('#btn-top').click(function () {
//         $('body,html').stop().animate({scrollTop: 0}, 800);
//     });
//
// // CHOOSE NUMBER ORDER
//     var value = parseInt($('#num-order').attr('value'));
//     $('#plus').click(function () {
//         value++;
//         $('#num-order').attr('value', value);
//         update_href(value);
//     });
//     $('#minus').click(function () {
//         if (value > 1) {
//             value--;
//             $('#num-order').attr('value', value);
//         }
//         update_href(value);
//     });
//
// //  MAIN MENU
//     $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');
//
// //  TAB
//     tab();
//
//     //  EVEN MENU RESPON
//     $('html').on('click', function (event) {
//         var target = $(event.target);
//         var site = $('#site');
//
//         if (target.is('#btn-respon i')) {
//             if (!site.hasClass('show-respon-menu')) {
//                 site.addClass('show-respon-menu');
//             } else {
//                 site.removeClass('show-respon-menu');
//             }
//         } else {
//             $('#container').click(function () {
//                 if (site.hasClass('show-respon-menu')) {
//                     site.removeClass('show-respon-menu');
//                     return false;
//                 }
//             });
//         }
//     });
//
// //  MENU RESPON
//     $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
//     $('#main-menu-respon li .arrow').click(function () {
//         if ($(this).parent('li').hasClass('open')) {
//             $(this).parent('li').removeClass('open');
//         } else {
//
// //            $('.sub-menu').slideUp();
// //            $('#main-menu-respon li').removeClass('open');
//             $(this).parent('li').addClass('open');
// //            $(this).parent('li').find('.sub-menu').slideDown();
//         }
//     });
// });
//
// function tab() {
//     var tab_menu = $('#tab-menu li');
//     tab_menu.stop().click(function () {
//         $('#tab-menu li').removeClass('show');
//         $(this).addClass('show');
//         var id = $(this).find('a').attr('href');
//         $('.tabItem').hide();
//         $(id).show();
//         return false;
//     });
//     $('#tab-menu li:first-child').addClass('show');
//     $('.tabItem:first-child').show();
// }

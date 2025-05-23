(function ($) {
    "use strict"; // Start of use strict
    // Owl carousel
    $(".sliderhome").owlCarousel({
        navigation: true,
        pagination: false,
        loop: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        slideSpeed: 3000,
        paginationSpeed: 3000,
        nav: true,
        items: 1,
    });
    $(".home-products").owlCarousel({
        navigation: true,
        pagination: false,
        nav: true,
        dots: false,
        loop: true,
        autoplay: false,
        margin: 0,
        items: 4,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });
    function init_carousel() {
        $('.owl-product').owlCarousel({
            items: 1,
            thumbs: true,
            thumbsPrerendered: true,
        });
        $(".owl-carousel").each(function (index, el) {
            var config = $(this).data();
//            config.navText = ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'];
            var animateOut = $(this).data('animateout');
            var animateIn = $(this).data('animatein');
            var slidespeed = $(this).data('slidespeed');
            if (typeof animateOut != 'undefined') {
                config.animateOut = animateOut;
            }
            if (typeof animateIn != 'undefined') {
                config.animateIn = animateIn;
            }
            if (typeof (slidespeed) != 'undefined') {
                config.smartSpeed = slidespeed;
            }
            var owl = $(this);
            owl.on('initialized.owl.carousel', function (event) {
                var total_active = owl.find('.owl-item.active').length;
                var i = 0;
                owl.find('.owl-item').removeClass('item-first item-last');
                setTimeout(function () {
                    owl.find('.owl-item.active').each(function () {
                        i++;
                        if (i == 1) {
                            $(this).addClass('item-first');
                        }
                        if (i == total_active) {
                            $(this).addClass('item-last');
                        }
                    });
                }, 100);
            })
            owl.on('refreshed.owl.carousel', function (event) {
                var total_active = owl.find('.owl-item.active').length;
                var i = 0;
                owl.find('.owl-item').removeClass('item-first item-last');
                setTimeout(function () {
                    owl.find('.owl-item.active').each(function () {
                        i++;
                        if (i == 1) {
                            $(this).addClass('item-first');
                        }
                        if (i == total_active) {
                            $(this).addClass('item-last');
                        }
                    });
                }, 100);
            })
            owl.on('change.owl.carousel', function (event) {
                var total_active = owl.find('.owl-item.active').length;
                var i = 0;
                owl.find('.owl-item').removeClass('item-first item-last');
                setTimeout(function () {
                    owl.find('.owl-item.active').each(function () {
                        i++;
                        if (i == 1) {
                            $(this).addClass('item-first');
                        }
                        if (i == total_active) {
                            $(this).addClass('item-last');
                        }
                    });
                }, 100);
                owl.addClass('owl-changed');
                setTimeout(function () {
                    owl.removeClass('owl-changed');
                }, config.smartSpeed)
            })
            owl.on('drag.owl.carousel', function (event) {
                owl.addClass('owl-changed');
                setTimeout(function () {
                    owl.removeClass('owl-changed');
                }, config.smartSpeed)
            })
            owl.owlCarousel(config);
        });
    }


// MENU REPONSIIVE
//Sticky header
    function sticky_header() {
        var height_sticky = $('.vertical-menu-list').height();
        var offset = $('.vertical-menu-list').offset();
        if ($('.header-sticky').length > 0) {
            $('.header-sticky').sticky({
                topSpacing: 0
            });
            if ($('#box-vertical-megamenus').length > 0) {
                $(window).scroll(function (event) {
                    var scroll = $(window).scrollTop();
                    if (scroll > (height_sticky + offset.top)) {
                        $('.header-sticky').parent().addClass('is-sticky');
                        $('.header-sticky').css('position', 'fixed');
                        $(".vertical-menu-content").addClass('show');
                    } else {
                        $('.header-sticky').css('position', 'relative');
                        $('.header-sticky').parent().removeClass('is-sticky');
                        $(".vertical-menu-content").removeClass('show');
                    }
                });
            }
        }
    }
//Sticky product


//EQUAL ELEM
    function better_equal_elems() {
        setTimeout(function () {
            $('.equal-container').each(function () {
                var $this = $(this);
                if ($this.find('.equal-elem').length) {
                    $this.find('.equal-elem').css({
                        'height': 'auto'
                    });
                    var elem_height = 0;
                    $this.find('.equal-elem').each(function () {
                        var this_elem_h = parseFloat($(this).height());
                        if (elem_height < this_elem_h) {
                            elem_height = this_elem_h;
                        }
                    });
                    $this.find('.equal-elem').height(elem_height);
                }
            });
        }, 3000);
    }
    /* ---------------------------------------------
     Scripts initialization
     --------------------------------------------- */
    $(window).load(function () {
        better_equal_elems();
    });
    /* ---------------------------------------------
     Scripts resize
     --------------------------------------------- */
    $(window).on("resize", function () {
        better_equal_elems();
    });
    /* ---------------------------------------------
     Scripts ready
     --------------------------------------------- */
    $(document).ready(function () {
//Wow animate
        new WOW().init();
        sticky_header();
        // OWL CAROUSEL
        init_carousel();
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#scrollup').fadeIn();
            } else {
                $('#scrollup').fadeOut();
            }
        });
        $('#scrollup').on('click', function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
        $(document).on('click', '.quantity .plus, .quantity .minus', function (e) {
// Get values
            var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');
            // Format values
            if (!currentVal || currentVal === '' || currentVal === 'NaN')
                currentVal = 0;
            if (max === '' || max === 'NaN')
                max = '';
            if (min === '' || min === 'NaN')
                min = 0;
            if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
                step = 1;
            // Change the value
            if ($(this).is('.plus')) {
                if (max && (max == currentVal || currentVal > max)) {
                    $qty.val(max);
                } else {
                    $qty.val(currentVal + parseFloat(step));
                }
            } else {
                if (min && (min == currentVal || currentVal < min)) {
                    $qty.val(min);
                } else if (currentVal > 0) {
                    $qty.val(currentVal - parseFloat(step));
                }
            }
// Trigger change event
            $qty.trigger('change');
            e.preventDefault();
        });
        // menu on mobile
        $(".header-nav .toggle-submenu").on('click', function () {
            $(this).parent().toggleClass('open-submenu');
            return false;
        });
        $(".box-vertical-megamenus .toggle-submenu").on('click', function () {
            $(this).parent().toggleClass('open-submenu');
            return false;
        });
        $("[data-action='toggle-nav']").on('click', function () {
            $(this).toggleClass('active');
            $(".header-nav").toggleClass("has-open");
            return false;
        });
        $(".header-menu .btn-close").on('click', function () {
            $('.header-nav').removeClass('has-open');
            return false;
        });
        // vertical megamenu click
        $(".box-vertical-megamenus .title").on('click', function () {
            $(this).toggleClass('active');
            $(this).parent().toggleClass('has-open');
            return false;
        });
        $(".vertical-menu-content .btn-close").on('click', function () {
            $('.box-vertical-megamenus').removeClass('has-open');
            return false;
        });
        //chosen-select
        if ($('.chosen-select').length > 0) {
            $('.chosen-select').chosen();
        }
//categories click

        $(".scroll-pane").mCustomScrollbar({
            advanced: {
                updateOnContentResize: true

            },
            scrollButtons: {
                enable: false
            },
            mouseWheelPixels: "200",
            theme: "dark-2"

        });
        $(".smoothscroll").mCustomScrollbar({
            advanced: {
                updateOnContentResize: true

            },
            scrollButtons: {
                enable: false
            },
            mouseWheelPixels: "100",
            theme: "dark-2"

        });
        $('.collapseWill').on('click', function (e) {
            $(this).toggleClass("pressed"); //you can list several class names 
            e.preventDefault();
        });
        $('.sp-wrap').smoothproducts();
    });
    $('.masterKeynet').on('click', function (e) {
        $(this).addClass("cut-radio-style");
        $('.masterCard').removeClass("cut-radio-style");
    });
    $('.masterCard').on('click', function (e) {
        $(this).addClass("cut-radio-style");
        $('.masterKeynet').removeClass("cut-radio-style");
    });
})(jQuery); // End of use strict
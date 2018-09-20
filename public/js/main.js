(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {

        // Dropdown-menu Arro icon effect
        if ($.fn.siblings) {
            jQuery('.drop-menu').siblings('a').addClass('sub-siblings');

        }
        if ($.fn.owlCarousel) {
            $('.price-silder-wrapper').owlCarousel({
                loop: true,
                items: 4,
                margin: 30,
                nav: true,
                navText: ['<img src="img/arow-left.png">', '<img src="img/arow-right.png">'],
                autoplay: false,
                responsiveClass: true,
                responsive: {
                    300: {
                        items: 1
                    },
                    480: {
                        items: 1
                    },
                    768: {
                        items: 3,
                        margin: 10
                    },
                    992: {
                        items: 4
                    }
                }
            });
        }
        // Domain Checked
        $('.domain-cart').on('click', function () {
            $(this).toggleClass('checked');
        });

        // SlickNav js
        if ($.fn.slicknav) {
            $('#mainmenu').slicknav({
                allowParentLinks: true,
                closedSymbol: '<i class="fa fa-angle-right"></i>',
                openedSymbol: '<i class="fa fa-angle-down"></i>',
            });
        }

        // wow.js
        new WOW().init();

        // jQuery nice select
        if ($.fn.niceSelect) {
            $('.input-2 select').niceSelect();
        }
        
        // MagnificPopUp for Video 
        if ($.fn.magnificPopup) {
            $(".video-play-btn").magnificPopup({
                type: 'video',
                src: 'img/video-img.jpg',
            });
        }
        
        
        // Home Page Google Map DropDown 
        
        // for Toronto
        $('.single-location.toronto').on('click', function(){
            $(this).toggleClass('popup-dropdown');
        });
        $('.single-location.newyork').on('click', function(){
            $('.single-location.toronto').removeClass('popup-dropdown');
        });
        $('.single-location.sanfrancisco').on('click', function(){
            $('.single-location.toronto').removeClass('popup-dropdown');
        });
        $('.single-location.london').on('click', function(){
            $('.single-location.toronto').removeClass('popup-dropdown');
        });
        $('.single-location.singapore').on('click', function(){
            $('.single-location.toronto').removeClass('popup-dropdown');
        });
        
        
       // for newyork
        $('.single-location.newyork').on('click', function(){
            $(this).toggleClass('popup-dropdown');
        });
        $('.single-location.toronto').on('click', function(){
            $('.single-location.newyork').removeClass('popup-dropdown');
        });
        $('.single-location.sanfrancisco').on('click', function(){
            $('.single-location.newyork').removeClass('popup-dropdown');
        });
        $('.single-location.london').on('click', function(){
            $('.single-location.newyork').removeClass('popup-dropdown');
        });
        $('.single-location.singapore').on('click', function(){
            $('.single-location.newyork').removeClass('popup-dropdown');
        });
        
       // for sanfrancisco
        $('.single-location.sanfrancisco').on('click', function(){
            $(this).toggleClass('popup-dropdown');
        });
        $('.single-location.newyork').on('click', function(){
            $('.single-location.sanfrancisco').removeClass('popup-dropdown');
        });
        $('.single-location.toronto').on('click', function(){
            $('.single-location.sanfrancisco').removeClass('popup-dropdown');
        });
        $('.single-location.london').on('click', function(){
            $('.single-location.sanfrancisco').removeClass('popup-dropdown');
        });
        $('.single-location.singapore').on('click', function(){
            $('.single-location.sanfrancisco').removeClass('popup-dropdown');
        });
        
       // for london
        $('.single-location.london').on('click', function(){
            $(this).toggleClass('popup-dropdown');
        });
        $('.single-location.newyork').on('click', function(){
            $('.single-location.london').removeClass('popup-dropdown');
        });
        $('.single-location.sanfrancisco').on('click', function(){
            $('.single-location.london').removeClass('popup-dropdown');
        });
        $('.single-location.toronto').on('click', function(){
            $('.single-location.london').removeClass('popup-dropdown');
        });
        $('.single-location.singapore').on('click', function(){
            $('.single-location.london').removeClass('popup-dropdown');
        });
        
        // for singapore
        $('.single-location.singapore').on('click', function(){
            $(this).toggleClass('popup-dropdown');
        });
        $('.single-location.newyork').on('click', function(){
            $('.single-location.singapore').removeClass('popup-dropdown');
        });
        $('.single-location.sanfrancisco').on('click', function(){
            $('.single-location.singapore').removeClass('popup-dropdown');
        });
        $('.single-location.toronto').on('click', function(){
            $('.single-location.singapore').removeClass('popup-dropdown');
        });
        $('.single-location.london').on('click', function(){
            $('.single-location.singapore').removeClass('popup-dropdown');
        });
        
        
//          single-issue-one                          
                                    
          // for singapore
        $('.single-issue-one').on('click', function(){
            $('.single-issue-two').removeClass('active-issue');
            $('.single-issue-three').removeClass('active-issue');
            $(this).addClass('active-issue');
        });
         $('.single-issue-two').on('click', function(){
            $('.single-issue-one').removeClass('active-issue');
            $('.single-issue-three').removeClass('active-issue');
            $('.single-issue-two').addClass('active-issue');
        });
        $('.single-issue-three').on('click', function(){
            $('.single-issue-one').removeClass('active-issue');
            $('.single-issue-two').removeClass('active-issue');
            $('.single-issue-three').addClass('active-issue');
        });
        
//        $('.single-location.newyork').click(function(){
//            $('.single-location.singapore').removeClass('popup-dropdown');
//        });
//        $('.single-location.sanfrancisco').click(function(){
//            $('.single-location.singapore').removeClass('popup-dropdown');
//        });
//        $('.single-location.toronto').click(function(){
//            $('.single-location.singapore').removeClass('popup-dropdown');
//        });
//        $('.single-location.london').click(function(){
//            $('.single-location.singapore').removeClass('popup-dropdown');
//        });                          
                                    
                                    
                                    
                                    
                                    
    });


    $(window).on('load', function () {
        $('#cssload-wrapper').fadeOut('500', function () {
            $(this).remove();
        });

        jQuery('.cssload-loader').fadeOut(1000, function () {
            $(this).remove();
        });

    });

}(jQuery));
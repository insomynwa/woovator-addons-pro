(function($){
"use strict";

    
    var WidgetThumbnailsSliderHandler = function ($scope, $) {

        var slider_elem = $scope.find('.wv-thumbnails-slider').eq(0);

        if ( slider_elem.length > 0 ) {

            var settings = slider_elem.data('settings');
            var arrows = settings['arrows'];
            var dots = settings['dots'];
            var autoplay = settings['autoplay'];
            var rtl = settings['rtl'];
            var autoplay_speed = parseInt(settings['autoplay_speed']) || 3000;
            var animation_speed = parseInt(settings['animation_speed']) || 300;
            var fade = settings['fade'];
            var pause_on_hover = settings['pause_on_hover'];
            var display_columns = parseInt(settings['product_items']) || 4;
            var scroll_columns = parseInt(settings['scroll_columns']) || 4;
            var tablet_width = parseInt(settings['tablet_width']) || 800;
            var tablet_display_columns = parseInt(settings['tablet_display_columns']) || 2;
            var tablet_scroll_columns = parseInt(settings['tablet_scroll_columns']) || 2;
            var mobile_width = parseInt(settings['mobile_width']) || 480;
            var mobile_display_columns = parseInt(settings['mobile_display_columns']) || 1;
            var mobile_scroll_columns = parseInt(settings['mobile_scroll_columns']) || 1;

            slider_elem.slick({
                arrows: arrows,
                prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
                dots: dots,
                infinite: true,
                autoplay: autoplay,
                autoplaySpeed: autoplay_speed,
                speed: animation_speed,
                fade: false,
                pauseOnHover: pause_on_hover,
                slidesToShow: display_columns,
                slidesToScroll: scroll_columns,
                rtl: rtl,
                responsive: [
                    {
                        breakpoint: tablet_width,
                        settings: {
                            slidesToShow: tablet_display_columns,
                            slidesToScroll: tablet_scroll_columns
                        }
                    },
                    {
                        breakpoint: mobile_width,
                        settings: {
                            slidesToShow: mobile_display_columns,
                            slidesToScroll: mobile_scroll_columns
                        }
                    }
                ]
            });
        };
    }

    // Product thumbnais varition with tab
    function woovator_thumbnails_tab_with_variation( $thumbnais ){
        $thumbnais.on('click', 'li', function(e){
            e.preventDefault();
            var $this = $(this),
                $image = $this.data('wvimage');
            $( '.woocommerce-product-gallery__image .wp-post-image' ).attr( "src", $image );
            $( '.woocommerce-product-gallery__image .wp-post-image' ).attr( "srcset", $image );
        });
    }
    var WidgetThumbnaisImagesHandlerPro = function woovatorthumbnailspro(){
        woovator_thumbnails_tab_with_variation( $(".woovator-thumbanis-image") );
    }


    //Tool-tips
    function woovator_tool_tips_pro(element, content) {
        if (content == 'html') {
            var tipText = element.html();
        } else {
            var tipText = element.attr('title');
        }
        element.on('mouseover', function() {
            if ($('.woovator-tip').length == 0) {
                element.before('<span class="woovator-tip">' + tipText + '</span>');
                $('.woovator-tip').css('transition', 'all 0.5s ease 0s');
                $('.woovator-tip').css('margin-left', 0);
            }
        });
        element.on('mouseleave', function() {
            $('.woovator-tip').remove();
        });
    }

    // Custom Tab
    function woovator_tabs_pro( $tabmenus, $tabpane ){
        $tabmenus.on('click', 'a', function(e){
            e.preventDefault();
            var $this = $(this),
                $target = $this.attr('href');
            $this.addClass('htactive').parent().siblings().children('a').removeClass('htactive');
            $( $tabpane + $target ).addClass('htactive').siblings().removeClass('htactive');

            // slick refresh
            var $id = $this.attr('href');
            $($id).find('.slick-slider').slick('refresh');

        });
    }

    //Tooltip
    var WidgetWoovatorTooltipHandlerpro = function woovator_tool_tip_pro(){
        $('a.woovator-compare').each(function() {
            woovator_tool_tips_pro($(this), 'title');
        });
        $('.woovator-cart a.add_to_cart_button,.woovator-cart a.added_to_cart,.woovator-cart a.button').each(function() {
            woovator_tool_tips_pro($(this), 'html');
        });
    }

    // image handler
    var WidgetThumbnaisShopHandlerPro = function thumbnailsimagescontrollerpro(){
        woovator_tabs_pro( $(".ht-product-cus-tab-links"), '.ht-product-cus-tab-pane' );
        woovator_tabs_pro( $(".ht-tab-menus"), '.ht-tab-pane' );

        // Countdown
        var finalTime, daysTime, hours, minutes, second;
        $('.ht-product-countdown').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            var customlavel = $(this).data('customlavel');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('<div class="cd-single"><div class="cd-single-inner"><h3>%D</h3><p>'+customlavel.daytxt+'</p></div></div><div class="cd-single"><div class="cd-single-inner"><h3>%H</h3><p>'+customlavel.hourtxt+'</p></div></div><div class="cd-single"><div class="cd-single-inner"><h3>%M</h3><p>'+customlavel.minutestxt+'</p></div></div><div class="cd-single"><div class="cd-single-inner"><h3>%S</h3><p>'+customlavel.secondstxt+'</p></div></div>'));
            });
        });

    }
    
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wv-product-thumbnails-image.default', WidgetThumbnaisImagesHandlerPro);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wv-product-thumbnails-image.default', WidgetThumbnailsSliderHandler);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/woovator-custom-product-archive.default', WidgetThumbnaisShopHandlerPro);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wv-product-sale-schedule.default', WidgetThumbnaisShopHandlerPro);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/woovator-custom-product-archive.default', WidgetWoovatorTooltipHandlerpro);
    });

})(jQuery);
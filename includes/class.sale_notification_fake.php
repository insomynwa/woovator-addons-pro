<?php
/**
* Class Sale Notification
*/
class Woovator_Sale_Notification{

    private static $_instance = null;
    public static function instance(){
        if( is_null( self::$_instance ) ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'woovator_inline_styles' ] );
        add_action( 'wp_footer', [ $this, 'woovator_ajax_request' ] );
    }

    public function enqueue_scripts(){
        wp_localize_script( 'woovator-mainjs', 'porduct_fake_data', $this->woovator_fakes_notification_data() );
    }

    public function woovator_fakes_notification_data(){
        $notification = array();
        foreach( woovator_get_option_pro( 'noification_fake_data','woovator_sales_notification_tabs', '' ) as $key => $fakedata ) 
        {
            $nc = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $fakedata );
            array_push( $notification, $nc );
        }
        return $notification;
    }

    // Inline CSS
    function woovator_inline_styles() {
        $crosscolor = woovator_get_option_pro( 'cross_color','woovator_sales_notification_tabs', '#000000' );
        $custom_css = "
            .wvcross{
                color: {$crosscolor} !important;
            }";
        wp_add_inline_style( 'woovator-widgets-pro', $custom_css );
    }

    // Ajax request
    function woovator_ajax_request() {

        $intervaltime  = (int)woovator_get_option_pro( 'notification_time_int','woovator_sales_notification_tabs', '4' )*1000;
        $duration      = (int)woovator_get_option_pro( 'notification_loadduration','woovator_sales_notification_tabs', '3' )*1000;
        $inanimation   = woovator_get_option_pro( 'notification_inanimation','woovator_sales_notification_tabs', 'fadeInLeft' );
        $outanimation  = woovator_get_option_pro( 'notification_outanimation','woovator_sales_notification_tabs', 'fadeOutRight' );
        $notposition  = woovator_get_option_pro( 'notification_pos','woovator_sales_notification_tabs', 'bottomleft' );

       
        ?>
            <script>
                jQuery( document ).ready( function( $ ) {

                    var notposition = '<?php echo $notposition; ?>';

                    $('body').append('<div class="woovator-sale-notification"><div class="notifake woovator-notification-content '+notposition+'"></div></div>');

                    var intervaltime = <?php echo $intervaltime; ?>,
                        i = 0,
                        duration = <?php echo $duration; ?>,
                        inanimation = '<?php echo $inanimation; ?>',
                        outanimation = '<?php echo $outanimation; ?>';

                    window.setTimeout( function(){
                        setInterval(function() {
                            if( i == porduct_fake_data.length ){ i = 0; }
                            $('.woovator-notification-content').html('');
                            var ordercontent = `${ porduct_fake_data[i] }<span class="wvcross">&times;</span>`;
                            $('.woovator-notification-content').append( ordercontent ).addClass('animated '+inanimation).removeClass(outanimation);
                            setTimeout(function() {
                                $('.woovator-notification-content').removeClass(inanimation).addClass(outanimation);
                            }, intervaltime-500 );
                            i++;
                        }, intervaltime );
                    }, duration );

                    // Close Button
                    $('.woovator-notification-content').on('click', '.wvcross', function(e){
                        e.preventDefault()
                        $(this).closest('.woovator-notification-content').removeClass(inanimation).addClass(outanimation);
                    });

                });
            </script>
        <?php 
    }



}

Woovator_Sale_Notification::instance();
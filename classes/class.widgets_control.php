<?php

namespace WooVatorPro;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Widgets Control
*/
class Widgets_Control{
    
    private static $instance = null;
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function __construct(){
        $this->init();
    }

    public function init() {

        // Register custom category
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

        // Init Widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

    }

    // Add custom category.
    public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'woovator-addons-pro',
            [
               'title'  => __( 'Woovator Pro','woovator-pro'),
                'icon' => 'font',
            ]
        );
    }

    // Widgets Register
    public function init_widgets(){

        $wv_element_manager = array(
            'universal_product',
        );
        if( woovator_get_option_pro( 'ajaxsearch', 'woovator_others_tabs', 'off' ) == 'on' ){
            $wv_element_manager[] = 'ajax_search_form';
        }

        // WooCommerce Builder
        if( woovator_get_option_pro( 'enablecustomlayout', 'woovator_woo_template_tabs', 'on' ) == 'on' ){
            $wvb_element  = array(
                'wv_custom_archive_layout',
                'wv_cart_table',
                'wv_cart_total',
                'wv_cartempty_message',
                'wv_cartempty_shopredirect',
                'wv_cross_sell',
                'wv_checkout_additional_form',
                'wv_checkout_billing',
                'wv_checkout_shipping_form',
                'wv_checkout_payment',
                'wv_checkout_coupon_form',
                'wv_checkout_login_form',
                'wv_order_review',
                'wv_myaccount_account',
                'wv_myaccount_dashboard',
                'wv_myaccount_download',
                'wv_myaccount_edit_account',
                'wv_myaccount_address',
                'wv_myaccount_login_form',
                'wv_myaccount_register_form',
                'wv_myaccount_logout',
                'wv_myaccount_order',
                'wv_thankyou_order',
                'wv_thankyou_customer_address_details',
                'wv_thankyou_order_details',
                'wv_product_advance_thumbnails',
                'wv_social_shere',
                'wv_stock_progress_bar',
                'wv_single_product_sale_schedule',
                'wv_related_product',
                'wv_product_upsell_custom',
                'wv_cross_sell_custom',
            );
        }else{ $wvb_element  = array(); }
        $wv_element_manager = array_merge( $wv_element_manager, $wvb_element );

        foreach ( $wv_element_manager as $element ){
            if (  ( woovator_get_option_pro( $element, 'woovator_elements_tabs', 'on' ) === 'on' ) && file_exists( WOOVATOR_ADDONS_PL_PATH_PRO.'includes/addons/'.$element.'.php' ) ){
                require_once ( WOOVATOR_ADDONS_PL_PATH_PRO.'includes/addons/'.$element.'.php' );
            }
        }
        
    }


}

Widgets_Control::instance();
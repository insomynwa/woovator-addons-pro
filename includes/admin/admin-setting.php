<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Woovator_Admin_Settings_Pro {

    private $settings_api;

    function __construct() {
        
        $this->settings_api = new Woovator_Settings_API();

        if( class_exists('Woovator_Template_Library') ){
            Woovator_Template_Library::instance()->set_api_endpoint( 'https://demo.themeshas.com/api/woovator/layouts-pro-564538/layoutinfopro.json' );
            Woovator_Template_Library::instance()->set_api_templateapi( 'https://demo.themeshas.com/api/woovator/layouts-pro-564538/%s.json' );
        }

        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 220 );
        add_action( 'wsa_form_bottom_woovator_general_tabs', array( $this, 'woovator_html_general_tabs' ) );
        add_action( 'wsa_form_bottom_woovator_themes_library_tabs', array( $this, 'woovator_html_themes_library_tabs' ) );
        add_action( 'wsa_form_top_woovator_elements_tabs', array( $this, 'html_element_toogle_button' ) );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->woovator_admin_get_settings_sections() );
        $this->settings_api->set_fields( $this->woovator_admin_fields_settings() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    // Plugins menu Register
    function admin_menu() {

        $menu = 'add_menu_' . 'page';
        $menu(
            'woovator_panel',
            esc_html__( 'WooVator', 'woovator-pro' ),
            esc_html__( 'WooVator', 'woovator-pro' ),
            'woovator_page',
            NULL,
            WOOVATOR_ADDONS_PL_URL.'includes/admin/assets/images/menu-icon.png',
            100
        );
        
        add_submenu_page(
            'woovator_page', 
            esc_html__( 'Settings', 'woovator-pro' ),
            esc_html__( 'Settings', 'woovator-pro' ), 
            'manage_options', 
            'woovator', 
            array ( $this, 'plugin_page' ) 
        );


    }

    // Options page Section register
    function woovator_admin_get_settings_sections() {
        $sections = array(
            
            array(
                'id'    => 'woovator_general_tabs',
                'title' => esc_html__( 'General', 'woovator-pro' )
            ),

            array(
                'id'    => 'woovator_woo_template_tabs',
                'title' => esc_html__( 'WooCommerce Template', 'woovator-pro' )
            ),

            array(
                'id'    => 'woovator_elements_tabs',
                'title' => esc_html__( 'Elements', 'woovator-pro' )
            ),

            array(
                'id'    => 'woovator_themes_library_tabs',
                'title' => esc_html__( 'Theme Library', 'woovator-pro' )
            ),

            array(
                'id'    => 'woovator_rename_label_tabs',
                'title' => esc_html__( 'Rename Label', 'woovator-pro' )
            ),

            array(
                'id'    => 'woovator_sales_notification_tabs',
                'title' => esc_html__( 'Sales Notification', 'woovator-pro' )
            ),
            array(
                'id'    => 'woovator_others_tabs',
                'title' => esc_html__( 'Other', 'woovator-pro' )
            ),

        );
        return $sections;
    }

    // Options page field register
    protected function woovator_admin_fields_settings() {

        $settings_fields = array(

            'woovator_general_tabs' => array(),

            'woovator_woo_template_tabs'=>array(

                array(
                    'name'  => 'enablecustomlayout',
                    'label'  => esc_html__( 'Enable / Disable Template Builder', 'woovator-pro' ),
                    'desc'  => esc_html__( 'Enable', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'shoppageproductlimit',
                    'label' => esc_html__( 'Product Limit', 'woovator-pro' ),
                    'desc' => wp_kses_post( 'You can Handle Shop page product limit', 'woovator-pro' ),
                    'min'               => 1,
                    'max'               => 100,
                    'step'              => '1',
                    'type'              => 'number',
                    'std'               => '10',
                    'sanitize_callback' => 'floatval'
                ),

                array(
                    'name'    => 'singleproductpage',
                    'label'   => esc_html__( 'Single Product Template', 'woovator-pro' ),
                    'desc'    => esc_html__( 'You can select Custom Product details layout', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woovator_elementor_template()
                ),

                array(
                    'name'    => 'productarchivepage',
                    'label'   => esc_html__( 'Product Archive Page Template', 'woovator-pro' ),
                    'desc'    => esc_html__( 'You can select Custom Product Shop page layout', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woovator_elementor_template()
                ),

                array(
                    'name'    => 'productcartpage',
                    'label'   => esc_html__( 'Cart Page Template', 'woovator-pro' ),
                    'desc'    => esc_html__( 'You can select Custom cart page layout', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woovator_elementor_template()
                ),

                array(
                    'name'    => 'productemptycartpage',
                    'label'   => esc_html__( 'Empty Cart Page Template', 'woovator-pro' ),
                    'desc'    => esc_html__( 'You can select Custom empty cart page layout', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woovator_elementor_template()
                ),

                array(
                    'name'    => 'productcheckoutpage',
                    'label'   => esc_html__( 'Checkout Page Template', 'woovator-pro' ),
                    'desc'    => esc_html__( 'You can select Custom checkout page layout', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woovator_elementor_template()
                ),

                array(
                    'name'    => 'productcheckouttoppage',
                    'label'   => esc_html__( 'Checkout Page Top Content', 'woovator-pro' ),
                    'desc'    => esc_html__( 'You can checkout top content(E.g: Coupon form, login form etc)', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woovator_elementor_template()
                ),

                array(
                    'name'    => 'productthankyoupage',
                    'label'   => esc_html__( 'Thank You Page Template', 'woovator-pro' ),
                    'desc'    => esc_html__( 'You can select Custom thank you page layout', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woovator_elementor_template()
                ),

                array(
                    'name'    => 'productmyaccountpage',
                    'label'   => esc_html__( 'My Account Page Template', 'woovator-pro' ),
                    'desc'    => esc_html__( 'You can select Custom my account page layout', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woovator_elementor_template()
                ),

                array(
                    'name'    => 'productmyaccountloginpage',
                    'label'   => esc_html__( 'My Account Login page Template', 'woovator-pro' ),
                    'desc'    => esc_html__( 'You can select Custom my account login page layout', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woovator_elementor_template()
                ),

            ),

            'woovator_elements_tabs' => array(

                array(
                    'name'  => 'product_tabs',
                    'label'  => esc_html__( 'Product Tab', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'universal_product',
                    'label'  => esc_html__( 'Universal Product', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'add_banner',
                    'label'  => esc_html__( 'Ads Banner', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'special_day_offer',
                    'label'  => esc_html__( 'Special Day Offer', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_archive_product',
                    'label'  => esc_html__( 'Product Archive', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_title',
                    'label'  => esc_html__( 'Product Title', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_related',
                    'label'  => esc_html__( 'Related Product', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_add_to_cart',
                    'label'  => esc_html__( 'Add To Cart Button', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_additional_information',
                    'label'  => esc_html__( 'Additional Information', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_data_tab',
                    'label'  => esc_html__( 'Product data Tab', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_description',
                    'label'  => esc_html__( 'Product Description', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_short_description',
                    'label'  => esc_html__( 'Product Short Description', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_price',
                    'label'  => esc_html__( 'Product Price', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_rating',
                    'label'  => esc_html__( 'Product Rating', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_reviews',
                    'label'  => esc_html__( 'Product Reviews', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_image',
                    'label'  => esc_html__( 'Product Image', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wv_product_video_gallery',
                    'label'  => esc_html__( 'Product Video Gallery', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_upsell',
                    'label'  => esc_html__( 'Product Upsell', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_stock',
                    'label'  => esc_html__( 'Product Stock Status', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_meta',
                    'label'  => esc_html__( 'Product Meta Info', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_call_for_price',
                    'label'  => esc_html__( 'Call For Price', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wb_product_suggest_price',
                    'label'  => esc_html__( 'Suggest Price', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wv_custom_archive_layout',
                    'label'  => esc_html__( 'Product Archive Layout', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_cart_table',
                    'label'  => esc_html__( 'Product Cart Table', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_cart_total',
                    'label'  => esc_html__( 'Product Cart Total', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_cartempty_message',
                    'label'  => esc_html__( 'Empty Cart Message', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_cartempty_shopredirect',
                    'label'  => esc_html__( 'Empty Cart Redirect Button', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_cross_sell',
                    'label'  => esc_html__( 'Product Cross Sell', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_cross_sell_custom',
                    'label'  => esc_html__( 'Cross Sell Product..( Custom )', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_checkout_additional_form',
                    'label'  => esc_html__( 'Checkout Additional..', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_checkout_billing',
                    'label'  => esc_html__( 'Checkout Billing Form', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_checkout_shipping_form',
                    'label'  => esc_html__( 'Checkout Shipping Form', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_checkout_payment',
                    'label'  => esc_html__( 'Checkout Payment', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_checkout_coupon_form',
                    'label'  => esc_html__( 'Checkout Coupon Form', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_checkout_login_form',
                    'label'  => esc_html__( 'Checkout Login Form', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_order_review',
                    'label'  => esc_html__( 'Checkout Order Review', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wv_myaccount_account',
                    'label'  => esc_html__( 'My Account', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wv_myaccount_dashboard',
                    'label'  => esc_html__( 'My Account Dashboard', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wv_myaccount_download',
                    'label'  => esc_html__( 'My Account Download', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wv_myaccount_edit_account',
                    'label'  => esc_html__( 'My Account Edit', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wv_myaccount_address',
                    'label'  => esc_html__( 'My Account Address', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'  => 'wv_myaccount_login_form',
                    'label'  => esc_html__( 'Login Form', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_myaccount_register_form',
                    'label'  => esc_html__( 'Registration Form', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_myaccount_logout',
                    'label'  => esc_html__( 'My Account Logout', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_myaccount_order',
                    'label'  => esc_html__( 'My Account Order', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_thankyou_order',
                    'label'  => esc_html__( 'Thank You Order', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_thankyou_customer_address_details',
                    'label'  => esc_html__( 'Thank You Cus.. Address', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_thankyou_order_details',
                    'label'  => esc_html__( 'Thank You Order Details', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_product_advance_thumbnails',
                    'label'  => __( 'Advance Product Image', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_social_shere',
                    'label'  => esc_html__( 'Product Social Share', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_stock_progress_bar',
                    'label'  => esc_html__( 'Stock Progressbar', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_single_product_sale_schedule',
                    'label'  => esc_html__( 'Product Sale Schedule', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_related_product',
                    'label'  => esc_html__( 'Related Product..( Custom )', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

                array(
                    'name'  => 'wv_product_upsell_custom',
                    'label'  => esc_html__( 'Upsell Product..( Custom )', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woovator_table_row pro',
                ),

            ),

            'woovator_themes_library_tabs'=>array(),

            'woovator_rename_label_tabs' => array(

                array(
                    'name'  => 'enablerenamelabel',
                    'label'  => esc_html__( 'Enable / Disable Rename Label', 'woovator-pro' ),
                    'desc'  => esc_html__( 'Enable', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'      => 'shop_page_heading',
                    'headding'  => esc_html__( 'Shop Page', 'woovator-pro' ),
                    'type'      => 'title',
                ),

                array(
                    'name'        => 'wv_shop_add_to_cart_txt',
                    'label'       => esc_html__( 'Add to Cart Button Text', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You Can change the Add to Cart button text.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Add to Cart', 'woovator-pro' )
                ),

                array(
                    'name'      => 'product_details_page_heading',
                    'headding'  => esc_html__( 'Product Details Page', 'woovator-pro' ),
                    'type'      => 'title',
                ),

                array(
                    'name'        => 'wv_add_to_cart_txt',
                    'label'       => esc_html__( 'Add to Cart Button Text', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You Can change the Add to Cart button text.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Add to Cart', 'woovator-pro' )
                ),
                
                array(
                    'name'        => 'wv_description_tab_menu_title',
                    'label'       => esc_html__( 'Description', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You Can change the description tab title.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Description', 'woovator-pro' )
                ),
                
                array(
                    'name'        => 'wv_additional_information_tab_menu_title',
                    'label'       => esc_html__( 'Additional Information', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You Can change the additional information tab title.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Additiona information', 'woovator-pro' )
                ),
                
                array(
                    'name'        => 'wv_reviews_tab_menu_title',
                    'label'       => esc_html__( 'Reviews', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You Can change the review tab title.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Reviews', 'woovator-pro' )
                ),

                array(
                    'name'      => 'checkout_page_heading',
                    'headding'  => esc_html__( 'Checkout Page', 'woovator-pro' ),
                    'type'      => 'title',
                ),

                array(
                    'name'        => 'wv_checkout_firstname_label',
                    'label'       => esc_html__( 'First name', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the First name field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'First name', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_lastname_label',
                    'label'       => esc_html__( 'Last name', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the Last name field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Last name', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_company_label',
                    'label'       => esc_html__( 'Company name', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the company field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Company name', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_address_1_label',
                    'label'       => esc_html__( 'Street address', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the Street address field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Street address', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_address_2_label',
                    'label'       => esc_html__( 'Address Optional', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the Address Optional field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Address Optional', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_city_label',
                    'label'       => esc_html__( 'Town / City', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the City field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Town / City', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_postcode_label',
                    'label'       => esc_html__( 'Postcode / ZIP', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the Postcode / ZIP field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Postcode / ZIP', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_state_label',
                    'label'       => esc_html__( 'State', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the state field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'State', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_phone_label',
                    'label'       => esc_html__( 'Phone', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the phone field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Phone', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_email_label',
                    'label'       => esc_html__( 'Email address', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the email address field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Email address', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_country_label',
                    'label'       => esc_html__( 'Country', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the Country field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Country', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_ordernote_label',
                    'label'       => esc_html__( 'Order Note', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the Order notes field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Order notes', 'woovator-pro' )
                ),

                array(
                    'name'        => 'wv_checkout_placeorder_btn_txt',
                    'label'       => esc_html__( 'Place order', 'woovator-pro' ),
                    'desc'        => esc_html__( 'You can change the Place order field label.', 'woovator-pro' ),
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Place order', 'woovator-pro' )
                ),

            ),

            'woovator_sales_notification_tabs'=>array(

                array(
                    'name'  => 'enableresalenotification',
                    'label'  => esc_html__( 'Enable / Disable Sales Notification', 'woovator-pro' ),
                    'desc'  => esc_html__( 'Enable', 'woovator-pro' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woovator_table_row',
                ),

                array(
                    'name'    => 'notification_content_type',
                    'label'   => esc_html__( 'Notification Content Type', 'woovator-pro' ),
                    'desc'    => esc_html__( 'Select Content Type', 'woovator-pro' ),
                    'type'    => 'radio',
                    'default' => 'actual',
                    'options' => array(
                        'actual' => esc_html__('Real','woovator-pro'),
                        'fakes'  => esc_html__('Fakes','woovator-pro'),
                    )
                ),

                array(
                    'name'    => 'noification_fake_data',
                    'label'   => esc_html__( 'Choose Template', 'woovator-pro' ),
                    'desc'    => esc_html__( 'Choose Template for fakes notification.', 'woovator-pro' ),
                    'type'    => 'multiselect',
                    'default' => '',
                    'options' => woovator_elementor_template(),
                    'class'       => 'notification_fake',
                ),

                array(
                    'name'    => 'notification_pos',
                    'label'   => esc_html__( 'Position', 'woovator-pro' ),
                    'desc'    => esc_html__( 'Sale Notification Position on frontend.', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => 'bottomleft',
                    'options' => array(
                        'topleft'       => esc_html__( 'Top Left','woovator-pro' ),
                        'topright'      => esc_html__( 'Top Right','woovator-pro' ),
                        'bottomleft'    => esc_html__( 'Bottom Left','woovator-pro' ),
                        'bottomright'   => esc_html__( 'Bottom Right','woovator-pro' ),
                    ),
                ),

                array(
                    'name'    => 'notification_layout',
                    'label'   => esc_html__( 'Image Position', 'woovator-pro' ),
                    'desc'    => esc_html__( 'Notification Layout.', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => 'imageleft',
                    'options' => array(
                        'imageleft'       => esc_html__( 'Image Left','woovator-pro' ),
                        'imageright'      => esc_html__( 'Image Right','woovator-pro' ),
                    ),
                    'class'       => 'notification_real'
                ),

                array(
                    'name'    => 'notification_loadduration',
                    'label'   => esc_html__( 'Loading Time', 'woovator-pro' ),
                    'desc'    => esc_html__( 'Notification Loading duration.', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '3',
                    'options' => array(
                        '2'     => esc_html__( '2 seconds','woovator-pro' ),
                        '3'     => esc_html__( '3 seconds','woovator-pro' ),
                        '4'     => esc_html__( '4 seconds','woovator-pro' ),
                        '5'     => esc_html__( '5 seconds','woovator-pro' ),
                        '6'     => esc_html__( '6 seconds','woovator-pro' ),
                        '7'     => esc_html__( '7 seconds','woovator-pro' ),
                        '8'     => esc_html__( '8 seconds','woovator-pro' ),
                        '9'     => esc_html__( '9 seconds','woovator-pro' ),
                        '10'    => esc_html__( '10 seconds','woovator-pro' ),
                        '20'    => esc_html__( '20 seconds','woovator-pro' ),
                        '30'    => esc_html__( '30 seconds','woovator-pro' ),
                        '40'    => esc_html__( '40 seconds','woovator-pro' ),
                        '50'    => esc_html__( '50 seconds','woovator-pro' ),
                        '60'    => esc_html__( '1 minute','woovator-pro' ),
                        '90'    => esc_html__( '1.5 minutes','woovator-pro' ),
                        '120'   => esc_html__( '2 minutes','woovator-pro' ),
                    ),
                ),

                array(
                    'name'    => 'notification_time_int',
                    'label'   => esc_html__( 'Time Interval', 'woovator-pro' ),
                    'desc'    => esc_html__( 'Time between notifications.', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '4',
                    'options' => array(
                        '2'     =>esc_html__( '2 seconds','woovator-pro' ),
                        '4'     =>esc_html__( '4 seconds','woovator-pro' ),
                        '5'     =>esc_html__( '5 seconds','woovator-pro' ),
                        '6'     =>esc_html__( '6 seconds','woovator-pro' ),
                        '7'     =>esc_html__( '7 seconds','woovator-pro' ),
                        '8'     =>esc_html__( '8 seconds','woovator-pro' ),
                        '9'     =>esc_html__( '9 seconds','woovator-pro' ),
                        '10'    =>esc_html__( '10 seconds','woovator-pro' ),
                        '20'    =>esc_html__( '20 seconds','woovator-pro' ),
                        '30'    =>esc_html__( '30 seconds','woovator-pro' ),
                        '40'    =>esc_html__( '40 seconds','woovator-pro' ),
                        '50'    =>esc_html__( '50 seconds','woovator-pro' ),
                        '60'    =>esc_html__( '1 minute','woovator-pro' ),
                        '90'    =>esc_html__( '1.5 minutes','woovator-pro' ),
                        '120'   =>esc_html__( '2 minutes','woovator-pro' ),
                    ),
                ),

                array(
                    'name'              => 'notification_limit',
                    'label'             => esc_html__( 'Limit', 'woovator-pro' ),
                    'desc'              => esc_html__( 'Order Limit for notification.', 'woovator-pro' ),
                    'min'               => 1,
                    'max'               => 100,
                    'default'           => '5',
                    'step'              => '1',
                    'type'              => 'number',
                    'sanitize_callback' => 'number',
                    'class'       => 'notification_real',
                ),

                array(
                    'name'    => 'notification_uptodate',
                    'label'   => esc_html__( 'Order Upto', 'woovator-pro' ),
                    'desc'    => esc_html__( 'Do not show purchases older than.', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => '7',
                    'options' => array(
                        '1'   => esc_html__( '1 day','woovator-pro' ),
                        '2'   => esc_html__( '2 days','woovator-pro' ),
                        '3'   => esc_html__( '3 days','woovator-pro' ),
                        '4'   => esc_html__( '4 days','woovator-pro' ),
                        '5'   => esc_html__( '5 days','woovator-pro' ),
                        '6'   => esc_html__( '6 days','woovator-pro' ),
                        '7'   => esc_html__( '1 week','woovator-pro' ),
                        '10'  => esc_html__( '10 days','woovator-pro' ),
                        '14'  => esc_html__( '2 weeks','woovator-pro' ),
                        '21'  => esc_html__( '3 weeks','woovator-pro' ),
                        '28'  => esc_html__( '4 weeks','woovator-pro' ),
                        '35'  => esc_html__( '5 weeks','woovator-pro' ),
                        '42'  => esc_html__( '6 weeks','woovator-pro' ),
                        '49'  => esc_html__( '7 weeks','woovator-pro' ),
                        '56'  => esc_html__( '8 weeks','woovator-pro' ),
                    ),
                    'class'       => 'notification_real',
                ),

                array(
                    'name'    => 'notification_inanimation',
                    'label'   => esc_html__( 'Animation In', 'woovator-pro' ),
                    'desc'    => esc_html__( 'Notification Enter Animation.', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => 'fadeInLeft',
                    'options' => array(
                        'bounce'            => esc_html__( 'bounce','woovator-pro' ),
                        'flash'             => esc_html__( 'flash','woovator-pro' ),
                        'pulse'             => esc_html__( 'pulse','woovator-pro' ),
                        'rubberBand'        => esc_html__( 'rubberBand','woovator-pro' ),
                        'shake'             => esc_html__( 'shake','woovator-pro' ),
                        'swing'             => esc_html__( 'swing','woovator-pro' ),
                        'tada'              => esc_html__( 'tada','woovator-pro' ),
                        'wobble'            => esc_html__( 'wobble','woovator-pro' ),
                        'jello'             => esc_html__( 'jello','woovator-pro' ),
                        'heartBeat'         => esc_html__( 'heartBeat','woovator-pro' ),
                        'bounceIn'          => esc_html__( 'bounceIn','woovator-pro' ),
                        'bounceInDown'      => esc_html__( 'bounceInDown','woovator-pro' ),
                        'bounceInLeft'      => esc_html__( 'bounceInLeft','woovator-pro' ),
                        'bounceInRight'     => esc_html__( 'bounceInRight','woovator-pro' ),
                        'bounceInUp'        => esc_html__( 'bounceInUp','woovator-pro' ),
                        'fadeIn'            => esc_html__( 'fadeIn','woovator-pro' ),
                        'fadeInDown'        => esc_html__( 'fadeInDown','woovator-pro' ),
                        'fadeInDownBig'     => esc_html__( 'fadeInDownBig','woovator-pro' ),
                        'fadeInLeft'        => esc_html__( 'fadeInLeft','woovator-pro' ),
                        'fadeInLeftBig'     => esc_html__( 'fadeInLeftBig','woovator-pro' ),
                        'fadeInRight'       => esc_html__( 'fadeInRight','woovator-pro' ),
                        'fadeInRightBig'    => esc_html__( 'fadeInRightBig','woovator-pro' ),
                        'fadeInUp'          => esc_html__( 'fadeInUp','woovator-pro' ),
                        'fadeInUpBig'       => esc_html__( 'fadeInUpBig','woovator-pro' ),
                        'flip'              => esc_html__( 'flip','woovator-pro' ),
                        'flipInX'           => esc_html__( 'flipInX','woovator-pro' ),
                        'flipInY'           => esc_html__( 'flipInY','woovator-pro' ),
                        'lightSpeedIn'      => esc_html__( 'lightSpeedIn','woovator-pro' ),
                        'rotateIn'          => esc_html__( 'rotateIn','woovator-pro' ),
                        'rotateInDownLeft'  => esc_html__( 'rotateInDownLeft','woovator-pro' ),
                        'rotateInDownRight' => esc_html__( 'rotateInDownRight','woovator-pro' ),
                        'rotateInUpLeft'    => esc_html__( 'rotateInUpLeft','woovator-pro' ),
                        'rotateInUpRight'   => esc_html__( 'rotateInUpRight','woovator-pro' ),
                        'slideInUp'         => esc_html__( 'slideInUp','woovator-pro' ),
                        'slideInDown'       => esc_html__( 'slideInDown','woovator-pro' ),
                        'slideInLeft'       => esc_html__( 'slideInLeft','woovator-pro' ),
                        'slideInRight'      => esc_html__( 'slideInRight','woovator-pro' ),
                        'zoomIn'            => esc_html__( 'zoomIn','woovator-pro' ),
                        'zoomInDown'        => esc_html__( 'zoomInDown','woovator-pro' ),
                        'zoomInLeft'        => esc_html__( 'zoomInLeft','woovator-pro' ),
                        'zoomInRight'       => esc_html__( 'zoomInRight','woovator-pro' ),
                        'zoomInUp'          => esc_html__( 'zoomInUp','woovator-pro' ),
                        'hinge'             => esc_html__( 'hinge','woovator-pro' ),
                        'jackInTheBox'      => esc_html__( 'jackInTheBox','woovator-pro' ),
                        'rollIn'            => esc_html__( 'rollIn','woovator-pro' ),
                        'rollOut'           => esc_html__( 'rollOut','woovator-pro' ),
                    ),
                ),

                array(
                    'name'    => 'notification_outanimation',
                    'label'   => esc_html__( 'Animation Out', 'woovator-pro' ),
                    'desc'    => esc_html__( 'Notification Out Animation.', 'woovator-pro' ),
                    'type'    => 'select',
                    'default' => 'fadeOutRight',
                    'options' => array(
                        'bounce'             => esc_html__( 'bounce','woovator-pro' ),
                        'flash'              => esc_html__( 'flash','woovator-pro' ),
                        'pulse'              => esc_html__( 'pulse','woovator-pro' ),
                        'rubberBand'         => esc_html__( 'rubberBand','woovator-pro' ),
                        'shake'              => esc_html__( 'shake','woovator-pro' ),
                        'swing'              => esc_html__( 'swing','woovator-pro' ),
                        'tada'               => esc_html__( 'tada','woovator-pro' ),
                        'wobble'             => esc_html__( 'wobble','woovator-pro' ),
                        'jello'              => esc_html__( 'jello','woovator-pro' ),
                        'heartBeat'          => esc_html__( 'heartBeat','woovator-pro' ),
                        'bounceOut'          => esc_html__( 'bounceOut','woovator-pro' ),
                        'bounceOutDown'      => esc_html__( 'bounceOutDown','woovator-pro' ),
                        'bounceOutLeft'      => esc_html__( 'bounceOutLeft','woovator-pro' ),
                        'bounceOutRight'     => esc_html__( 'bounceOutRight','woovator-pro' ),
                        'bounceOutUp'        => esc_html__( 'bounceOutUp','woovator-pro' ),
                        'fadeOut'            => esc_html__( 'fadeOut','woovator-pro' ),
                        'fadeOutDown'        => esc_html__( 'fadeOutDown','woovator-pro' ),
                        'fadeOutDownBig'     => esc_html__( 'fadeOutDownBig','woovator-pro' ),
                        'fadeOutLeft'        => esc_html__( 'fadeOutLeft','woovator-pro' ),
                        'fadeOutLeftBig'     => esc_html__( 'fadeOutLeftBig','woovator-pro' ),
                        'fadeOutRight'       => esc_html__( 'fadeOutRight','woovator-pro' ),
                        'fadeOutRightBig'    => esc_html__( 'fadeOutRightBig','woovator-pro' ),
                        'fadeOutUp'          => esc_html__( 'fadeOutUp','woovator-pro' ),
                        'fadeOutUpBig'       => esc_html__( 'fadeOutUpBig','woovator-pro' ),
                        'flip'               => esc_html__( 'flip','woovator-pro' ),
                        'flipOutX'           => esc_html__( 'flipOutX','woovator-pro' ),
                        'flipOutY'           => esc_html__( 'flipOutY','woovator-pro' ),
                        'lightSpeedOut'      => esc_html__( 'lightSpeedOut','woovator-pro' ),
                        'rotateOut'          => esc_html__( 'rotateOut','woovator-pro' ),
                        'rotateOutDownLeft'  => esc_html__( 'rotateOutDownLeft','woovator-pro' ),
                        'rotateOutDownRight' => esc_html__( 'rotateOutDownRight','woovator-pro' ),
                        'rotateOutUpLeft'    => esc_html__( 'rotateOutUpLeft','woovator-pro' ),
                        'rotateOutUpRight'   => esc_html__( 'rotateOutUpRight','woovator-pro' ),
                        'slideOutUp'         => esc_html__( 'slideOutUp','woovator-pro' ),
                        'slideOutDown'       => esc_html__( 'slideOutDown','woovator-pro' ),
                        'slideOutLeft'       => esc_html__( 'slideOutLeft','woovator-pro' ),
                        'slideOutRight'      => esc_html__( 'slideOutRight','woovator-pro' ),
                        'zoomOut'            => esc_html__( 'zoomOut','woovator-pro' ),
                        'zoomOutDown'        => esc_html__( 'zoomOutDown','woovator-pro' ),
                        'zoomOutLeft'        => esc_html__( 'zoomOutLeft','woovator-pro' ),
                        'zoomOutRight'       => esc_html__( 'zoomOutRight','woovator-pro' ),
                        'zoomOutUp'          => esc_html__( 'zoomOutUp','woovator-pro' ),
                        'hinge'              => esc_html__( 'hinge','woovator-pro' ),
                    ),
                ),
                
                array(
                    'name'  => 'background_color',
                    'label' => esc_html__( 'Background Color', 'woovator-pro' ),
                    'desc'  => wp_kses_post( 'Notification Background Color.', 'woovator-pro' ),
                    'type'  => 'color',
                    'class' => 'notification_real',
                ),

                array(
                    'name'  => 'heading_color',
                    'label' => esc_html__( 'Heading Color', 'woovator-pro' ),
                    'desc'  => wp_kses_post( 'Notification Heading Color.', 'woovator-pro' ),
                    'type'  => 'color',
                    'class' => 'notification_real',
                ),

                array(
                    'name'  => 'content_color',
                    'label' => esc_html__( 'Content Color', 'woovator-pro' ),
                    'desc'  => wp_kses_post( 'Notification Content Color.', 'woovator-pro' ),
                    'type'  => 'color',
                    'class' => 'notification_real',
                ),

                array(
                    'name'  => 'cross_color',
                    'label' => esc_html__( 'Cross Icon Color', 'woovator-pro' ),
                    'desc'  => wp_kses_post( 'Notification Cross Icon Color.', 'woovator-pro' ),
                    'type'  => 'color'
                ),

            ),

            'woovator_others_tabs'=>array(

                array(
                    'name'  => 'loadproductlimit',
                    'label' => esc_html__( 'Load Products in Elementor Widget', 'woovator-pro' ),
                    'desc'  => wp_kses_post( 'Load Products in Elementor Widget.', 'woovator-pro' ),
                    'min'               => 1,
                    'max'               => 100,
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '20',
                    'sanitize_callback' => 'floatval'
                ),
                
                array(
                    'name'   => 'ajaxsearch',
                    'label'  => esc_html__( 'Ajax Search Widget', 'woovator-pro' ),
                    'type'   => 'checkbox',
                    'default'=> 'off',
                    'class'  =>'woovator_table_row',
                ),

                array(
                    'name'   => 'ajaxcart_singleproduct',
                    'label'  => esc_html__( 'Single Product Ajax Add To Cart', 'woovator-pro' ),
                    'type'   => 'checkbox',
                    'default'=> 'off',
                    'class'  =>'woovator_table_row',
                ),

                array(
                    'name'   => 'single_product_sticky_add_to_cart',
                    'label'  => esc_html__( 'Single Product Sticky Add To Cart', 'woovator-pro' ),
                    'type'   => 'checkbox',
                    'default'=> 'off',
                    'class'  =>'woovator_table_row',
                ),

            ),

        );

        // Extra Addons
        if( woovator_get_option( 'ajaxsearch', 'woovator_others_tabs', 'off' ) == 'on' ){
            $settings_fields['woovator_elements_tabs'][] = [
                'name'    => 'ajax_search_form',
                'label'   => __( 'Ajax Product Search Form', 'woovator-pro' ),
                'type'    => 'checkbox',
                'default' => "on",
                'class'   => 'woovator_table_row',
            ];
        }
        
        return array_merge( $settings_fields );
    }


    function plugin_page() {

        echo '<div class="wrap">';
            echo '<h2>'.esc_html__( 'Woovator Settings','woovator-pro' ).'</h2>';
            $this->save_message();
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        echo '</div>';

    }

    function save_message() {
        if( isset($_GET['settings-updated']) ) { ?>
            <div class="updated notice is-dismissible"> 
                <p><strong><?php esc_html_e('Successfully Settings Saved.', 'woovator-pro') ?></strong></p>
            </div>
            <?php
        }
    }
    // Custom Markup

    // General tab
    function woovator_html_general_tabs(){
        ob_start();
        ?>
            <div class="woovator-general-tabs">

                <div class="woovator-document-section">
                    <div class="woovator-column">
                        <!-- <a href="https://themeshas.com/blog-category/woovator/" target="_blank">
                            <img src="<?php //echo WOOVATOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/video-tutorial.jpg" alt="<?php //esc_attr_e( 'Video Tutorial', 'woovator-pro' ); ?>">
                        </a> -->
                    </div>
                    <div class="woovator-column">
                        <!-- <a href="https://demo.themeshas.com/doc/woovator/index.html" target="_blank">
                            <img src="<?php //echo WOOVATOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/online-documentation.jpg" alt="<?php //esc_attr_e( 'Online Documentation', 'woovator-pro' ); ?>">
                        </a> -->
                    </div>
                    <div class="woovator-column">
                        <!-- <a href="https://themeshas.com/contact-us/" target="_blank">
                            <img src="<?php //echo WOOVATOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/genral-contact-us.jpg" alt="<?php //esc_attr_e( 'Contact Us', 'woovator-pro' ); ?>">
                        </a> -->
                    </div>
                </div>

            </div>
        <?php
        echo ob_get_clean();
    }

    // Element Toogle Button
    function html_element_toogle_button(){
        ob_start();
        ?>
            <span class="wvopen-element-toggle"><?php esc_html_e( 'Toggle All', 'woovator-pro' );?></span>
            <script type="text/javascript">
                (function($){
                    $(function() {
                        $('.wvopen-element-toggle').on('click', function() {
                          var inputCheckbox = $('#woovator_elements_tabs').find('.woovator_table_row input[type="checkbox"]');
                          if(inputCheckbox.prop("checked") === true){
                            inputCheckbox.prop('checked', false)
                          } else {
                            inputCheckbox.prop('checked', true)
                          }
                        });
                    });
                } )( jQuery );
            </script>
        <?php
        echo ob_get_clean();
    }


    // Theme Library
    function woovator_html_themes_library_tabs() {
        ob_start();
        ?>
        <div class="woovator-themes-laibrary">
            <p><?php echo esc_html__( 'Use Our WooCommerce Theme for your online Store.', 'woovator-pro' ); ?></p>
            <div class="woovator-themes-area">
                <div class="woovator-themes-row">

                    <div class="woovator-single-theme"><img src="<?php echo WOOVATOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/99fy.png" alt="">
                        <div class="woovator-theme-content">
                            <h3><?php echo esc_html__( '99Fy - WooCommerce Theme', 'woovator-pro' ); ?></h3>
                            <a href="https://demo.themeshas.com/99fy-preview/index.html" class="woovator-button" target="_blank"><?php echo esc_html__( 'Preview', 'woovator' ); ?></a>
                            <a href="https://downloads.wordpress.org/theme/99fy.3.1.1.zip" class="woovator-button"><?php echo esc_html__( 'Download', 'woovator' ); ?></a>
                        </div>
                    </div>
                    
                    <div class="woovator-single-theme"><img src="<?php echo WOOVATOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/parlo.png" alt="">
                        <div class="woovator-theme-content">
                            <h3><?php echo esc_html__( 'Parlo - WooCommerce Theme', 'woovator-pro' ); ?></h3>
                            <a href="http://demo.shrimpthemes.com/1/parlo/" class="woovator-button" target="_blank"><?php echo esc_html__( 'Preview', 'woovator-pro' ); ?></a>
                            <a href="https://freethemescloud.com/item/parlo-free-woocommerce-theme/" class="woovator-button"><?php echo esc_html__( 'Download', 'woovator-pro' ); ?></a>
                        </div>
                    </div>
                    
                    <div class="woovator-single-theme"><img src="<?php echo WOOVATOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/flone.png" alt="">
                        <div class="woovator-theme-content">
                            <h3><?php echo esc_html__( 'Flone – Minimal WooCommerce Theme', 'woovator-pro' ); ?></h3>
                            <a href="http://demo.shrimpthemes.com/2/flone/" class="woovator-button" target="_blank"><?php echo esc_html__( 'Preview', 'woovator-pro' ); ?></a>
                        </div>
                    </div>

                    <div class="woovator-single-theme"><img src="<?php echo WOOVATOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/holmes.png" alt="">
                        <div class="woovator-theme-content">
                            <h3><?php echo esc_html__( 'Homes - Multipurpose WooCommerce Theme', 'woovator-pro' ); ?></h3>
                            <a href="http://demo.shrimpthemes.com/1/holmes/" class="woovator-button" target="_blank"><?php echo esc_html__( 'Preview', 'woovator-pro' ); ?></a>
                        </div>
                    </div>
                    
                    <div class="woovator-single-theme"><img src="<?php echo WOOVATOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/daniel-home-1.png" alt="">
                        <div class="woovator-theme-content">
                            <h3><?php echo esc_html__( 'Daniel - WooCommerce Theme', 'woovator-pro' ); ?></h3>
                            <a href="http://demo.shrimpthemes.com/2/daniel/" class="woovator-button" target="_blank"><?php echo esc_html__( 'Preview', 'woovator-pro' ); ?></a>
                        </div>
                    </div>
                    
                    <div class="woovator-single-theme"><img src="<?php echo WOOVATOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/hurst-home-1.png" alt="">
                        <div class="woovator-theme-content">
                            <h3><?php echo esc_html__( 'Hurst - WooCommerce Theme', 'woovator-pro' ); ?></h3>
                            <a href="http://demo.shrimpthemes.com/4/hurstem/" class="woovator-button" target="_blank"><?php echo esc_html__( 'Preview', 'woovator-pro' ); ?></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();
    }

}

new Woovator_Admin_Settings_Pro();
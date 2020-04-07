<?php

namespace WooVatorPro;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Base
*/
class Base {

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        if ( ! function_exists('is_plugin_active')){ include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
        
        // Register Plugin Active Hook
        register_activation_hook( WOOVATOR_ADDONS_PL_ROOT_PRO, [ $this, 'plugin_activate_hook'] );

    }

    /*
    * Load Text Domain
    */
    public function i18n() {
        load_plugin_textdomain( 'woovator-pro', false, dirname( plugin_basename( WOOVATOR_ADDONS_PL_ROOT_PRO ) ) . '/languages/' );
    }

    /*
    * Init Hook in Init
    */
    public function init() {

        // Check WooVator Free version
        if( !is_plugin_active('woovator-addons/woovator_addons_elementor.php') ){
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Include File
        $this->include_files();

        // After Active Plugin then redirect to setting page
        $this->plugin_redirect_option_page();

    }

    /**
     * Admin notice.
     * For missing elementor.
     */
    public function admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $woovator = 'woovator-addons/woovator_addons_elementor.php';
        if( $this->is_plugins_active( $woovator ) ) {
            if( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $woovator . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $woovator );
            $message = sprintf( __( '%1$sWooVator Addons Pro%2$s requires WooVator plugin to be active. Please activate WooVator to continue.', 'woovator-pro' ), '<strong>', '</strong>' );
            $button_text = esc_html__( 'Activate WooVator', 'woovator-pro' );
        } else {
            if( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woovator-addons' ), 'install-plugin_woovator-addons' );
            $message = sprintf( __( ' %1$sWooVator Addons Pro %2$s requires %1$s"WooLetor Addons"%2$s plugin to be installed and activated. Please install WooVator to continue.', 'woovator-pro' ), '<strong>', '</strong>' );
            $button_text = esc_html__( 'Install WooVator', 'woovator-pro' );
        }
        $button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';
        printf( '<div class="error"><p>%1$s</p>%2$s</div>', $message, $button );

    }

    /*
    * Check Plugins is Installed or not
    */
    public function is_plugins_active( $pl_file_path = NULL ){
        $installed_plugins_list = get_plugins();
        return isset( $installed_plugins_list[$pl_file_path] );
    }

    /* 
    * Plugins After Install
    * Redirect Setting page
    */
    public function plugin_activate_hook() {
        add_option('woovator_do_activation_redirect', TRUE);
    }
    public function plugin_redirect_option_page() {
        if ( get_option( 'woovator_do_activation_redirect', FALSE ) ) {
            delete_option('woovator_do_activation_redirect');
            if( !isset( $_GET['activate-multi'] ) ){
                wp_redirect( admin_url("admin.php?page=woovator-pro") );
            }
        }
    }

    /*
    * Include File
    */
    public function include_files(){
        require( WOOVATOR_ADDONS_PL_PATH_PRO.'includes/helper-function.php' );
        require( WOOVATOR_ADDONS_PL_PATH_PRO.'classes/class.assest_management.php' );
        require( WOOVATOR_ADDONS_PL_PATH_PRO.'classes/class.widgets_control.php' );
        require( WOOVATOR_ADDONS_PL_PATH_PRO.'classes/class.my_account.php' );
        require( WOOVATOR_ADDONS_PL_PATH_PRO.'includes/licence/WooVatorPro.php' );

        // Admin Setting file
        if( is_admin() ){
            require( WOOVATOR_ADDONS_PL_PATH_PRO.'includes/custom-metabox.php' );
        }

        // Builder File
        if( woovator_get_option_pro( 'enablecustomlayout', 'woovator_woo_template_tabs', 'on' ) == 'on' ){
            include( WOOVATOR_ADDONS_PL_PATH_PRO.'includes/wv_woo_shop.php' );
            if( !is_admin() && woovator_get_option_pro( 'enablerenamelabel', 'woovator_rename_label_tabs', 'off' ) == 'on' ){
                include( WOOVATOR_ADDONS_PL_PATH_PRO.'includes/rename_label.php' );
            }
        }

        // Sale Notification
        if( woovator_get_option_pro( 'enableresalenotification', 'woovator_sales_notification_tabs', 'off' ) == 'on' ){
            if( woovator_get_option_pro( 'notification_content_type', 'woovator_sales_notification_tabs', 'actual' ) == 'fakes' ){
                include( WOOVATOR_ADDONS_PL_PATH_PRO. 'includes/class.sale_notification_fake.php' );
            }else{
                include( WOOVATOR_ADDONS_PL_PATH_PRO. 'includes/class.sale_notification.php' );
            }
        }

        // Single Product Sticky Add to Cart
        if( woovator_get_option_pro( 'single_product_sticky_add_to_cart', 'woovator_others_tabs', 'off' ) == 'on' ){
            require( WOOVATOR_ADDONS_PL_PATH_PRO.'classes/class.extension.php' );
        }

    }


}
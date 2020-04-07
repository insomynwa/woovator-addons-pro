<?php

/*
*  Woovator Pro Manage WooCommerce Builder Page.
*/
class Woovator_Woo_Custom_Template_Layout_Pro{

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct(){

        add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'woovator_init_cart' ) );
        add_action('init', array( $this, 'init' ) );

        if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] && is_admin() ) {
            add_action( 'init', array( $this, 'register_wc_hooks' ), 5 );
        }

    }

    public function init(){

        add_filter( 'wc_get_template', array( $this, 'woovator_page_template' ), 50, 3 );
        
        // Cart
        add_action( 'woovator_cart_content_build', array( $this, 'woovator_cart_content' ) );
        add_action( 'woovator_cartempty_content_build', array( $this, 'woovator_emptycart_content' ) );
        
        // Checkout
        add_action( 'woovator_checkout_content', array( $this, 'woovator_checkout_content' ) );
        add_action( 'woovator_checkout_top_content', array( $this, 'woovator_checkout_top_content' ) );

        // Thank you Page
        add_action( 'woovator_thankyou_content', array( $this, 'woovator_thankyou_content' ) );

        // MyAccount
        add_action( 'woovator_woocommerce_account_content', array( $this, 'woovator_account_content' ) );
        add_action( 'woovator_woocommerce_account_content_form_login', array( $this, 'woovator_account_login_content' ) );

        add_filter( 'template_include', array( $this, 'woovator_woocommerce_page_template' ), 999);
    }

    /**
     *  Include WC fontend.
     */
    public function register_wc_hooks() {
        wc()->frontend_includes();
    }
    public function woovator_init_cart() {
        $has_cart = is_a( WC()->cart, 'WC_Cart' );
        if ( ! $has_cart ) {
            $session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
            WC()->session = new $session_class();
            WC()->session->init();
            WC()->cart = new \WC_Cart();
            WC()->customer = new \WC_Customer( get_current_user_id(), true );
        }
    }

    public function woovator_page_template( $template, $slug, $args ){

        if( $slug === 'cart/cart-empty.php'){
            $wvemptycart_page_id = woovator_get_option_pro( 'productemptycartpage', 'woovator_woo_template_tabs', '0' );
            if( !empty( $wvemptycart_page_id ) ) {
                $template = WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/cart-empty-elementor.php';
            }
        }
        elseif( $slug === 'cart/cart.php' ){
            $wvcart_page_id = woovator_get_option_pro( 'productcartpage', 'woovator_woo_template_tabs', '0' );
            if( !empty( $wvcart_page_id ) ) {
                $template = WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/cart-elementor.php';
            }
        }elseif( $slug === 'checkout/form-checkout.php' ){
            $wvcheckout_page_id = woovator_get_option_pro( 'productcheckoutpage', 'woovator_woo_template_tabs', '0' );
            if( !empty( $wvcheckout_page_id ) ) {
                $template = WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/form-checkout.php';
            }
        }elseif( $slug === 'checkout/thankyou.php' ){
            $wvthankyou_page_id = woovator_get_option_pro( 'productthankyoupage', 'woovator_woo_template_tabs', '0' );
            if( !empty( $wvthankyou_page_id ) ) {
                $template = WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/thankyou.php';
            }
        }elseif( $slug === 'myaccount/my-account.php' ){
            $wvmyaccount_page_id = woovator_get_option_pro( 'productmyaccountpage', 'woovator_woo_template_tabs', '0' );
            if( !empty( $wvmyaccount_page_id ) ) {
                $template = WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/my-account.php';
            }
        }elseif( $slug === 'myaccount/form-login.php' ){
            $wvmyaccount_login_page_id = woovator_get_option_pro( 'productmyaccountloginpage', 'woovator_woo_template_tabs', '0' );
            if( !empty( $wvmyaccount_login_page_id ) ) {
                $template = WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/form-login.php';
            }
        }

        return $template;
    }

    public function woovator_emptycart_content(){
        $elementor_page_id = woovator_get_option_pro( 'productemptycartpage', 'woovator_woo_template_tabs', '0' );
        if( !empty( $elementor_page_id ) ){
            echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $elementor_page_id );
        }
    }

    public function woovator_cart_content(){
        $elementor_page_id = woovator_get_option_pro( 'productcartpage', 'woovator_woo_template_tabs', '0' );
        if( !empty( $elementor_page_id ) ){
            echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $elementor_page_id );
        }
    }

    public function woovator_checkout_content(){
        $elementor_page_id = woovator_get_option_pro( 'productcheckoutpage', 'woovator_woo_template_tabs', '0' );
        if( !empty( $elementor_page_id ) ){
            echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $elementor_page_id );
        }else{ the_content(); }
    }

    public function woovator_checkout_top_content(){
        $elementor_page_id = woovator_get_option_pro( 'productcheckouttoppage', 'woovator_woo_template_tabs', '0' );
        if( !empty( $elementor_page_id ) ){
            echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $elementor_page_id );
        }
    }

    public function woovator_thankyou_content(){
        $elementor_page_id = woovator_get_option_pro( 'productthankyoupage', 'woovator_woo_template_tabs', '0' );
        if( !empty( $elementor_page_id ) ){
            echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $elementor_page_id );
        }else{ the_content(); }
    }

    public function woovator_account_content(){
        $elementor_page_id = woovator_get_option_pro( 'productmyaccountpage', 'woovator_woo_template_tabs', '0' );
        if ( is_user_logged_in() && !empty($elementor_page_id) ){
            echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $elementor_page_id );
        }else{ the_content(); }
    }

    public function woovator_account_login_content(){
        $elementor_page_id = woovator_get_option_pro( 'productmyaccountloginpage', 'woovator_woo_template_tabs', '0' );
        if ( !empty($elementor_page_id) ){
            echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $elementor_page_id );
        }else{ the_content(); }
    }

    public function woovator_get_page_template_path( $page_template ) {
        $template_path = '';
        if( $page_template === 'elementor_header_footer' ){
            $template_path = WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/page/header-footer.php';
        }elseif( $page_template === 'elementor_canvas' ){
            $template_path = WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/page/canvas.php';
        }
        return $template_path;
    }

    public function woovator_woocommerce_page_template( $template ){

        $elementor_page_slug = 0;

        if( is_cart() ){
            $cart_page_id = woovator_get_option_pro( 'productcartpage', 'woovator_woo_template_tabs', '0' );
            if( !empty( $cart_page_id ) ){
                $elementor_page_slug = get_page_template_slug( $cart_page_id );
            }
        }elseif ( is_checkout() ){
            $wv_checkout_page_id = woovator_get_option_pro( 'productcheckoutpage', 'woovator_woo_template_tabs', '0' );
            if( !empty($wv_checkout_page_id) ){
                $elementor_page_slug = get_page_template_slug( $wv_checkout_page_id );
            }
            
        }elseif ( is_account_page() && is_user_logged_in() ){
            $wv_myaccount_page_id = woovator_get_option_pro( 'productmyaccountpage', 'woovator_woo_template_tabs', '0' );
            if( !empty($wv_myaccount_page_id) ){
                $elementor_page_slug = get_page_template_slug( $wv_myaccount_page_id );
            }
        }
        
        if( !empty($elementor_page_slug) ){
            $template_path = $this->woovator_get_page_template_path( $elementor_page_slug );
            if ( $template_path ) {
                $template = $template_path;
            }
        }
        
        return $template;
    }

}

Woovator_Woo_Custom_Template_Layout_Pro::instance();
<?php

namespace WooVatorPro;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Assest Management
*/
class Assets_Management{
    
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

        // Register Scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );

        // Frontend Scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );

    }
    
    // Register frontend scripts
    public function register_scripts(){
        
        // Register Css file
        wp_register_style(
            'woovator-widgets-pro',
            WOOVATOR_ADDONS_PL_URL_PRO . 'assets/css/woovator-widgets-pro.css',
            array(),
            WOOVATOR_VERSION_PRO
        );

        // Register JS file
        wp_register_script(
            'woovator-widgets-scripts-pro',
            WOOVATOR_ADDONS_PL_URL_PRO . 'assets/js/woovator-widgets-active-pro.js',
            array('jquery'),
            WOOVATOR_VERSION_PRO,
            TRUE
        );

    }

    // Enqueue frontend scripts
    public function enqueue_frontend_scripts() {
        
        // CSS File
        wp_enqueue_style( 'woovator-widgets-pro' );
        wp_enqueue_style( 'woovator-animate', WOOVATOR_ADDONS_PL_URL_PRO . 'assets/css/animate.css', WOOVATOR_VERSION_PRO );

        // JS File
        wp_enqueue_script( 'woovator-mainjs', WOOVATOR_ADDONS_PL_URL_PRO . 'assets/js/main.js', array('jquery'), WOOVATOR_VERSION_PRO, TRUE );

    }


}

Assets_Management::instance();
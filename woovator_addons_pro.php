<?php
/**
 * Plugin Name: WooVator Pro
 * Description: The WooCommerce elements library for Elementor page builder plugin for WordPress.
 * Version: 	1.3.4
 * Author: 		Mr.Lorem
 * Text Domain: woovator-pro
 * Domain Path: /languages
 * WC tested up to: 4.0.1
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'WOOVATOR_VERSION_PRO', '1.3.4' );
define( 'WOOVATOR_ADDONS_PL_ROOT_PRO', __FILE__ );
define( 'WOOVATOR_ADDONS_PL_URL_PRO', plugins_url( '/', WOOVATOR_ADDONS_PL_ROOT_PRO ) );
define( 'WOOVATOR_ADDONS_PL_PATH_PRO', plugin_dir_path( WOOVATOR_ADDONS_PL_ROOT_PRO ) );
define( 'WOOVATOR_ADDONS_DIR_URL_PRO', plugin_dir_url( WOOVATOR_ADDONS_PL_ROOT_PRO ) );
define( 'WOOVATOR_ITEM_NAME_PRO', 'WooVator Pro' );

// Required File
require_once ( WOOVATOR_ADDONS_PL_PATH_PRO.'includes/base.php' );
\WooVatorPro\Base::instance();
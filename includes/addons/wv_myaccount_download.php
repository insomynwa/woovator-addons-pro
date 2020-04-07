<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Myaccount_Download_ELement extends Widget_Base {

    public function get_name() {
        return 'wv-myaccount-download';
    }

    public function get_title() {
        return __( 'WV: Myaccount Download', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-download-button';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {}

    protected function render() {
        if ( Plugin::instance()->editor->is_edit_mode() ) {
            do_action('woocommerce_account_downloads_endpoint');
        }else{
            if ( is_account_page() ) {
                do_action('woocommerce_account_downloads_endpoint');
            }
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Myaccount_Download_ELement() );
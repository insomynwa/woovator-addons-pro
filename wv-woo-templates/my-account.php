<?php
/**
 * My Account page
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 3.5.0
 */
//do_action( 'woocommerce_account_navigation' ); ?>

<div class="woocommerce woovator_myaccount_page">
    <?php
        /**
         * My Account content.
         *
         * @since 3.5.0
         */
        do_action( 'woovator_woocommerce_account_content' );
        
        remove_action( 'woocommerce_account_content', 'woocommerce_account_content' );
        remove_action( 'woocommerce_account_content', 'woocommerce_output_all_notices', 5 );
        do_action( 'woocommerce_account_content' );
    ?>
</div>
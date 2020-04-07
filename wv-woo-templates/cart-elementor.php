<?php
/**
 * Cart Page 
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit();

?>
<div class="woocommerce woovator-elementor-cart">
    <?php
        wc_print_notices();
        do_action( 'woovator_cart_content_build' );
    ?>
</div>
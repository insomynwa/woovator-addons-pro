<?php
/**
 * Empty Cart Page 
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit();

?>
<div class="woocommerce woovator-elementor-empty-cart">
    <?php
        do_action( 'woovator_cartempty_content_build' );
    ?>
</div>
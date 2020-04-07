<?php 
/**
* WooVator Extension
*/
class WooVator_Extension{

    private static $instance = null;
    public static function instance(){
        if( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

    function __construct(){
        add_action( 'woovator_footer_render_content', [ $this, 'sticky_single_add_to_cart' ], 15 );
    }

    // Single Product Sticky Add to Cart
    public function sticky_single_add_to_cart(){
        global $product;
        if ( ! is_product() ) return;
        ?>
            <div class="woovator-add-to-cart-sticky">
                <div class="ht-container">

                    <div class="ht-row">
                        <div class="ht-col-lg-6 ht-col-md-6 ht-col-sm-6 ht-col-xs-12">
                            <div class="woovator-addtocart-content">
                                <div class="woovator-sticky-thumbnail">
                                    <?php echo woocommerce_get_product_thumbnail(); ?>  
                                </div>
                                <div class="woovator-sticky-product-info">
                                    <h4 class="title"><?php the_title(); ?></h4>
                                    <span class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>     
                                </div>
                            </div>
                        </div>
                        <div class="ht-col-lg-6 ht-col-md-6 ht-col-sm-6 ht-col-xs-12">
                            <div class="woovator-sticky-btn-area">
                                <?php 
                                    if ( $product->is_type( 'simple' ) ){ 
                                        woocommerce_simple_add_to_cart();
                                    }else{
                                        echo '<a href="'.esc_url( $product->add_to_cart_url() ).'" class="woovator-sticky-add-to-cart button alt">'.( true == $product->is_type( 'variable' ) ? esc_html__( 'Select Options', 'woovator' ) : $product->single_add_to_cart_text() ).'</a>';
                                    }

                                    if ( class_exists( 'YITH_WCWL' ) ) {
                                        echo '<div class="woovator-sticky-wishlist">'.woovator_add_to_wishlist_button().'</div>';
                                    }
                                    if( class_exists('TInvWL_Public_AddToWishlist') ){
                                        echo '<div class="woovator-sticky-wishlist">';
                                            \TInvWL_Public_AddToWishlist::instance()->htmloutput();
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php
    }

}

WooVator_Extension::instance();
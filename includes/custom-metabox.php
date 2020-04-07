<?php

    // add extra metabox tab to woocommerce
    if( ! function_exists( 'woovator_add_wc_extra_metabox_tab_pro' ) ) {
        function woovator_add_wc_extra_metabox_tab_pro ( $tabs ) {

            $tabs[] = array(
                'label'    => __( 'Product Layout', 'woovator-pro' ),
                'target'   => 'woovator_product_data_pro',
                'class'    => '',
                'priority' => 85,
            );

            $tabs[] = array(
                'label'    => __( 'Cart Custom Content', 'woovator-pro' ),
                'target'   => 'woovator_product_cart_content',
                'class'    => '',
                'priority' => 85,
            );

            return $tabs;
        }
        add_filter( 'woocommerce_product_data_tabs', 'woovator_add_wc_extra_metabox_tab_pro', 10, 1 );
    }

    // add metabox to tab
    if ( ! function_exists( 'woovator_add_metabox_to_general_tab_pro' ) ) {
        function woovator_add_metabox_to_general_tab_pro () {
            global $post;

            // Single product layout field
            echo '<div id="woovator_product_data_pro" class="panel woocommerce_options_panel hidden">';
                $value = get_post_meta( $post->ID, '_selectproduct_layout', true );
                if( empty( $value ) ) $value = '0';
                $option_arg = [
                    'id'      => '_selectproduct_layout',
                    'label'   => esc_html__( 'Select Product Layout', 'woovator-pro' ),
                    'options' =>  esc_html__('Select Product Layout', 'woovator-pro'),
                    'value'   => $value,
                ];
                if( function_exists('woovator_elementor_template') ){
                    $option_arg['options'] = woovator_elementor_template();
                }
                woocommerce_wp_select( $option_arg );
            echo '</div>';

            // Cart page custom content
            echo '<div id="woovator_product_cart_content" class="panel woocommerce_options_panel hidden">';
                woocommerce_wp_textarea_input(
                    array(
                        'id'          => 'woovator_cart_custom_content',
                        'label'       => __( 'Custom Content for cart page', 'woovator-pro' ),
                        'desc_tip'    => 'true',
                        'description' => __( 'If you want to show cart page custom content', 'woovator-pro' ),
                    )
                );
            echo '<div>';

        }
        add_action( 'woocommerce_product_data_panels', 'woovator_add_metabox_to_general_tab_pro' );
    }

    // Stock progress bar extra field
    if ( ! function_exists( 'woovator_total_stock_quantity_input' ) ) {
        function woovator_total_stock_quantity_input() {

            echo '<div class="options_group">';
                woocommerce_wp_text_input(
                    array(
                        'id'          => 'woovator_total_stock_quantity',
                        'label'       => __( 'Initial number in stock', 'woovator-pro' ),
                        'desc_tip'    => 'true',
                        'description' => __( 'Required for stock progress bar', 'woovator-pro' ),
                        'type'        => 'text',
                    )
                );
            echo '</div>';

        }
        add_action( 'woocommerce_product_options_inventory_product_data', 'woovator_total_stock_quantity_input' );
    }

    // Stock progress bar value store
    if ( ! function_exists( 'woovator_save_total_stock_quantity' ) ) {

        function woovator_save_total_stock_quantity( $post_id ) {
            $stock_quantity = ( isset( $_POST['woovator_total_stock_quantity'] ) && $_POST['woovator_total_stock_quantity'] ? wc_clean( $_POST['woovator_total_stock_quantity'] ) : '' );
            update_post_meta( $post_id, 'woovator_total_stock_quantity', $stock_quantity );
        }

        add_action( 'woocommerce_process_product_meta_simple', 'woovator_save_total_stock_quantity' );
        add_action( 'woocommerce_process_product_meta_variable', 'woovator_save_total_stock_quantity' );
        add_action( 'woocommerce_process_product_meta_grouped', 'woovator_save_total_stock_quantity' );
        add_action( 'woocommerce_process_product_meta_external', 'woovator_save_total_stock_quantity' );

    }

    // Custom Meta Data Update
    if( ! function_exists( 'woovator_save_metabox_of_general_tab_pro' ) ){

        function woovator_save_metabox_of_general_tab_pro( $post_id ){

            // Single Product Layout
            $selectproduct_layout = wp_kses_post( stripslashes( $_POST['_selectproduct_layout'] ) );
            update_post_meta( $post_id, '_selectproduct_layout', $selectproduct_layout );

            // Cat Page Custom Content
            $selectproduct_cart_content = wp_kses_post( stripslashes( $_POST['woovator_cart_custom_content'] ) );
            update_post_meta( $post_id, 'woovator_cart_custom_content', $selectproduct_cart_content );

        }
        add_action( 'woocommerce_process_product_meta', 'woovator_save_metabox_of_general_tab_pro');

    }

    /*
    * Product Category Meta Field
    */
    function woovator_product_cat_custom_fields_init() {
        add_action('product_cat_add_form_fields', 'woovator_taxonomy_add_new_meta_field', 15, 1 );
        add_action('product_cat_edit_form_fields', 'woovator_taxonomy_edit_meta_field', 15, 1 );
        add_action('edited_product_cat', 'woovator_save_taxonomy_custom_meta', 15, 1 );
        add_action('create_product_cat', 'woovator_save_taxonomy_custom_meta', 15, 1 );
    }

    //Product Category Create page
    function woovator_taxonomy_add_new_meta_field() {
        ?>
        <div class="form-field term-group">
            <label for="wooletor_selectcategory_layout"><?php esc_html_e('Category Layout', 'woovator-pro'); ?></label>
            <select class="postform" id="equipment-group" name="wooletor_selectcategory_layout">
                <?php if( function_exists('woovator_elementor_template') ) foreach ( woovator_elementor_template() as $catlayout_key => $catlayout ) : ?>
                   <option value="<?php echo esc_attr( $catlayout_key ); ?>" class=""><?php echo esc_html__( $catlayout, 'woovator-pro' ); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php
    }

    //Product Cat Edit page
    function woovator_taxonomy_edit_meta_field( $term ) {

        //getting term ID
        $term_id = $term->term_id;

        // retrieve the existing value(s) for this meta field.
        $category_layout = get_term_meta( $term_id, 'wooletor_selectcategory_layout', true);

        ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="wooletor_selectcategory_layout"><?php esc_html_e( 'Category Layout', 'woovator-pro' ); ?></label></th>
                <td><select class="postform" id="wooletor_selectcategory_layout" name="wooletor_selectcategory_layout">
                    <?php if( function_exists('woovator_elementor_template') ) foreach ( woovator_elementor_template() as $catlayout_key => $catlayout ) : ?>
                        <option value="<?php echo esc_attr( $catlayout_key ); ?>" <?php selected( $category_layout, $catlayout_key ); ?>><?php echo esc_html__( $catlayout, 'woovator-pro' ); ?></option>
                    <?php endforeach; ?>
                </select></td>
            </tr>
        <?php
    }

    // Save extra taxonomy fields callback function.
    function woovator_save_taxonomy_custom_meta( $term_id ) {
        $woovator_categorylayout = filter_input( INPUT_POST, 'wooletor_selectcategory_layout' );
        update_term_meta( $term_id, 'wooletor_selectcategory_layout', $woovator_categorylayout );
    }
    
    woovator_product_cat_custom_fields_init();

?>
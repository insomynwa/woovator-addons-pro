<?php
/*
* Shop Page
*/

// Add to Cart Button Text
add_filter( 'woocommerce_product_add_to_cart_text', 'woovator_custom_add_cart_button_shop_page', 99, 2 );
function woovator_custom_add_cart_button_shop_page( $label ) {
   return __( woovator_get_option_text( 'wv_shop_add_to_cart_txt', 'woovator_rename_label_tabs', 'Add to Cart' ), 'woovator-pro' );
}

/*
* Product Details Page
*/

// Add to Cart Button Text
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woovator_custom_add_cart_button_single_product' );
function woovator_custom_add_cart_button_single_product( $label ) {
   return __( woovator_get_option_text( 'wv_add_to_cart_txt', 'woovator_rename_label_tabs', 'Add to Cart' ), 'woovator-pro' );
}

//Description tab
add_filter( 'woocommerce_product_description_tab_title', 'woovator_rename_description_product_tab_label' );
function woovator_rename_description_product_tab_label() {
    return __( woovator_get_option_text( 'wv_description_tab_menu_title', 'woovator_rename_label_tabs', 'Description' ), 'woovator-pro' );
}

add_filter( 'woocommerce_product_description_heading', 'woovator_rename_description_tab_heading' );
function woovator_rename_description_tab_heading() {
    return __( woovator_get_option_text( 'wv_description_tab_menu_title', 'woovator_rename_label_tabs', 'Description' ), 'woovator-pro' );
}

//Additional Info tab
add_filter( 'woocommerce_product_additional_information_tab_title', 'woovator_rename_additional_information_product_tab_label' );
function woovator_rename_additional_information_product_tab_label() {
    return __( woovator_get_option_text( 'wv_additional_information_tab_menu_title', 'woovator_rename_label_tabs','Additional Information' ), 'woovator-pro' );
}

add_filter( 'woocommerce_product_additional_information_heading', 'woovator_rename_additional_information_tab_heading' );
function woovator_rename_additional_information_tab_heading() {
    return __( woovator_get_option_text( 'wv_additional_information_tab_menu_title', 'woovator_rename_label_tabs','Additional Information' ), 'woovator-pro' );
}

//Reviews Info tab
add_filter( 'woocommerce_product_reviews_tab_title', 'woovator_rename_reviews_product_tab_label' );
function woovator_rename_reviews_product_tab_label() {
    return __( woovator_get_option_text( 'wv_reviews_tab_menu_title', 'woovator_rename_label_tabs','Reviews' ), 'woovator-pro');
}


/*
* Checkout Page
*/

// Field Name change
add_filter( 'woocommerce_default_address_fields' , 'woovator_rename_field_name', 9999 );
function woovator_rename_field_name( $fields ) {
    $fields['first_name']['label'] = __( woovator_get_option_text( 'wv_checkout_firstname_label', 'woovator_rename_label_tabs', 'First name' ), 'woovator-pro' );
    $fields['last_name']['label'] = __( woovator_get_option_text( 'wv_checkout_lastname_label', 'woovator_rename_label_tabs', 'Last name' ), 'woovator-pro');
    $fields['company']['label'] = __( woovator_get_option_text( 'wv_checkout_company_label', 'woovator_rename_label_tabs', 'Company name' ),'woovator-pro');
    $fields['address_1']['label'] = __( woovator_get_option_text( 'wv_checkout_address_1_label', 'woovator_rename_label_tabs', 'Street address' ),'woovator-pro');
    $fields['address_2']['label'] = __( woovator_get_option_text( 'wv_checkout_address_2_label', 'woovator_rename_label_tabs', 'Address Optional' ),'woovator-pro');
    $fields['city']['label'] = __( woovator_get_option_text( 'wv_checkout_city_label', 'woovator_rename_label_tabs', 'Town / City' ),'woovator-pro');
    $fields['postcode']['label'] = __( woovator_get_option_text( 'wv_checkout_postcode_label', 'woovator_rename_label_tabs', 'Postcode / ZIP' ),'woovator-pro');
    $fields['state']['label'] = __( woovator_get_option_text( 'wv_checkout_state_label', 'woovator_rename_label_tabs', 'State' ),'woovator-pro');

    return $fields;
}
// Change Phone and Email
add_filter( 'woocommerce_checkout_fields' , 'woovator_checkout_fields' );
function woovator_checkout_fields ( $fields ) {
    $fields['billing']['billing_phone']['label'] = __( woovator_get_option_text( 'wv_checkout_phone_label', 'woovator_rename_label_tabs', 'Phone' ),'woovator-pro');
    $fields['billing']['billing_email']['label'] = __( woovator_get_option_text( 'wv_checkout_email_label', 'woovator_rename_label_tabs', 'Email address' ),'woovator-pro');
    $fields['billing']['billing_country']['label'] = __( woovator_get_option_text( 'wv_checkout_country_label', 'woovator_rename_label_tabs', 'Country' ),'woovator-pro');
    $fields['billing']['billing_state']['label'] = __( woovator_get_option_text( 'wv_checkout_state_label', 'woovator_rename_label_tabs', 'State' ),'woovator-pro');
    $fields['shipping']['shipping_country']['label'] = __( woovator_get_option_text( 'wv_checkout_country_label', 'woovator_rename_label_tabs', 'Country' ),'woovator-pro');
    $fields['shipping']['shipping_state']['label'] = __( woovator_get_option_text( 'wv_checkout_state_label', 'woovator_rename_label_tabs', 'State' ),'woovator-pro');
    $fields['order']['order_comments']['label'] = __( woovator_get_option_text( 'wv_checkout_ordernote_label', 'woovator_rename_label_tabs', 'Order notes' ),'woovator-pro');

    return $fields;
}

add_filter( 'woocommerce_order_button_text', 'woovator_rename_place_order_button' );
function woovator_rename_place_order_button() {
   return __( woovator_get_option_text( 'wv_checkout_placeorder_btn_txt', 'woovator_rename_label_tabs','Place order' ), 'woovator-pro');
}
<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Product_Cart_Totals_ELement extends Widget_Base {

    public function get_name() {
        return 'wv-cart-total';
    }

    public function get_title() {
        return __( 'WV: Cart Total', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-woocommerce';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {

        // Cart Total Content
        $this->start_controls_section(
            'cart_total_content',
            [
                'label' => esc_html__( 'Cart Total', 'woovator-pro' ),
            ]
        );
            
            $this->add_control(
                'default_layout',
                [
                    'label' => esc_html__( 'Default', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'woovator-pro' ),
                    'label_off' => esc_html__( 'No', 'woovator-pro' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'description'=>esc_html__('If you choose yes then layout are come from your theme/WooCommerce Plugin','woovator-pro'),
                ]
            );

            $this->add_control(
                'section_title',
                [
                    'label' => esc_html__( 'Title', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Cart totals', 'woovator-pro' ),
                    'placeholder' => esc_html__( 'Cart totals', 'woovator-pro' ),
                    'condition'=>[
                        'default_layout!'=>'yes',
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'subtotal_heading',
                [
                    'label' => esc_html__( 'Sub tolal heading', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Subtotal', 'woovator-pro' ),
                    'placeholder' => esc_html__( 'Subtotal', 'woovator-pro' ),
                    'condition'=>[
                        'default_layout!'=>'yes',
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'shipping_heading',
                [
                    'label' => esc_html__( 'Shipping heading', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Shipping', 'woovator-pro' ),
                    'placeholder' => esc_html__( 'Shipping', 'woovator-pro' ),
                    'condition'=>[
                        'default_layout!'=>'yes',
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'total_heading',
                [
                    'label' => esc_html__( 'Tolal heading', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Total', 'woovator-pro' ),
                    'placeholder' => esc_html__( 'Total', 'woovator-pro' ),
                    'condition'=>[
                        'default_layout!'=>'yes',
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'proceed_to_checkout',
                [
                    'label' => esc_html__( 'Proceed To Checkout Button Text', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Proceed to checkout', 'woovator-pro' ),
                    'placeholder' => esc_html__( 'Proceed to checkout', 'woovator-pro' ),
                    'condition'=>[
                        'default_layout!'=>'yes',
                    ],
                    'label_block'=>true,
                ]
            );

        $this->end_controls_section();
        
        // Heading
        $this->start_controls_section(
            'cart_total_heading_style',
            array(
                'label' => __( 'Heading', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'cart_total_heading_typography',
                    'label'     => __( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} .cart_totals > h2',
                )
            );
            $this->add_control(
                'cart_total_heading_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cart_totals > h2' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cart_total_heading_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .cart_totals > h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cart_total_heading_align',
                [
                    'label'        => __( 'Alignment', 'woovator-pro' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'woovator-pro' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'woovator-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'woovator-pro' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'woovator-pro' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'prefix_class' => 'elementor%s-align-',
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .cart_totals > h2' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();

        // Cart Total Table
        $this->start_controls_section(
            'cart_total_table_style',
            array(
                'label' => __( 'Table Cell', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'cart_total_table_border',
                    'selector' => '{{WRAPPER}} .cart_totals .shop_table tr th, {{WRAPPER}} .cart_totals .shop_table tr td',
                ]
            );
        
            $this->add_responsive_control(
                'cart_total_table_padding',
                [
                    'label' => __( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} {{WRAPPER}} .cart_totals .shop_table tr th, {{WRAPPER}} .cart_totals .shop_table tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'cart_total_table_align',
                [
                    'label'        => __( 'Alignment', 'woovator-pro' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'woovator-pro' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'woovator-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'woovator-pro' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'woovator-pro' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'prefix_class' => 'elementor%s-align-',
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .cart_totals .shop_table tr th, {{WRAPPER}} .cart_totals .shop_table tr td' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'cart_total_table_background',
                    'label' => __( 'Background', 'woovator-pro' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .cart_totals .shop_table',
                ]
            );

        $this->end_controls_section();

        // Cart Total Table heading
        $this->start_controls_section(
            'cart_total_table_heading_style',
            array(
                'label' => __( 'Table Heading', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            $this->add_control(
                'cart_total_table_heading_text_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cart_totals .shop_table tr th' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'cart_total_table_heading_typography',
                    'label'     => __( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} .cart_totals .shop_table tr th',
                )
            );

        $this->end_controls_section();

         // Cart Total Price
        $this->start_controls_section(
            'cart_total_table_price_style',
            array(
                'label' => __( 'Price', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            $this->add_control(
                'cart_total_table_heading',
                [
                    'label' => __( 'Price', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'cart_total_table_subtotal_typography',
                    'label'     => __( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} .cart_totals .shop_table tr.cart-subtotal td',
                )
            );

            $this->add_control(
                'cart_total_table_subtotal_color',
                [
                    'label' => __( 'Subtotal Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cart_totals .shop_table tr.cart-subtotal td' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'cart_total_table_totalprice_heading',
                [
                    'label' => __( 'Total Price', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'cart_total_table_total_typography',
                    'label'     => __( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} .cart_totals .shop_table tr.order-total th, {{WRAPPER}} .cart_totals .shop_table tr.order-total td .amount',
                )
            );

            $this->add_control(
                'cart_total_table_total_color',
                [
                    'label' => __( 'Total Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cart_totals .shop_table tr.order-total th' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .cart_totals .shop_table tr.order-total td .amount' => 'color: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // Checkout button
        $this->start_controls_section(
            'cart_total_checkout_button_style',
            array(
                'label' => __( 'Checkout Button', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->start_controls_tabs( 'cart_total_checkout_button_style_tabs' );
        
                $this->start_controls_tab( 
                    'cart_total_checkout_button_style_normal',
                    [
                        'label' => __( 'Normal', 'woovator-pro' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        array(
                            'name'      => 'cart_total_checkout_button_typography',
                            'label'     => __( 'Typography', 'woovator-pro' ),
                            'selector'  => '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button',
                        )
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'cart_total_checkout_button_border',
                            'label' => __( 'Button Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button',
                        ]
                    );

                    $this->add_responsive_control(
                        'cart_total_checkout_button_padding',
                        [
                            'label' => __( 'Padding', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'cart_total_checkout_button_text_color',
                        [
                            'label' => __( 'Text Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'cart_total_checkout_button_bg_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'cart_total_checkout_button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'cart_total_checkout_button_box_shadow',
                            'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button',
                        ]
                    );
            
                $this->end_controls_tab();
        
                $this->start_controls_tab( 
                    'cart_total_checkout_button_style_hover',
                    [
                        'label' => __( 'Hover', 'woovator-pro' ),
                    ]
                );
                
                    $this->add_control(
                        'cart_total_checkout_button_hover_text_color',
                        [
                            'label' => __( 'Text Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'cart_total_checkout_button_hover_bg_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'cart_total_checkout_button_hover_border_color',
                        [
                            'label' => __( 'Border Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'cart_total_checkout_button_hover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'cart_total_checkout_button_hover_box_shadow',
                            'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover',
                        ]
                    );
                
                $this->end_controls_tab();
        
            $this->end_controls_tabs();
        
        $this->end_controls_section();

    }

    protected function render() {
        $settings  = $this->get_settings_for_display();

        $cartotalopt = array(
            'section_title'         => $settings['section_title'],
            'subtotal_heading'      => $settings['subtotal_heading'],
            'shipping_heading'      => $settings['shipping_heading'],
            'total_heading'         => $settings['total_heading'],
            'proceed_to_checkout'   => $settings['proceed_to_checkout'],
        );

        if( $settings['default_layout'] === 'yes' ){
            woocommerce_cart_totals();
        }else{
            $this->cart_total_layout( $cartotalopt );
        }

    }

    // Cart Total layout
    public function cart_total_layout( $customopt = [] ){
        if( file_exists( WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/cart/cart-totals.php' ) ){
                include WOOVATOR_ADDONS_PL_PATH_PRO . 'wv-woo-templates/cart/cart-totals.php';
            }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Product_Cart_Totals_ELement() );
<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Checkout_Login_Form_Element extends Widget_Base {

    public function get_name() {
        return 'wv-checkout-login-form';
    }
    
    public function get_title() {
        return __( 'WV: Checkout Login Form', 'woovator-pro' );
    }

    public function get_icon() {
        return ' eicon-form-horizontal';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {

        // Heading
        $this->start_controls_section(
            'form_area_style',
            array(
                'label' => __( 'Style', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'form_area_typography',
                    'label'     => __( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} .woocommerce-info',
                )
            );

            $this->add_control(
                'form_area_text_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-info' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'form_area_link_color',
                [
                    'label' => __( 'Link Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-info a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'form_area_link_hover_color',
                [
                    'label' => __( 'Link Hover Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-info a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'form_area_icon_color',
                [
                    'label' => __( 'Left Ifon Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-info::before' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'form_area_border',
                    'label' => __( 'Border', 'woovator-pro' ),
                    'selector' => '{{WRAPPER}} .woocommerce-info',
                ]
            );

            $this->add_control(
                'form_area_top_border_color',
                [
                    'label' => __( 'Top Border Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'form_area_border_border' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-info' => 'border-top-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_area_border_radius',
                [
                    'label' => __( 'Border Radius', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'form_area_background',
                    'label' => __( 'Background', 'woovator-pro' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .woocommerce-info',
                ]
            );

            $this->add_responsive_control(
                'form_area_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_area_padding',
                [
                    'label' => __( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_area_content_align',
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
                    'default'   => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-info' => 'text-align: {{VALUE}}',
                        '{{WRAPPER}} .woocommerce-info::before' => 'position: static;margin-right:10px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Form
        $this->start_controls_section(
            'form_form_style',
            array(
                'label' => __( 'Form', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'form_box_typography',
                    'label'     => __( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} .login.woocommerce-form-login p',
                )
            );

            $this->add_control(
                'form_box_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .login.woocommerce-form-login p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'form_box_border',
                    'label' => __( 'Border', 'woovator-pro' ),
                    'selector' => '{{WRAPPER}} .login.woocommerce-form-login',
                ]
            );

            $this->add_responsive_control(
                'form_box_border_radius',
                [
                    'label' => __( 'Border Radius', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .login.woocommerce-form-login' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_box_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .login.woocommerce-form-login' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_box_padding',
                [
                    'label' => __( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .login.woocommerce-form-login' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Input box
        $this->start_controls_section(
            'form_input_box_style',
            array(
                'label' => esc_html__( 'Input Box', 'woovator-pros' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->add_control(
                'form_input_box_text_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .login.woocommerce-form-login input.input-text' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'form_input_box_typography',
                    'label'     => esc_html__( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} .login.woocommerce-form-login input.input-text',
                )
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'form_input_box_border',
                    'label' => __( 'Border', 'woovator-pro' ),
                    'selector' => '{{WRAPPER}} .login.woocommerce-form-login input.input-text',
                ]
            );

            $this->add_responsive_control(
                'form_input_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .login.woocommerce-form-login input.input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
            
            $this->add_responsive_control(
                'form_input_box_padding',
                [
                    'label' => esc_html__( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .login.woocommerce-form-login input.input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
            
            $this->add_responsive_control(
                'form_input_box_margin',
                [
                    'label' => esc_html__( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .login.woocommerce-form-login input.input-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'after',
                ]
            );

        $this->end_controls_section();

        // Submit button box
        $this->start_controls_section(
            'form_submit_button_style',
            array(
                'label' => esc_html__( 'Submit Button', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->start_controls_tabs('submit_button_style_tabs');
                
                $this->start_controls_tab(
                    'submit_button_normal_tab',
                    [
                        'label' => __( 'Normal', 'woovator-pro' ),
                    ]
                );

                    $this->add_control(
                        'form_submit_button_text_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .login.woocommerce-form-login button.button' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'form_submit_button_background_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .login.woocommerce-form-login button.button' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        array(
                            'name'      => 'form_submit_button_typography',
                            'label'     => esc_html__( 'Typography', 'woovator-pro' ),
                            'selector'  => '{{WRAPPER}} .login.woocommerce-form-login button.button',
                        )
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'form_submit_button_border',
                            'label' => __( 'Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .login.woocommerce-form-login button.button',
                        ]
                    );

                    $this->add_responsive_control(
                        'form_submit_button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .login.woocommerce-form-login button.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'form_submit_button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .login.woocommerce-form-login button.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'form_submit_button_margin',
                        [
                            'label' => esc_html__( 'Margin', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .login.woocommerce-form-login button.button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'after'
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'submit_button_hover_tab',
                    [
                        'label' => __( 'Hover', 'woovator-pro' ),
                    ]
                );
                    $this->add_control(
                        'form_submit_button_hover_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .login.woocommerce-form-login button.button:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'form_submit_button_hover_background_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .login.woocommerce-form-login button.button:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'form_submit_button_hover_border',
                            'label' => __( 'Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .login.woocommerce-form-login button.button:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( Plugin::instance()->editor->is_edit_mode() ) {
            ?>
            <div class="woocommerce-form-login-toggle">
                <?php wc_print_notice( apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'woovator-pro' ) ) . ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'woovator-pro' ) . '</a>', 'notice' ); ?>
            </div>
            <?php
            woocommerce_login_form(
                array(
                    'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'woovator-pro' ),
                    'redirect' => wc_get_checkout_url(),
                    'hidden'   => true,
                )
            );
        }else{
            if( is_checkout() ){
                woocommerce_checkout_login_form();
            }
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Checkout_Login_Form_Element() );
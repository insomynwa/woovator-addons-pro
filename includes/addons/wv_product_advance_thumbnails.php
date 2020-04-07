<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Product_Thumbnails_ELement extends Widget_Base {

    public function get_name() {
        return 'wv-product-thumbnails-image';
    }

    public function get_title() {
        return __( 'WV: Advance Product Image', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-product-images';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    public function get_script_depends() {
        return [
            'slick',
            'woovator-widgets-scripts-pro',
        ];
    }

    protected function _register_controls() {

         $this->start_controls_section(
            'product_thumbnails_content',
            array(
                'label' => __( 'Product Image', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            )
        );
            $this->add_control(
                'layout_style',
                [
                    'label' => __( 'Layout', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'tab',
                    'options' => [
                        'tab'       => __( 'Tab', 'woovator-pro' ),
                        'gallery'   => __( 'Gallery', 'woovator-pro' ),
                        'slider'    => __( 'Slider', 'woovator-pro' ),
                        'single'    => __( 'Single Thumbnails', 'woovator-pro' ),
                    ],
                ]
            );

            $this->add_control(
                'tab_thumbnails_position',
                [
                    'label'   => __( 'Thumbnails Position', 'woovator-pro' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'woovator-pro' ),
                            'icon'  => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'woovator-pro' ),
                            'icon'  => 'eicon-h-align-right',
                        ],
                        'top' => [
                            'title' => __( 'Top', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default'     => 'bottom',
                    'toggle'      => false,
                    'condition'=>[
                        'layout_style' => 'tab',
                    ],
                ]
            );

            $this->add_control(
                'hide_sale_badge',
                [
                    'label'     => __( 'Sale Badge Hide', 'woovator-pro' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '.woocommerce {{WRAPPER}} span.onsale' => 'display: none;',
                    ],
                ]
            );

            $this->add_control(
                'hide_custom_badge',
                [
                    'label'     => __( 'Custom Badge Hide', 'woovator-pro' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-product-gallery__image .ht-product-label.ht-product-label-left' => 'display: none;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Product slider setting
        $this->start_controls_section(
            'woovator-thumbnails-slider',
            [
                'label' => __( 'Slider Option', 'woovator-pro' ),
                'condition' => [
                    'layout_style' => 'slider',
                ]
            ]
        );

            $this->add_control(
                'slitems',
                [
                    'label' => __( 'Slider Items', 'woovator-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'default' => 3
                ]
            );

            $this->add_control(
                'slarrows',
                [
                    'label' => __( 'Slider Arrow', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'sldots',
                [
                    'label' => __( 'Slider dots', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label_off' => __('No', 'woovator-pro'),
                    'label_on' => __('Yes', 'woovator-pro'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'label' => __('Pause on Hover?', 'woovator-pro'),
                ]
            );

            $this->add_control(
                'slautolay',
                [
                    'label' => __( 'Slider auto play', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'slautoplay_speed',
                [
                    'label' => __('Autoplay speed', 'woovator-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3000,
                    'condition' => [
                        'slautolay' => 'yes',
                    ]
                ]
            );


            $this->add_control(
                'slanimation_speed',
                [
                    'label' => __('Autoplay animation speed', 'woovator-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 300,
                    'condition' => [
                        'slautolay' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slscroll_columns',
                [
                    'label' => __('Slider item to scroll', 'woovator-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'default' => 3,
                ]
            );

            $this->add_control(
                'heading_tablet',
                [
                    'label' => __( 'Tablet', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'sltablet_display_columns',
                [
                    'label' => __('Slider Items', 'woovator-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 2,
                ]
            );

            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'woovator-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 2,
                ]
            );

            $this->add_control(
                'sltablet_width',
                [
                    'label' => __('Tablet Resolution', 'woovator-pro'),
                    'description' => __('The resolution to tablet.', 'woovator-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 750,
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label' => __( 'Mobile Phone', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'slmobile_display_columns',
                [
                    'label' => __('Slider Items', 'woovator-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'woovator-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'slmobile_width',
                [
                    'label' => __('Mobile Resolution', 'woovator-pro'),
                    'description' => __('The resolution to mobile.', 'woovator-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 480,
                ]
            );

        $this->end_controls_section(); // Slider Option end
        
        // Product Main Image Style
        $this->start_controls_section(
            'product_image_style_section',
            [
                'label' => __( 'Image', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'layout_style' => 'tab',
                ],
            ]
        );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'product_image_border',
                    'label' => __( 'Product image border', 'woovator-pro' ),
                    'selector' => '.woocommerce {{WRAPPER}} .wvpro-product-thumbnails .woocommerce-product-gallery__image',
                ]
            );

            $this->add_responsive_control(
                'product_image_border_radius',
                [
                    'label' => __( 'Border Radius', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '.woocommerce {{WRAPPER}} .wvpro-product-thumbnails .woocommerce-product-gallery__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        '.woocommerce {{WRAPPER}} .wvpro-product-thumbnails .woocommerce-product-gallery__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'product_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '.woocommerce {{WRAPPER}} .wvpro-product-thumbnails .woocommerce-product-gallery__image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );

        $this->end_controls_section();

        // Product Badge Style
        $this->start_controls_section(
            'product_badge_style_section',
            [
                'label' => __( 'Product Badge', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_badge_typography',
                    'label' => __( 'Typography', 'woovator-pro' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '.woocommerce {{WRAPPER}} span.onsale,{{WRAPPER}} .woocommerce-product-gallery__image .ht-product-label.ht-product-label-left',
                ]
            );

            $this->add_control(
                'product_badge_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ffffff',
                    'selectors' => [
                        '.woocommerce {{WRAPPER}} span.onsale' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .woocommerce-product-gallery__image .ht-product-label.ht-product-label-left' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_badge_bg_color',
                [
                    'label' => __( 'Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#23252a',
                    'selectors' => [
                        '.woocommerce {{WRAPPER}} span.onsale' => 'background-color: {{VALUE}} !important;',
                        '{{WRAPPER}} .woocommerce-product-gallery__image .ht-product-label.ht-product-label-left' => 'background-color: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'product_badge_border_radius',
                [
                    'label' => __( 'Border Radius', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '.woocommerce {{WRAPPER}} span.onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        '{{WRAPPER}} .woocommerce-product-gallery__image .ht-product-label.ht-product-label-left' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'product_badge_padding',
                [
                    'label' => __( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '.woocommerce {{WRAPPER}} span.onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        '{{WRAPPER}} .woocommerce-product-gallery__image .ht-product-label.ht-product-label-left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // Product Thumbnails Image Style
        $this->start_controls_section(
            'product_image_thumbnails_style_section',
            [
                'label' => __( 'Thumbnails Image', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'product_thumbnais_image_border',
                    'label' => __( 'Product image border', 'woovator-pro' ),
                    'selector' => '.woocommerce {{WRAPPER}} .wvpro-product-thumbnails ul.woovator-thumbanis-image li img, .woocommerce {{WRAPPER}} .wvpro-product-thumbnails .wv-single-gallery img, .woocommerce {{WRAPPER}} .wv-thumbnails-slider .wv-single-slider img,.woocommerce {{WRAPPER}} .woocommerce-product-gallery__image img',
                ]
            );

            $this->add_responsive_control(
                'product_thumbnais_image_border_radius',
                [
                    'label' => __( 'Border Radius', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '.woocommerce {{WRAPPER}} .wvpro-product-thumbnails ul.woovator-thumbanis-image li img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        '.woocommerce {{WRAPPER}} .wvpro-product-thumbnails .wv-single-gallery img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        '.woocommerce {{WRAPPER}} .wv-thumbnails-slider .wv-single-slider img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        '.woocommerce {{WRAPPER}} .woocommerce-product-gallery__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'product_product_thumbnais_padding',
                [
                    'label' => __( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '.woocommerce {{WRAPPER}} .wvpro-product-thumbnails ul.woovator-thumbanis-image li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        '.woocommerce {{WRAPPER}} .wvpro-product-thumbnails .wv-single-gallery' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        '.woocommerce {{WRAPPER}} .wv-thumbnails-slider .wv-single-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        '.woocommerce {{WRAPPER}} .woocommerce-product-gallery__image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );

        $this->end_controls_section();

        // Slider Button style
        $this->start_controls_section(
            'products-slider-controller-style',
            [
                'label' => __( 'Slider Controller Style', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_style' => 'slider',
                ]
            ]
        );

            $this->start_controls_tabs('product_sliderbtn_style_tabs');

                // Slider Button style Normal
                $this->start_controls_tab(
                    'product_sliderbtn_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'woovator-pro' ),
                    ]
                );

                    $this->add_control(
                        'button_style_heading',
                        [
                            'label' => __( 'Navigation Arrow', 'woovator-pro' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_control(
                        'button_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#333333',
                            'selectors' => [
                                '{{WRAPPER}} .wv-thumbnails-slider .slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_bg_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .wv-thumbnails-slider .slick-arrow' => 'background-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .wv-thumbnails-slider .slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wv-thumbnails-slider .slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => __( 'Padding', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wv-thumbnails-slider .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_style_dots_heading',
                        [
                            'label' => __( 'Navigation Dots', 'woovator-pro' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                        $this->add_control(
                            'dots_bg_color',
                            [
                                'label' => __( 'Background Color', 'woovator-pro' ),
                                'type' => Controls_Manager::COLOR,
                                'scheme' => [
                                    'type' => Scheme_Color::get_type(),
                                    'value' => Scheme_Color::COLOR_1,
                                ],
                                'default' =>'#ffffff',
                                'selectors' => [
                                    '{{WRAPPER}} .wv-thumbnails-slider .slick-dots li button' => 'background-color: {{VALUE}} !important;',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            Group_Control_Border::get_type(),
                            [
                                'name' => 'dots_border',
                                'label' => __( 'Border', 'woovator-pro' ),
                                'selector' => '{{WRAPPER}} .wv-thumbnails-slider .slick-dots li button',
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_border_radius',
                            [
                                'label' => __( 'Border Radius', 'woovator-pro' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .wv-thumbnails-slider .slick-dots li button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                ],
                            ]
                        );

                $this->end_controls_tab();// Normal button style end

                // Button style Hover
                $this->start_controls_tab(
                    'product_sliderbtn_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'woovator-pro' ),
                    ]
                );

                    $this->add_control(
                        'button_style_arrow_heading',
                        [
                            'label' => __( 'Navigation', 'woovator-pro' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#23252a',
                            'selectors' => [
                                '{{WRAPPER}} .wv-thumbnails-slider .slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_hover_bg_color',
                        [
                            'label' => __( 'Background', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .wv-thumbnails-slider .slick-arrow:hover' => 'background-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => __( 'Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .wv-thumbnails-slider .slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wv-thumbnails-slider .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );


                    $this->add_control(
                        'button_style_dotshov_heading',
                        [
                            'label' => __( 'Navigation Dots', 'woovator-pro' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                        $this->add_control(
                            'dots_hover_bg_color',
                            [
                                'label' => __( 'Background Color', 'woovator-pro' ),
                                'type' => Controls_Manager::COLOR,
                                'scheme' => [
                                    'type' => Scheme_Color::get_type(),
                                    'value' => Scheme_Color::COLOR_1,
                                ],
                                'default' =>'#282828',
                                'selectors' => [
                                    '{{WRAPPER}} .wv-thumbnails-slider .slick-dots li button:hover' => 'background-color: {{VALUE}} !important;',
                                    '{{WRAPPER}} .wv-thumbnails-slider .slick-dots li.slick-active button' => 'background-color: {{VALUE}} !important;',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            Group_Control_Border::get_type(),
                            [
                                'name' => 'dots_border_hover',
                                'label' => __( 'Border', 'woovator-pro' ),
                                'selector' => '{{WRAPPER}} .wv-thumbnails-slider .slick-dots li button:hover',
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_border_radius_hover',
                            [
                                'label' => __( 'Border Radius', 'woovator-pro' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .wv-thumbnails-slider .slick-dots li button:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                ],
                            ]
                        );

                $this->end_controls_tab();// Hover button style end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Tab option end

    }

    protected function render() {
        $settings  = $this->get_settings_for_display();

        $this->add_render_attribute( 'wv_product_thumbnails_attr', 'class', 'wvpro-product-thumbnails images thumbnails-tab-position-'.$settings['tab_thumbnails_position'] );
        $this->add_render_attribute( 'wv_product_thumbnails_attr', 'class', 'thumbnails-layout-'.$settings['layout_style'] );

         // Slider Options
        $is_rtl = is_rtl();
        $direction = $is_rtl ? 'rtl' : 'ltr';
        $slider_settings = [
            'arrows' => ('yes' === $settings['slarrows']),
            'dots' => ('yes' === $settings['sldots']),
            'autoplay' => ('yes' === $settings['slautolay']),
            'autoplay_speed' => absint($settings['slautoplay_speed']),
            'animation_speed' => absint($settings['slanimation_speed']),
            'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
            'rtl' => $is_rtl,
        ];

        $slider_responsive_settings = [
            'product_items' => $settings['slitems'],
            'scroll_columns' => $settings['slscroll_columns'],
            'tablet_width' => $settings['sltablet_width'],
            'tablet_display_columns' => $settings['sltablet_display_columns'],
            'tablet_scroll_columns' => $settings['sltablet_scroll_columns'],
            'mobile_width' => $settings['slmobile_width'],
            'mobile_display_columns' => $settings['slmobile_display_columns'],
            'mobile_scroll_columns' => $settings['slmobile_scroll_columns'],

        ];
        $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );

        global $product;
        $product = wc_get_product();
        if ( Plugin::instance()->editor->is_edit_mode() ) {
            echo '<div class="product-image">'.__('Advance Product Image','woovator-pro').'</div>';
        }else{

            if ( empty( $product ) ) { return; }
            $gallery_images_ids = $product->get_gallery_image_ids() ? $product->get_gallery_image_ids() : array();
            if ( has_post_thumbnail() ){
                $gallery_images_ids = array( 'wvthumbnails_id' => $product->get_image_id() ) + $gallery_images_ids;
            }
            ?>

            <div <?php echo $this->get_render_attribute_string( 'wv_product_thumbnails_attr' ); ?>>
                <div class="wv-thumbnails-image-area">
                    <?php if( $settings['layout_style'] == 'tab' ): ?>

                        <?php if( $settings['tab_thumbnails_position'] == 'left' || $settings['tab_thumbnails_position'] == 'top' ): ?>
                            <ul class="woovator-thumbanis-image">
                                <?php
                                    foreach ( $gallery_images_ids as $thkey => $gallery_attachment_id ) {
                                        echo '<li data-wvimage="'.wp_get_attachment_image_url( $gallery_attachment_id, 'woocommerce_single' ).'">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_gallery_thumbnail' ).'</li>';
                                    }
                                ?>
                            </ul>
                        <?php endif; ?>
                        <div class="woocommerce-product-gallery__image">
                            <?php
                                woocommerce_show_product_sale_flash();
                                if(function_exists('woovator_custom_product_badge')){
                                    woovator_custom_product_badge();
                                }
                                echo wp_get_attachment_image( reset( $gallery_images_ids ), 'woocommerce_single', '', array( 'class' => 'wp-post-image' ) );
                            ?>
                        </div>
                        <?php if( $settings['tab_thumbnails_position'] == 'right' || $settings['tab_thumbnails_position'] == 'bottom' ): ?>
                            <ul class="woovator-thumbanis-image">
                                <?php
                                    foreach ( $gallery_images_ids as $gallery_attachment_id ) {
                                        echo '<li data-wvimage="'.wp_get_attachment_image_url( $gallery_attachment_id, 'woocommerce_single' ).'">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_gallery_thumbnail' ).'</li>';
                                    }
                                ?>
                            </ul>
                        <?php endif; ?>
                    <?php elseif( $settings['layout_style'] == 'gallery' ): ?>
                        <div class="woocommerce-product-gallery__image wv-single-gallery">
                            <?php
                                woocommerce_show_product_sale_flash();
                                if(function_exists('woovator_custom_product_badge')){
                                    woovator_custom_product_badge();
                                }
                                echo wp_get_attachment_image( reset( $gallery_images_ids ), 'woocommerce_single', '', array( 'class' => 'wp-post-image' ) );
                            ?>
                        </div>
                        <?php
                            $imagecount = sizeof( $gallery_images_ids );
                            foreach ( $gallery_images_ids as $thkey => $gallery_attachment_id ) {
                                if( $thkey === 'wvthumbnails_id' || $imagecount == 1 ){
                                    continue;
                                }else{
                                    echo '<div class="wv-single-gallery">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_single' ).'</div>';
                                }
                            }
                        ?>
                    <?php elseif( $settings['layout_style'] == 'slider' ): ?>
                        <div class="wv-thumbnails-slider" data-settings='<?php echo wp_json_encode( $slider_settings );  ?>'>
                            <?php
                                foreach ( $gallery_images_ids as $gallery_attachment_id ) {
                                    echo '<div class="wv-single-slider">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_single' ).'</div>';
                                }
                            ?>
                        </div>
                    <?php else:?>
                        <div class="woocommerce-product-gallery__image">
                            <?php
                                woocommerce_show_product_sale_flash();
                                if(function_exists('woovator_custom_product_badge')){
                                    woovator_custom_product_badge();
                                }
                                echo wp_get_attachment_image( reset( $gallery_images_ids ), 'woocommerce_single', '', array( 'class' => 'wp-post-image' ) );
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Product_Thumbnails_ELement() );
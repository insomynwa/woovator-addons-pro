<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Woovator_Custom_Product_Archive_Layout_Widget extends Widget_Base {

    public function get_name() {
        return 'woovator-custom-product-archive';
    }
    
    public function get_title() {
        return __( 'WV: Product Archive Layout (Custom)', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-products';
    }
    
    public function get_categories() {
        return [ 'woovator-addons-pro' ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'countdown-min',
            'woovator-widgets-scripts',
            'woovator-widgets-scripts-pro',
        ];
    }

    protected function _register_controls() {

        // Product Content
        $this->start_controls_section(
            'woovator-products-layout-setting',
            [
                'label' => __( 'Layout Settings', 'woovator-pro' ),
            ]
        );

            $this->add_control(
                'woovator_product_view_mode',
                [
                    'label' => __( 'View Mode', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'grid',
                    'options' => [
                        'grid' => __( 'Grid', 'woovator-pro' ),
                        'list' => __( 'List', 'woovator-pro' ),
                    ],

                ]
            );

            $this->add_control(
                'woovator_product_grid_column',
                [
                    'label' => __( 'Columns', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [
                        '1' => __( '1', 'woovator-pro' ),
                        '2' => __( '2', 'woovator-pro' ),
                        '3' => __( '3', 'woovator-pro' ),
                        '4' => __( '4', 'woovator-pro' ),
                        '5' => __( '5', 'woovator-pro' ),
                        '6' => __( '6', 'woovator-pro' ),
                    ],

                ]
            );

            $this->add_control(
                'woovator_product_grid_column_tablet',
                [
                    'label' => esc_html__( 'Tablet Columns', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '2',
                    'options' => [
                        '1' => esc_html__( '1', 'woovator-pro' ),
                        '2' => esc_html__( '2', 'woovator-pro' ),
                        '3' => esc_html__( '3', 'woovator-pro' ),
                        '4' => esc_html__( '4', 'woovator-pro' ),
                        '5' => esc_html__( '5', 'woovator-pro' ),
                        '6' => esc_html__( '6', 'woovator-pro' ),
                    ],

                ]
            );

            $this->add_control(
                'woovator_product_grid_column_mobile',
                [
                    'label' => esc_html__( 'Mobile Columns', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1' => esc_html__( '1', 'woovator-pro' ),
                        '2' => esc_html__( '2', 'woovator-pro' ),
                        '3' => esc_html__( '3', 'woovator-pro' ),
                        '4' => esc_html__( '4', 'woovator-pro' ),
                        '5' => esc_html__( '5', 'woovator-pro' ),
                        '6' => esc_html__( '6', 'woovator-pro' ),
                    ],

                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'woovator-products',
            [
                'label' => __( 'Query Settings', 'woovator-pro' ),
            ]
        );

            $this->add_control(
              'woovator_product_grid_products_count',
                [
                    'label'   => __( 'Product Limit', 'woovator-pro' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => 3,
                    'step'    => 1,
                ]
            );

            $this->add_control(
                'woovator_product_grid_categories',
                [
                    'label' => esc_html__( 'Product Categories', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => woovator_taxonomy_list(),
                ]
            );

            $this->add_control(
                'woovator_custom_order',
                [
                    'label' => __( 'Custom order', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => __( 'Orderby', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'          => __('None','woovator-pro'),
                        'ID'            => __('ID','woovator-pro'),
                        'date'          => __('Date','woovator-pro'),
                        'name'          => __('Name','woovator-pro'),
                        'title'         => __('Title','woovator-pro'),
                        'comment_count' => __('Comment count','woovator-pro'),
                        'rand'          => __('Random','woovator-pro'),
                    ],
                    'condition' => [
                        'woovator_custom_order' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'order',
                [
                    'label' => __( 'order', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC'  => __('Descending','woovator-pro'),
                        'ASC'   => __('Ascending','woovator-pro'),
                    ],
                    'condition' => [
                        'woovator_custom_order' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'query_post_type',
                [
                    'type' => 'hidden',
                    'default' => 'current_query',
                ]
            );

            $this->add_control(
                'paginate',
                [
                    'label' => __( 'Pagination', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'allow_order',
                [
                    'label' => __( 'Allow Order', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_result_count',
                [
                    'label' => __( 'Show Result Count', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_child_category_product',
                [
                    'label' => __( 'Child Category Product', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'description'=> __( 'If there is no product in child category, display from parent category.','woovator-pro' ),
                ]
            );

        $this->end_controls_section();

        // Product Content
        $this->start_controls_section(
            'woovator-products-content-setting',
            [
                'label' => __( 'Content Settings', 'woovator-pro' ),
            ]
        );
            $this->add_control(
                'product_content_style',
                [
                    'label'   => __( 'Style', 'woovator-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Style One', 'woovator-pro' ),
                        '2'  => __( 'Style Two', 'woovator-pro' ),
                        '3'  => __( 'Style Three', 'woovator-pro' ),
                        '4'  => __( 'Style Four', 'woovator-pro' ),
                    ]
                ]
            );

            $this->add_control(
                'hide_product_title',
                [
                    'label'     => __( 'Title Hide', 'woovator-pro' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} .ht-product-inner .ht-product-title' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'hide_product_price',
                [
                    'label'     => __( 'Price Hide', 'woovator-pro' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} .ht-product-inner .ht-product-price' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'hide_product_category',
                [
                    'label'     => __( 'Category Hide', 'woovator-pro' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} .ht-product-inner .ht-product-categories' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'hide_product_ratting',
                [
                    'label'     => __( 'Ratting Hide', 'woovator-pro' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} .ht-product-inner .ht-product-ratting-wrap' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'title_length',
                [
                    'label' => __( 'Title Length', 'woovator-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                    'default' => 3
                ]
            );

        $this->end_controls_section();

        // Product Action Button
        $this->start_controls_section(
            'woovator-products-action-button',
            [
                'label' => __( 'Action Button Settings', 'woovator-pro' ),
            ]
        );
            
            $this->add_control(
                'show_action_button',
                [
                    'label' => __( 'Action Button', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'woovator-pro' ),
                    'label_off' => __( 'Hide', 'woovator-pro' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_quickview_button',
                [
                    'label' => __( 'Quick View Button Hide', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition'=>[
                        'show_action_button'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-action ul li:nth-child(1)' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'show_wishlist_button',
                [
                    'label' => __( 'Wishlist Button Hide', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition'=>[
                        'show_action_button'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-action ul li:nth-child(2)' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'show_compare_button',
                [
                    'label' => __( 'Compare Button Hide', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition'=>[
                        'show_action_button'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-action ul li a.compare' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'show_addtocart_button',
                [
                    'label' => __( 'Shopping Cart Button Hide', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition'=>[
                        'show_action_button'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-action ul li.woovator-cart' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'action_button_style',
                [
                    'label'   => __( 'Style', 'woovator-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Style One', 'woovator-pro' ),
                        '2'   => __( 'Style Two', 'woovator-pro' ),
                        '3'   => __( 'Style Three', 'woovator-pro' ),
                    ],
                    'condition'=>[
                        'show_action_button'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'action_button_show_on',
                [
                    'label'   => __( 'Show On', 'woovator-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'normal',
                    'options' => [
                        'hover'   => __( 'Hover', 'woovator-pro' ),
                        'normal'  => __( 'Normal', 'woovator-pro' ),
                    ],
                    'condition'=>[
                        'show_action_button'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'action_button_position',
                [
                    'label'   => __( 'Position', 'woovator-pro' ),
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
                        'middle' => [
                            'title' => __( 'Middle', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-middle',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-bottom',
                        ],
                        'contentbottom' => [
                            'title' => __( 'Content Bottom', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default'     => is_rtl() ? 'left' : 'right',
                    'toggle'      => false,
                ]
            );

        $this->end_controls_section();

        // Product Image Setting
        $this->start_controls_section(
            'woovator-products-thumbnails-setting',
            [
                'label' => __( 'Image Settings', 'woovator-pro' ),
            ]
        );

            $this->add_control(
                'thumbnails_style',
                [
                    'label'   => __( 'Thumbnails Style', 'woovator-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Single Image', 'woovator-pro' ),
                        '2'  => __( 'Image Slider', 'woovator-pro' ),
                        '3'  => __( 'Gallery Tab', 'woovator-pro' ),
                    ]
                ]
            );

            $this->add_control(
                'image_navigation_bg_color',
                [
                    'label' => __( 'Arrows Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-image .ht-product-image-slider .slick-arrow' => 'color: {{VALUE}} !important;',
                    ],
                    'condition'=>[
                        'thumbnails_style'=>'2',
                    ]
                ]
            );

            $this->add_control(
                'image_dots_normal_bg_color',
                [
                    'label' => __( 'Dots Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#cccccc',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-image .ht-product-image-slider .slick-dots li button' => 'background-color: {{VALUE}} !important;',
                    ],
                    'condition'=>[
                        'thumbnails_style'=>'2',
                    ]
                ]
            );

            $this->add_control(
                'image_dots_hover_bg_color',
                [
                    'label' => __( 'Dots Active Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'condition'=>[
                        'thumbnails_style'=>'2',
                    ],
                    'default' =>'#666666',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-image .ht-product-image-slider .slick-dots li.slick-active button' => 'background-color: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_control(
                'image_tab_menu_border_color',
                [
                    'label' => __( 'Border Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#737373',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-image .ht-product-cus-tab-links li a' => 'border-color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'thumbnails_style'=>'3',
                    ]
                ]
            );

            $this->add_control(
                'image_tab_menu_active_border_color',
                [
                    'label' => __( 'Active Border Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ECC87B',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-image .ht-product-cus-tab-links li a.htactive' => 'border-color: {{VALUE}} !important;',
                    ],
                    'condition'=>[
                        'thumbnails_style'=>'3',
                    ]
                ]
            );

        $this->end_controls_section();

        // Product countdown
        $this->start_controls_section(
            'woovator-products-countdown-setting',
            [
                'label' => __( 'Offer Price Counter Settings', 'woovator-pro' ),
            ]
        );
            $this->add_control(
                'show_countdown',
                [
                    'label' => __( 'Show Countdown Timer', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'woovator-pro' ),
                    'label_off' => __( 'Hide', 'woovator-pro' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show_countdown_gutter',
                [
                    'label' => __( 'Gutter', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'woovator-pro' ),
                    'label_off' => __( 'No', 'woovator-pro' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' =>[
                        'show_countdown' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'product_countdown_position',
                [
                    'label'   => __( 'Position', 'woovator-pro' ),
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
                        'middle' => [
                            'title' => __( 'Middle', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-middle',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-bottom',
                        ],
                        'contentbottom' => [
                            'title' => __( 'Content Bottom', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default'     => 'bottom',
                    'toggle'      => false,
                    'label_block' => true,
                    'condition' =>[
                        'show_countdown' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'custom_labels',
                [
                    'label'        => __( 'Custom Label', 'woovator-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'condition'   => [
                        'show_countdown' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'customlabel_days',
                [
                    'label'       => __( 'Days', 'woovator-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Days', 'woovator-pro' ),
                    'condition'   => [
                        'custom_labels!' => '',
                        'show_countdown' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'customlabel_hours',
                [
                    'label'       => __( 'Hours', 'woovator-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Hours', 'woovator-pro' ),
                    'condition'   => [
                        'custom_labels!' => '',
                        'show_countdown' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'customlabel_minutes',
                [
                    'label'       => __( 'Minutes', 'woovator-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Minutes', 'woovator-pro' ),
                    'condition'   => [
                        'custom_labels!' => '',
                        'show_countdown' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'customlabel_seconds',
                [
                    'label'       => __( 'Seconds', 'woovator-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Seconds', 'woovator-pro' ),
                    'condition'   => [
                        'custom_labels!' => '',
                        'show_countdown' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section();

        // Style Default tab section
        $this->start_controls_section(
            'universal_product_style_section',
            [
                'label' => __( 'Style', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'product_inner_padding',
                [
                    'label' => __( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce div.product.mb-30' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'product_inner_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce div.product.mb-30' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'product_inner_border_color',
                [
                    'label' => __( 'Border Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#f1f1f1',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'product_inner_box_shadow',
                    'label' => __( 'Hover Box Shadow', 'woovator-pro' ),
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner:hover',
                ]
            );

            $this->add_control(
                'product_content_area_heading',
                [
                    'label' => __( 'Content area', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'product_content_area_padding',
                [
                    'label' => __( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'product_content_area_bg_color',
                [
                    'label' => __( 'Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'product_content_area_border',
                    'label' => __( 'Border', 'woovator-pro' ),
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content',
                ]
            );

            $this->add_control(
                'product_badge_heading',
                [
                    'label' => __( 'Product Badge', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'product_badge_color',
                [
                    'label' => __( 'Badge Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-label' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_badge_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-label',
                ]
            );

            // Product Category
            $this->add_control(
                'product_category_heading',
                [
                    'label' => __( 'Product Category', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_category_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-categories a',
                ]
            );

            $this->add_control(
                'product_category_color',
                [
                    'label' => __( 'Category Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-categories a' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-categories::before' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_category_hover_color',
                [
                    'label' => __( 'Category Hover Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#dc9a0e',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-categories a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'product_category_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-categories' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Product Title
            $this->add_control(
                'product_title_heading',
                [
                    'label' => __( 'Product Title', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_title_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-title a',
                ]
            );

            $this->add_control(
                'product_title_color',
                [
                    'label' => __( 'Title Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-title a' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_title_hover_color',
                [
                    'label' => __( 'Title Hover Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#dc9a0e',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-title a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'product_title_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Product Price
            $this->add_control(
                'product_price_heading',
                [
                    'label' => __( 'Product Price', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'product_sale_price_color',
                [
                    'label' => __( 'Sale Price Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-price span' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_sale_price_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-price span',
                ]
            );

            $this->add_control(
                'product_regular_price_color',
                [
                    'label' => __( 'Regular Price Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'separator' => 'before',
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-price span del span,{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-price span del' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_regular_price_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-price span del span',
                ]
            );

            $this->add_responsive_control(
                'product_price_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Product Rating
            $this->add_control(
                'product_rating_heading',
                [
                    'label' => __( 'Product Rating', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'product_rating_color',
                [
                    'label' => __( 'Empty Rating Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#aaaaaa',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-ratting-wrap .ht-product-ratting i' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_rating_give_color',
                [
                    'label' => __( 'Rating Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#dc9a0e',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-ratting-wrap .ht-product-ratting .ht-product-user-ratting i' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'product_rating_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-content .ht-product-content-inner .ht-product-ratting-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section(); // Style Default End

        // Style Action Button tab section
        $this->start_controls_section(
            'universal_product_action_button_style_section',
            [
                'label' => __( 'Action Button Style', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'product_action_button_background_color',
                    'label' => __( 'Background', 'woovator-pro' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'product_action_button_box_shadow',
                    'label' => __( 'Box Shadow', 'woovator-pro' ),
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul',
                ]
            );

            $this->add_control(
                'product_tooltip_heading',
                [
                    'label' => __( 'Tooltip', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

                $this->add_control(
                    'product_tooltip_color',
                    [
                        'label' => __( 'Tool Tip Color', 'woovator-pro' ),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'default' =>'#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li a .ht-product-action-tooltip,{{WRAPPER}} span.woovator-tip' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'product_action_button_tooltip_background_color',
                        'label' => __( 'Background', 'woovator-pro' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li a .ht-product-action-tooltip,{{WRAPPER}} span.woovator-tip',
                    ]
                );

            $this->start_controls_tabs('product_action_button_style_tabs');

                // Normal
                $this->start_controls_tab(
                    'product_action_button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'woovator-pro' ),
                    ]
                );
                    
                    $this->add_control(
                        'product_action_button_normal_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#000000',
                            'selectors' => [
                                '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'product_action_button_font_size',
                        [
                            'label' => __( 'Font Size', 'woovator-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-action ul li a i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .woovator-compare.compare::before,{{WRAPPER}} .ht-product-action ul li.woovator-cart a::before' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'product_action_button_line_height',
                        [
                            'label' => __( 'Line Height', 'woovator-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 30,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-action ul li a i' => 'line-height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .woovator-compare.compare::before,{{WRAPPER}} .ht-product-action ul li.woovator-cart a::before' => 'line-height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'product_action_button_normal_background_color',
                            'label' => __( 'Background', 'woovator-pro' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li',
                        ]
                    );

                    $this->add_responsive_control(
                        'product_action_button_normal_padding',
                        [
                            'label' => __( 'Padding', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'product_action_button_normal_margin',
                        [
                            'label' => __( 'Margin', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'product_action_button_normal_button_border',
                            'label' => __( 'Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li',
                        ]
                    );

                    $this->add_responsive_control(
                        'product_action_button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'product_action_button_width',
                        [
                            'label' => __( 'Width', 'woovator-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 30,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-action ul li a' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'product_action_button_height',
                        [
                            'label' => __( 'Height', 'woovator-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 30,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-action ul li a' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Hover
                $this->start_controls_tab(
                    'product_action_button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'woovator-pro' ),
                    ]
                );
                    
                    $this->add_control(
                        'product_action_button_hover_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#dc9a0e',
                            'selectors' => [
                                '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li:hover a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .ht-product-action .yith-wcwl-wishlistaddedbrowse a, .ht-product-action .yith-wcwl-wishlistexistsbrowse a' => 'color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'product_action_button_hover_background_color',
                            'label' => __( 'Background', 'woovator-pro' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'product_action_button_hover_button_border',
                            'label' => __( 'Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-image-wrap .ht-product-action ul li:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Countdown tab section
        $this->start_controls_section(
            'universal_product_counter_style_section',
            [
                'label' => __( 'Offer Price Counter', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_countdown'=>'yes',
                ]
            ]
        );

            $this->add_control(
                'product_counter_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-countdown-wrap .ht-product-countdown .cd-single .cd-single-inner h3' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-countdown-wrap .ht-product-countdown .cd-single .cd-single-inner p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'product_counter_background_color',
                    'label' => __( 'Counter Background', 'woovator-pro' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-countdown-wrap .ht-product-countdown .cd-single .cd-single-inner,{{WRAPPER}} .ht-products .ht-product.ht-product-countdown-fill .ht-product-inner .ht-product-countdown-wrap .ht-product-countdown',
                ]
            );

            $this->add_responsive_control(
                'product_counter_space_between',
                [
                    'label' => __( 'Space', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-products .ht-product .ht-product-inner .ht-product-countdown-wrap .ht-product-countdown .cd-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Pagination Style Section
        $this->start_controls_section(
            'product-pagination-section',
            [
                'label' => __( 'Pagination', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'paginate' => 'yes',
                ],
            ]
        );
            $this->start_controls_tabs('product_pagination_style_tabs');

                // Pagination normal style
                $this->start_controls_tab(
                    'product_pagination_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'woovator-pro' ),
                    ]
                );
                    
                    $this->add_control(
                        'product_pagination_border_color',
                        [
                            'label' => __( 'Border Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul' => 'border-color: {{VALUE}}',
                                '{{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul li' => 'border-right-color: {{VALUE}}; border-left-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'product_pagination_padding',
                        [
                            'label' => __( 'Padding', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul li a, {{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'product_pagination_link_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul li a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'product_pagination_link_bg_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul li a' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Pagination Active style
                $this->start_controls_tab(
                    'product_pagination_style_active_tab',
                    [
                        'label' => __( 'Active', 'woovator-pro' ),
                    ]
                );
                    
                    $this->add_control(
                        'product_pagination_link_color_hover',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul li a:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul li span.current' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'product_pagination_link_bg_color_hover',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul li a:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}}.elementor-widget-woovator-custom-product-archive nav.woocommerce-pagination ul li span.current' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // List View Style section
        $this->start_controls_section(
            'universal_product_list_style_section',
            [
                'label' => __( 'List View Style', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            // Product Description
            $this->add_control(
                'product_list_viewmode_heading',
                [
                    'label' => __( 'Viewing Mode Button', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'product_list_viewmode_button_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#000000',
                    'selectors' => [
                        '{{WRAPPER}} .wv-shop-tab-links li a' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_viewmode_active_color',
                [
                    'label' => __( 'Active Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#f05b64',
                    'selectors' => [
                        '{{WRAPPER}} .wv-shop-tab-links li a:hover' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wv-shop-tab-links li a.htactive' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Product Description
            $this->add_control(
                'product_list_description_heading',
                [
                    'label' => __( 'Product Description', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_list_description_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .wvshop-list-content .woocommerce-product-details__short-description p',
                ]
            );

            $this->add_control(
                'product_list_description_color',
                [
                    'label' => __( 'Description Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-content .woocommerce-product-details__short-description p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Product Category
            $this->add_control(
                'product_list_category_heading',
                [
                    'label' => __( 'Product Category', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_list_category_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .wvshop-list-content .ht-product-categories a',
                ]
            );

            $this->add_control(
                'product_list_category_color',
                [
                    'label' => __( 'Category Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-content .ht-product-categories a' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_category_hover_color',
                [
                    'label' => __( 'Category Hover Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#dc9a0e',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-content .ht-product-categories a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Product Title
            $this->add_control(
                'product_list_title_heading',
                [
                    'label' => __( 'Product Title', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_list_title_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .wvshop-list-content h3',
                ]
            );

            $this->add_control(
                'product_list_title_color',
                [
                    'label' => __( 'Title Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-content h3 a' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_title_hover_color',
                [
                    'label' => __( 'Title Hover Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#dc9a0e',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-content h3 a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Product Price
            $this->add_control(
                'product_list_price_heading',
                [
                    'label' => __( 'Product Price', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'product_list_sale_price_color',
                [
                    'label' => __( 'Sale Price Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-wrap .wvshop-list-content .ht-product-list-price span.price' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_list_sale_price_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .wvshop-list-wrap .wvshop-list-content .ht-product-list-price span.price',
                ]
            );

            $this->add_control(
                'product_list_regular_price_color',
                [
                    'label' => __( 'Regular Price Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'separator' => 'before',
                    'default' =>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-wrap .wvshop-list-content .ht-product-list-price span.price del span' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_list_regular_price_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .wvshop-list-wrap .wvshop-list-content .ht-product-list-price span.price del span',
                ]
            );

            // Product Rating
            $this->add_control(
                'product_list_rating_heading',
                [
                    'label' => __( 'Product Rating', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'product_list_rating_color',
                [
                    'label' => __( 'Empty Rating Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#aaaaaa',
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce .wvshop-list-price-ratting .star-rating::before' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_rating_give_color',
                [
                    'label' => __( 'Rating Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#dc9a0e',
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce .wvshop-list-price-ratting .star-rating span::before' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // List view cart button
            $this->add_control(
                'product_list_cart_button_heading',
                [
                    'label' => __( 'Add to Cart Button', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'product_list_cart_button_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .woocommerce .ht-product-list-action ul li a',
                ]
            );

            $this->add_control(
                'product_list_cart_button_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#000000',
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce .ht-product-list-action ul li a' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_cart_button_border_color',
                [
                    'label' => __( 'Border Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#000000',
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce .ht-product-list-action ul li a' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_cart_button_background_color',
                [
                    'label' => __( 'Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce .ht-product-list-action ul li a' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_cart_button_hover_color',
                [
                    'label' => __( 'Hover Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce .ht-product-list-action ul li a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_cart_button_hover_border_color',
                [
                    'label' => __( 'Hover Border Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ff3535',
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce .ht-product-list-action ul li a:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_cart_button_hover_background_color',
                [
                    'label' => __( 'Hover Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ff3535',
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce .ht-product-list-action ul li a:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            // List view quickview button
            $this->add_control(
                'product_list_quickview_button_heading',
                [
                    'label' => __( 'Quickview Button', 'woovator-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'product_list_quickview_button_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#000000',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-wrap .wvproduct-list-img .product-quickview a' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_quickview_button_background_color',
                [
                    'label' => __( 'Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-wrap .wvproduct-list-img .product-quickview a' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_quickview_button_hover_color',
                [
                    'label' => __( 'Hover Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-wrap .wvproduct-list-img .product-quickview a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'product_list_quickview_button_hover_background_color',
                [
                    'label' => __( 'Hover Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ff3535',
                    'selectors' => [
                        '{{WRAPPER}} .wvshop-list-wrap .wvproduct-list-img .product-quickview a:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    public function woovator_custom_product_limit( $limit = 3 ) {
        $limit = $this->get_settings_for_display( 'woovator_product_grid_products_count' );
        return $limit;
    }

    protected function render( $instance = [] ) {

        $settings           = $this->get_settings_for_display();
        $per_page           = $this->get_settings_for_display('woovator_product_grid_products_count');
        $custom_order_ck    = $this->get_settings_for_display('woovator_custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $order              = $this->get_settings_for_display('order');
        $tabuniqid          = $this->get_id();
        $columns            = $this->get_settings_for_display('woovator_product_grid_column');

        // Query Argument
        add_filter( 'product_custom_limit', array( $this, 'woovator_custom_product_limit' ) );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $per_page,
            'paged'                 => $paged, 
        );
        $args['meta_query']   = WC()->query->get_meta_query();
        $args['tax_query']    = [];

        // Category Wise
        $get_product_categories = $settings['woovator_product_grid_categories'];
        $product_cats = str_replace(' ', '', $get_product_categories);
        if( !is_tax('product_cat') && !is_product_category() ){
            if ( "0" != $get_product_categories) {
                if( is_array($product_cats) && count($product_cats) > 0 ){
                    $field_name = is_numeric($product_cats[0])?'term_id':'slug';
                    $args['tax_query'][] = array(
                        array(
                            'taxonomy' => 'product_cat',
                            'terms' => $product_cats,
                            'field' => $field_name,
                            'include_children' => false
                        )
                    );
                }
            }
        }

        // Taxonomy Taxquery
        $termobj = get_queried_object();
        if( isset( $termobj->taxonomy ) ){

            $term_id = $termobj->term_id;
            $showchildcat = $settings['show_child_category_product'];

            if( $showchildcat == 'yes' ){
                $catprod = get_term( $termobj->term_id, $termobj->taxonomy );
                $term_id = ( ( $catprod->count == 0 ) ? $termobj->parent : $termobj->term_id );
            }

            $args['tax_query'] = array(
                array(
                    'taxonomy' => $termobj->taxonomy,
                    'terms' => $term_id,
                    'field' => 'term_id',
                    'include_children' => false
                )
            );
            
        }

        if( $custom_order_ck == 'yes' ){
            $args['orderby'] = $orderby;
            $args['order'] = $order;
        }

        $ordering_args = WC()->query->get_catalog_ordering_args();
        if ( $ordering_args['meta_key'] ) {
            $args['meta_key'] = $ordering_args['meta_key'];
        }

        // Fintering by price
        if( isset( $_GET['min_price'] ) || isset( $_GET['max_price'] ) ){
            $args['meta_query'] = array(
                array(
                    'key' => '_price',
                    'value' => array( $_GET['min_price'], $_GET['max_price'] ),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                ),
            );
        }

        $getorderby = '';
        if ( isset( $_GET['orderby'] ) ) {
            $getorderby = $_GET['orderby'];
        }

        // When current Query is active.
        if ( 'current_query' == $settings['query_post_type'] ) {
            add_action( 'pre_get_posts', [ wc()->query, 'product_query' ] );
        }

        $products = new \WP_Query( $args );

        // Calculate Column
        $collumval = 'ht-product ht-col-lg-4 ht-col-md-6 ht-col-sm-6 ht-col-xs-12 mb-30 product';
        if( $columns !='' ){
            if( $columns == 5 ){
                $collumval = 'ht-product cus-col-5 ht-col-md-6 ht-col-sm-6 ht-col-xs-12 mb-30 product';
            }else{
                $colwidth = round( 12 / $columns );
                $colwidthtablate = round( 12 / $settings['woovator_product_grid_column_tablet'] );
                $colwidthmobile = round( 12 / $settings['woovator_product_grid_column_mobile'] );
                $collumval = 'ht-product ht-col-lg-'.$colwidth.' ht-col-md-'.$colwidthtablate.' ht-col-sm-'.$colwidthtablate.' ht-col-xs-'.$colwidthmobile.' mb-30 product';
            }
        }

        // Action Button Style
        if( $settings['action_button_style'] == 2 ){
            $collumval .= ' ht-product-action-style-2';
        }elseif( $settings['action_button_style'] == 3 ){
            $collumval .= ' ht-product-action-style-2 ht-product-action-round';
        }else{
            $collumval = $collumval;
        }

        // Position Action Button
        if( $settings['action_button_position'] == 'right' ){
            $collumval .= ' ht-product-action-right';
        }elseif( $settings['action_button_position'] == 'bottom' ){
            $collumval .= ' ht-product-action-bottom';
        }elseif( $settings['action_button_position'] == 'middle' ){
            $collumval .= ' ht-product-action-middle';
        }elseif( $settings['action_button_position'] == 'contentbottom' ){
            $collumval .= ' ht-product-action-bottom-content';
        }else{
            $collumval = $collumval;
        }

        // Show Action
        if( $settings['action_button_show_on'] == 'hover' ){
            $collumval .= ' ht-product-action-on-hover';
        }

        // Content Style
        if( $settings['product_content_style'] == 2 ){
            $collumval .= ' ht-product-category-right-bottom';
        }elseif( $settings['product_content_style'] == 3 ){
            $collumval .= ' ht-product-ratting-top-right';
        }elseif( $settings['product_content_style'] == 4 ){
            $collumval .= ' ht-product-content-allcenter';
        }else{
            $collumval = $collumval;
        }

        // Position countdown
        if( $settings['product_countdown_position'] == 'left' ){
            $collumval .= ' ht-product-countdown-left';
        }elseif( $settings['product_countdown_position'] == 'right' ){
            $collumval .= ' ht-product-countdown-right';
        }elseif( $settings['product_countdown_position'] == 'middle' ){
            $collumval .= ' ht-product-countdown-middle';
        }elseif( $settings['product_countdown_position'] == 'bottom' ){
            $collumval .= ' ht-product-countdown-bottom';
        }elseif( $settings['product_countdown_position'] == 'contentbottom' ){
            $collumval .= ' ht-product-countdown-content-bottom';
        }else{
            $collumval = $collumval;
        }

        // Countdown Gutter 
        if( $settings['show_countdown_gutter'] != 'yes' ){
           $collumval .= ' ht-product-countdown-fill'; 
        }

        // Countdown Custom Label
        if( $settings['show_countdown'] == 'yes' ){
            $data_customlavel = [];
            $data_customlavel['daytxt'] = ! empty( $settings['customlabel_days'] ) ? $settings['customlabel_days'] : 'Days';
            $data_customlavel['hourtxt'] = ! empty( $settings['customlabel_hours'] ) ? $settings['customlabel_hours'] : 'Hours';
            $data_customlavel['minutestxt'] = ! empty( $settings['customlabel_minutes'] ) ? $settings['customlabel_minutes'] : 'Min';
            $data_customlavel['secondstxt'] = ! empty( $settings['customlabel_seconds'] ) ? $settings['customlabel_seconds'] : 'Sec';
        }

        if( $products->have_posts() ):

            echo '<div class="woocommerce ht-row"><div class="ht-col-xs-12">';
                ?>
                    <ul class="wv-shop-tab-links">
                        <li><a href="#grid" class="<?php if( $settings['woovator_product_view_mode'] == 'grid' ){ echo 'htactive'; } ?>"><i class="sli sli-grid"></i></a></li>
                        <li><a href="#list" class="<?php if( $settings['woovator_product_view_mode'] == 'list' ){ echo 'htactive'; } ?>"><i class="sli sli-menu"></i></a></li>
                    </ul>
                <?php
                if( $settings['show_result_count'] == 'yes' ){
                    woovator_product_result_count( $products->found_posts, $per_page, $paged );
                }
                if( $settings['allow_order'] == 'yes' ){
                    woocommerce_catalog_ordering();
                }
            echo '</div></div>';
        ?>
            <div class="ht-products woocommerce" >

                <div class="wv-shop-tab-pane <?php if( $settings['woovator_product_view_mode'] == 'grid' ){ echo 'htactive'; } ?>" id="grid">
                    <div class="ht-row">
                        <?php
                            while( $products->have_posts() ): $products->the_post();

                                // Sale Schedule
                                $offer_start_date_timestamp = get_post_meta( get_the_ID(), '_sale_price_dates_from', true );
                                $offer_start_date = $offer_start_date_timestamp ? date_i18n( 'Y/m/d', $offer_start_date_timestamp ) : '';
                                $offer_end_date_timestamp = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
                                $offer_end_date = $offer_end_date_timestamp ? date_i18n( 'Y/m/d', $offer_end_date_timestamp ) : '';

                                // Gallery Image
                                global $product;
                                $gallery_images_ids = $product->get_gallery_image_ids() ? $product->get_gallery_image_ids() : array();
                                if ( has_post_thumbnail() ){
                                    array_unshift( $gallery_images_ids, $product->get_image_id() );
                                }

                        ?>

                            <!--Product Start-->
                            <div class="<?php echo $collumval; ?>">
                                <div class="ht-product-inner">

                                    <div class="ht-product-image-wrap">
                                        <?php
                                            if( class_exists('WooCommerce') ){ 
                                                woovator_custom_product_badge(); 
                                                woovator_sale_flash();
                                            }
                                        ?>
                                        <div class="ht-product-image">
                                            <?php  if( $settings['thumbnails_style'] == 2 && $gallery_images_ids ): ?>
                                                <div class="ht-product-image-slider ht-product-image-thumbnaisl-<?php echo $tabuniqid; ?>" data-slick='{"rtl":<?php if( is_rtl() ){ echo 'true'; }else{ echo 'false'; } ?> }'>
                                                    <?php
                                                        foreach ( $gallery_images_ids as $gallery_attachment_id ) {
                                                            echo '<a href="'.esc_url( get_the_permalink() ).'" class="item">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_thumbnail' ).'</a>';
                                                        }
                                                    ?>
                                                </div>

                                            <?php elseif( $settings['thumbnails_style'] == 3 && $gallery_images_ids ) : $tabactive = ''; ?>
                                                <div class="ht-product-cus-tab">
                                                    <?php
                                                        $i = 0;
                                                        foreach ( $gallery_images_ids as $gallery_attachment_id ) {
                                                            $i++;
                                                            if( $i == 1 ){ $tabactive = 'htactive'; }else{ $tabactive = ' '; }
                                                            echo '<div class="ht-product-cus-tab-pane '.$tabactive.'" id="image-'.$i.get_the_ID().'"><a href="#">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_thumbnail' ).'</a></div>';
                                                        }
                                                    ?>
                                                </div>
                                                <ul class="ht-product-cus-tab-links">
                                                    <?php
                                                        $j = 0;
                                                        foreach ( $gallery_images_ids as $gallery_attachment_id ) {
                                                            $j++;
                                                            if( $j == 1 ){ $tabactive = 'htactive'; }else{ $tabactive = ' '; }
                                                            echo '<li><a href="#image-'.$j.get_the_ID().'" class="'.$tabactive.'">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_gallery_thumbnail' ).'</a></li>';
                                                        }
                                                    ?>
                                                </ul>

                                            <?php else: ?>
                                                <a href="<?php the_permalink();?>"> 
                                                    <?php woocommerce_template_loop_product_thumbnail(); ?> 
                                                </a>
                                            <?php endif; ?>
                                        </div>

                                        <?php if( $settings['show_countdown'] == 'yes' && $settings['product_countdown_position'] != 'contentbottom' && $offer_end_date != '' ):

                                            if( $offer_start_date_timestamp && $offer_end_date_timestamp && current_time( 'timestamp' ) > $offer_start_date_timestamp && current_time( 'timestamp' ) < $offer_end_date_timestamp
                                            ): 
                                        ?>
                                            <div class="ht-product-countdown-wrap">
                                                <div class="ht-product-countdown" data-countdown="<?php echo esc_attr( $offer_end_date ); ?>" data-customlavel='<?php echo wp_json_encode( $data_customlavel ) ?>'></div>
                                            </div>
                                        <?php endif; endif; ?>

                                        <?php if( $settings['show_action_button'] == 'yes' ){ if( $settings['action_button_position'] != 'contentbottom' ): ?>
                                            <div class="ht-product-action">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0);" class="woovatorquickview" data-quick-id="<?php the_ID();?>" >
                                                            <i class="sli sli-magnifier"></i>
                                                            <span class="ht-product-action-tooltip"><?php esc_html_e('Quick View','woovator'); ?></span>
                                                        </a>
                                                    </li>
                                                    <?php
                                                        if ( class_exists( 'YITH_WCWL' ) ) {
                                                            echo '<li>'.woovator_add_to_wishlist_button('<i class="sli sli-heart"></i>','<i class="sli sli-heart"></i>', 'yes').'</li>';
                                                        }
                                                        if( class_exists('TInvWL_Public_AddToWishlist') ){
                                                            echo '<li>';
                                                                \TInvWL_Public_AddToWishlist::instance()->htmloutput();
                                                            echo '</li>';
                                                        }
                                                    ?>
                                                    <?php
                                                        if( function_exists('woovator_compare_button') && class_exists('YITH_Woocompare_Frontend') ){
                                                            echo '<li>';
                                                                woovator_compare_button(2);
                                                            echo '</li>';
                                                        }
                                                    ?>
                                                    <li class="woovator-cart"><?php woocommerce_template_loop_add_to_cart(); ?></li>
                                                </ul>
                                            </div>
                                        <?php endif; } ?>

                                    </div>

                                    <div class="ht-product-content">
                                        <div class="ht-product-content-inner">
                                            <div class="ht-product-categories"><?php woovator_get_product_category_list(); ?></div>
                                            <h4 class="ht-product-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a></h4>
                                            <div class="ht-product-price"><?php woocommerce_template_loop_price();?></div>
                                            <div class="ht-product-ratting-wrap"><?php echo woovator_wc_get_rating_html(); ?></div>

                                            <?php if( $settings['show_action_button'] == 'yes' ){ if( $settings['action_button_position'] == 'contentbottom' ): ?>
                                                <div class="ht-product-action">
                                                    <ul>
                                                        <li>
                                                            <a href="javascript:void(0);" class="woovatorquickview" data-quick-id="<?php the_ID();?>" >
                                                                <i class="sli sli-magnifier"></i>
                                                                <span class="ht-product-action-tooltip"><?php esc_html_e('Quick View','woovator'); ?></span>
                                                            </a>
                                                        </li>
                                                        <?php
                                                            if ( class_exists( 'YITH_WCWL' ) ) {
                                                                echo '<li>'.woovator_add_to_wishlist_button('<i class="sli sli-heart"></i>','<i class="sli sli-heart"></i>', 'yes').'</li>';
                                                            }
                                                            if( class_exists('TInvWL_Public_AddToWishlist') ){
                                                                echo '<li>';
                                                                    \TInvWL_Public_AddToWishlist::instance()->htmloutput();
                                                                echo '</li>';
                                                            }
                                                        ?>
                                                        <?php
                                                            if( function_exists('woovator_compare_button') && class_exists('YITH_Woocompare_Frontend') ){
                                                                echo '<li>';
                                                                    woovator_compare_button(2);
                                                                echo '</li>';
                                                            }
                                                        ?>
                                                        <li class="woovator-cart"><?php woocommerce_template_loop_add_to_cart(); ?></li>
                                                    </ul>
                                                </div>
                                            <?php endif; } ?>

                                        </div>
                                        <?php 
                                            if( $settings['show_countdown'] == 'yes' && $settings['product_countdown_position'] == 'contentbottom' && $offer_end_date != ''  ):

                                                if( $offer_start_date_timestamp && $offer_end_date_timestamp && current_time( 'timestamp' ) > $offer_start_date_timestamp && current_time( 'timestamp' ) < $offer_end_date_timestamp
                                                ):
                                        ?>
                                            <div class="ht-product-countdown-wrap">
                                                <div class="ht-product-countdown" data-countdown="<?php echo esc_attr( $offer_end_date ); ?>" data-customlavel='<?php echo wp_json_encode( $data_customlavel ) ?>'></div>
                                            </div>
                                        <?php endif; endif; ?>
                                    </div>

                                </div>
                            </div>
                            <!--Product End-->

                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="wv-shop-tab-pane <?php if( $settings['woovator_product_view_mode'] == 'list' ){ echo 'htactive'; } ?>" id="list">
                    <div class="ht-row">

                        <?php while( $products->have_posts() ): $products->the_post();

                            // Sale Schedule
                            $offer_start_date_timestamp = get_post_meta( get_the_ID(), '_sale_price_dates_from', true );
                            $offer_start_date = $offer_start_date_timestamp ? date_i18n( 'Y/m/d', $offer_start_date_timestamp ) : '';
                            $offer_end_date_timestamp = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
                            $offer_end_date = $offer_end_date_timestamp ? date_i18n( 'Y/m/d', $offer_end_date_timestamp ) : '';

                            // Gallery Image
                            global $product;
                            $gallery_images_ids = $product->get_gallery_image_ids() ? $product->get_gallery_image_ids() : array();
                            if ( has_post_thumbnail() ){
                                array_unshift( $gallery_images_ids, $product->get_image_id() );
                            }

                        ?>
                        <div class="ht-col-xs-12">
                            <div class="wvshop-list-wrap">
                                <div class="ht-row">
                                    
                                    <div class="ht-col-md-4 ht-col-sm-4 ht-col-xs-12 ht-product">
                                        <div class="wvproduct-list-img">
                                            <div class="ht-product-inner">

                                                <div class="ht-product-image-wrap">
                                                    <?php
                                                        if( class_exists('WooCommerce') ){ 
                                                            woovator_custom_product_badge(); 
                                                            woovator_sale_flash();
                                                        }
                                                    ?>
                                                    <div class="ht-product-image">
                                                        <?php  if( $settings['thumbnails_style'] == 2 && $gallery_images_ids ): ?>
                                                            <div class="ht-product-image-slider ht-product-image-thumbnaisl-<?php echo $tabuniqid; ?>" data-slick='{"rtl":<?php if( is_rtl() ){ echo 'true'; }else{ echo 'false'; } ?> }'>
                                                                <?php
                                                                    foreach ( $gallery_images_ids as $gallery_attachment_id ) {
                                                                        echo '<a href="'.esc_url( get_the_permalink() ).'" class="item">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_thumbnail' ).'</a>';
                                                                    }
                                                                ?>
                                                            </div>

                                                        <?php elseif( $settings['thumbnails_style'] == 3 && $gallery_images_ids ) : $tabactive = ''; ?>
                                                            <div class="ht-product-cus-tab">
                                                                <?php
                                                                    $i = 0;
                                                                    foreach ( $gallery_images_ids as $gallery_attachment_id ) {
                                                                        $i++;
                                                                        if( $i == 1 ){ $tabactive = 'htactive'; }else{ $tabactive = ' '; }
                                                                        echo '<div class="ht-product-cus-tab-pane '.$tabactive.'" id="image-'.$i.get_the_ID().'"><a href="#">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_thumbnail' ).'</a></div>';
                                                                    }
                                                                ?>
                                                            </div>
                                                            <ul class="ht-product-cus-tab-links">
                                                                <?php
                                                                    $j = 0;
                                                                    foreach ( $gallery_images_ids as $gallery_attachment_id ) {
                                                                        $j++;
                                                                        if( $j == 1 ){ $tabactive = 'htactive'; }else{ $tabactive = ' '; }
                                                                        echo '<li><a href="#image-'.$j.get_the_ID().'" class="'.$tabactive.'">'.wp_get_attachment_image( $gallery_attachment_id, 'woocommerce_gallery_thumbnail' ).'</a></li>';
                                                                    }
                                                                ?>
                                                            </ul>

                                                        <?php else: ?>
                                                            <a href="<?php the_permalink();?>"> 
                                                                <?php woocommerce_template_loop_product_thumbnail(); ?> 
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>

                                                    <?php if( $settings['show_countdown'] == 'yes' && $settings['product_countdown_position'] != 'contentbottom' && $offer_end_date != '' ):

                                                        if( $offer_start_date_timestamp && $offer_end_date_timestamp && current_time( 'timestamp' ) > $offer_start_date_timestamp && current_time( 'timestamp' ) < $offer_end_date_timestamp
                                                        ): 
                                                    ?>
                                                        <div class="ht-product-countdown-wrap">
                                                            <div class="ht-product-countdown" data-countdown="<?php echo esc_attr( $offer_end_date ); ?>" data-customlavel='<?php echo wp_json_encode( $data_customlavel ) ?>'></div>
                                                        </div>
                                                    <?php endif; endif; ?>

                                                    <div class="product-quickview">
                                                        <a href="javascript:void(0);" class="woovatorquickview" data-quick-id="<?php the_ID();?>" >
                                                            <i class="sli sli-magnifier-add"></i>
                                                        </a>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="ht-col-md-8 ht-col-sm-8 ht-col-xs-12">
                                        <div class="wvshop-list-content">
                                            <h3>
                                                <a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a>
                                            </h3>
                                            <?php  woocommerce_template_single_excerpt(); ?>
                                            <div class="ht-product-categories">
                                                <?php woovator_get_product_category_list(); ?>
                                            </div>

                                            <div class="wvshop-list-price-action-wrap">
                                                <div class="wvshop-list-price-ratting">
                                                    <div class="ht-product-list-price">
                                                        <?php woocommerce_template_loop_price(); ?>
                                                    </div>
                                                    <div class="ht-product-list-ratting">
                                                        <div class="ht-product-ratting-wrap">
                                                            <?php woocommerce_template_loop_rating();?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ht-product-list-action">
                                                    <ul>
                                                        <li class="cart-list">
                                                            <?php woocommerce_template_loop_add_to_cart(); ?>
                                                        </li>
                                                        <li>
                                                            <?php
                                                                if ( class_exists( 'YITH_WCWL' ) && function_exists('woovator_add_to_wishlist_button')) {
                                                                    echo woovator_add_to_wishlist_button('<i class="sli sli-heart"></i>','<i class="sli sli-heart"></i>', 'no');
                                                                }
                                                                if( class_exists('TInvWL_Public_AddToWishlist') ){
                                                                    echo '<li>';
                                                                        \TInvWL_Public_AddToWishlist::instance()->htmloutput();
                                                                    echo '</li>';
                                                                }
                                                            ?>
                                                        </li>
                                                        <li><?php if( function_exists('woovator_compare_button') && class_exists('YITH_Woocompare_Frontend') ){ woovator_compare_button(1); } ?></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>

                    </div>
                </div>

            </div>
            <?php endif; ?>

            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    function woovator_tabs_pro( $tabmenus, $tabpane ){
                        $tabmenus.on('click', 'a', function(e){
                            e.preventDefault();
                            var $this = $(this),
                                $target = $this.attr('href');
                            $this.addClass('htactive').parent().siblings().children('a').removeClass('htactive');
                            $( $tabpane + $target ).addClass('htactive').siblings().removeClass('htactive');

                            // refresh slick
                            $id = $this.attr('href');
                            $($id).find('.slick-slider').slick('refresh');
                        });
                    }
                    woovator_tabs_pro( $(".wv-shop-tab-links"), '.wv-shop-tab-pane' );
                });
            </script>

            <?php if ( Plugin::instance()->editor->is_edit_mode() ) { ?>
                <script>
                    jQuery(document).ready(function($) {
                        'use strict';
                        $(".ht-product-image-thumbnaisl-<?php echo $tabuniqid; ?>").slick({
                            dots: true,
                            arrows: true,
                            prevArrow: '<button class="slick-prev"><i class="sli sli-arrow-left"></i></button>',
                            nextArrow: '<button class="slick-next"><i class="sli sli-arrow-right"></i></button>',
                        });
                    });
                </script>
            <?php } ?>

            <?php 
            if( $products->max_num_pages > 1 && $settings['paginate'] == 'yes' ){ woovator_custom_pagination( $products->max_num_pages ); }
            remove_action( 'pre_get_posts', [ wc()->query, 'product_query' ] );
            wp_reset_postdata();

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Woovator_Custom_Product_Archive_Layout_Widget() );
<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Product_Stock_Progressbar_Element extends Widget_Base {

    public function get_name() {
        return 'wv-stock-progressbar';
    }
    
    public function get_title() {
        return __( 'WV: Available Stock Progressbar', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-skill-bar';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_stock_progressbar',
            [
                'label' => __( 'Stock Progressbar', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'hide_order_counter',
                [
                    'label'     => __( 'Hide Order Counter', 'woovator-pro' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} .wvtotal-sold' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'hide_available_counter',
                [
                    'label'     => __( 'Hide Available Counter', 'woovator-pro' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} .wvcurrent-stock' => 'display: none !important;',
                    ],
                ]
            );

            $this->add_control(
                'order_custom_text',
                [
                    'label' => __( 'Ordered Custom Text', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Ordered', 'woovator-pro' ),
                    'condition' => [
                        'hide_order_counter!' => 'yes',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'available_custom_text',
                [
                    'label' => __( 'Available Custom Text', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Items available', 'woovator-pro' ),
                    'condition' => [
                        'hide_available_counter!' => 'yes',
                    ],
                    'label_block' => true,
                ]
            );

        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'section_stock_progressbar_style',
            [
                'label' => __( 'Stock Progressbar', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'progressbar_height',
                [
                    'label' => __( 'Height', 'woovator-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator-stock-progress-bar .wvprogress-area' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'progressbar_bg_color',
                [
                    'label' => __( 'Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator-stock-progress-bar .wvprogress-area' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'progressbar_active_bg_color',
                [
                    'label' => __( 'Sell Progress Background Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator-stock-progress-bar .wvprogress-bar' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'progressbar_area',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator-stock-progress-bar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Order and Ability Style
        $this->start_controls_section(
            'section_stock_order_ability_style',
            [
                'label' => __( 'Order & Ability Counter', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'order_ability_typography',
                    'label' => __( 'Typography', 'woovator-pro' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .woovator-stock-progress-bar .wvstock-info',
                ]
            );

            $this->add_control(
                'order_ability_color',
                [
                    'label' => __( 'Label Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator-stock-progress-bar .wvstock-info' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'counter_number_color',
                [
                    'label' => __( 'Counter Number Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator-stock-progress-bar .wvstock-info span' => 'color: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $order_text     = $settings['order_custom_text'] ? $settings['order_custom_text'] : 'Ordered:';
        $available_text = $settings['available_custom_text'] ? $settings['available_custom_text'] : 'Items available:';

        if ( Plugin::instance()->editor->is_edit_mode() ) {
            echo '<div class="stock-management-progressbar">'.__('Stock Management Progress Bar','woovator-pro').'</div>';
        }else{
            $this->manage_stock_status( $order_text, $available_text );
        }
    }

    protected function manage_stock_status( $order_text, $available_text ){

        $product_id  = get_the_ID();
        if ( get_post_meta( $product_id, '_manage_stock', true ) == 'yes' ) {

            $total_stock = get_post_meta( $product_id, 'woovator_total_stock_quantity', true );

            if ( ! $total_stock ) { return; }

            $current_stock = round( get_post_meta( $product_id, '_stock', true ) );

            $total_sold = $total_stock > $current_stock ? $total_stock - $current_stock : 0;
            $percentage = $total_sold > 0 ? round( $total_sold / $total_stock * 100 ) : 0;

            if ( $current_stock > 0 ) {

                echo '<div class="woovator-stock-progress-bar">';
                    echo '<div class="wvstock-info">';
                        echo '<div class="wvtotal-sold">' . __( $order_text, 'woovator-pro' ) . '<span>' . esc_html( $total_sold ) . '</span></div>';
                        echo '<div class="wvcurrent-stock">' . __( $available_text, 'woovator-pro' ) . '<span>' . esc_html( $current_stock ) . '</span></div>';
                    echo '</div>';
                    echo '<div class="wvprogress-area" title="' . __( 'Sold', 'woovator-pro' ) . ' ' . esc_attr( $percentage ) . '%">';
                        echo '<div class="wvprogress-bar"style="width:' . esc_attr( $percentage ) . '%;"></div>';
                    echo '</div>';
                echo '</div>';
            }

        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Product_Stock_Progressbar_Element() );
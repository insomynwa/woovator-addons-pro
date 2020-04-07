<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Product_Cross_Sell_Element extends Widget_Base {

    public function get_name() {
        return 'wv-cross-sell';
    }
    
    public function get_title() {
        return __( 'WV: Cross Sell', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-woocommerce';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_cross_sells',
            [
                'label' => __( 'Cross Sells', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'limit',
                [
                    'label' => __( 'Limit', 'woovator-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 2,
                    'min' => 1,
                    'max' => 16,
                ]
            );
            
            $this->add_responsive_control(
                'columns',
                [
                    'label' => __( 'Columns', 'woovator-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'prefix_class' => 'elementor-products-columns%s-',
                    'default' => 2,
                    'min' => 1,
                    'max' => 16,
                ]
            );
            
            $this->add_control(
                'orderby',
                [
                    'label' => __( 'Orderby', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'rand',
                    'options' => [
                        'rand' => __( 'Random', 'woovator-pro' ),
                        'date' => __( 'Publish Date', 'woovator-pro' ),
                        'modified' => __( 'Modified Date', 'woovator-pro' ),
                        'title' => __( 'Alphabetic', 'woovator-pro' ),
                        'popularity' => __( 'Popularity', 'woovator-pro' ),
                        'rating' => __( 'Rate', 'woovator-pro' ),
                        'price' => __( 'Price', 'woovator-pro' ),
                    ],
                ]
            );
            
            $this->add_control(
                'order',
                [
                    'label' => __( 'Order', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'desc',
                    'options' => [
                        'desc' => __( 'DESC', 'woovator-pro' ),
                        'asc' => __( 'ASC', 'woovator-pro' ),
                    ],
                ]
            );
        
        $this->end_controls_section();

        // Heading
        $this->start_controls_section(
            'cross_sell_heading_style',
            array(
                'label' => __( 'Heading', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'cross_sell_heading_typography',
                    'label'     => __( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} .cross-sells > h2',
                )
            );

            $this->add_control(
                'cross_sell_heading_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cross-sells > h2' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cross_sell_heading_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .cross-sells > h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cross_sell_heading_align',
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
                        '{{WRAPPER}} .cross-sells > h2' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        woocommerce_cross_sell_display( $settings['limit'], $settings['columns'], $settings['orderby'], $settings['order'] );
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Product_Cross_Sell_Element() );
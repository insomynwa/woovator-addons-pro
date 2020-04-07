<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Product_Empty_Cart_Redirect_Button_ELement extends Widget_Base {

    public function get_name() {
        return 'wv-empty-cart-redirectbtn';
    }

    public function get_title() {
        return __( 'WV: Empty Cart Redirect Button', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-woocommerce';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {

        // Product Content
        $this->start_controls_section(
            'empty_cart_content',
            [
                'label' => esc_html__( 'Content', 'woovator-pro' ),
            ]
        );
            
            $this->add_control(
                'cart_custom_btn_txt',
                [
                    'label' => __( 'Button Custom Text', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Enter your custom button text', 'woovator-pro' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'cart_redirect_btn_link',
                [
                    'label' => __( 'Button Custom Link', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Enter your button custom link', 'woovator-pro' ),
                    'label_block'=>true,
                ]
            );

        $this->end_controls_section();
        
        // Style
        $this->start_controls_section(
            'cart_custom_message_style',
            array(
                'label' => __( 'Style', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->start_controls_tabs('button_style_tabs');

                // Tab menu style Normal
                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'woovator-pro' ),
                    ]
                );

                    $this->add_control(
                        'button_text_color',
                        [
                            'label' => __( 'Text Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#515151',
                            'selectors' => [
                                '{{WRAPPER}} a.button.wc-backward' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_background_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#ebe9eb',
                            'selectors' => [
                                '{{WRAPPER}} a.button.wc-backward' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Button Hover
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'woovator-pro' ),
                    ]
                );
                    
                    $this->add_control(
                        'button_text_hover_color',
                        [
                            'label' => __( 'Text Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#515151',
                            'selectors' => [
                                '{{WRAPPER}} a.button.wc-backward:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_background_hover_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#ebe9eb',
                            'selectors' => [
                                '{{WRAPPER}} a.button.wc-backward:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_control(
                'button_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} a.button.wc-backward' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'button_padding',
                [
                    'label' => __( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} a.button.wc-backward' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $button_text = 'Return to shop';
        if( !empty($settings['cart_custom_btn_txt']) ){
            $button_text = $settings['cart_custom_btn_txt'];
        }
        if ( wc_get_page_id( 'shop' ) > 0 ) :
            $buttonlink = wc_get_page_permalink( 'shop' );
            if( !empty( $settings['cart_redirect_btn_link'] ) ){
                $buttonlink = $settings['cart_redirect_btn_link'];
            }
            ?>
                <p class="return-to-shop">
                    <a class="button wc-backward" href="<?php echo esc_url( $buttonlink ); ?>">
                        <?php echo esc_html( $button_text ); ?>
                    </a>
                </p>
            <?php
        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Product_Empty_Cart_Redirect_Button_ELement() );
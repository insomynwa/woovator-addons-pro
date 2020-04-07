<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Myaccount_logout_ELement extends Widget_Base {

    public function get_name() {
        return 'wv-myaccount-logout';
    }

    public function get_title() {
        return __( 'WV: Myaccount Logout', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-sign-out';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {
        
        // Style
        $this->start_controls_section(
            'logout_content_style',
            array(
                'label' => __( 'Style', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            $this->start_controls_tabs('logout_style_tabs');

                $this->start_controls_tab(
                    'logout_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'woovator-pro' ),
                    ]
                );

                    $this->add_control(
                        'logout_content_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .woovator-customer-logout a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'logout_content_bg_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .woovator-customer-logout a' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        array(
                            'name'      => 'logout_content_typography',
                            'label'     => __( 'Typography', 'woovator-pro' ),
                            'selector'  => '{{WRAPPER}} .woovator-customer-logout a',
                        )
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'logout_content_border',
                            'label' => __( 'Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .woovator-customer-logout a',
                        ]
                    );

                    $this->add_responsive_control(
                        'logout_content_border_radius',
                        [
                            'label' => __( 'Border Radius', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .woovator-customer-logout a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'logout_content_padding',
                        [
                            'label' => __( 'Padding', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .woovator-customer-logout a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; display:inline-block;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'alignment',
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
                                '{{WRAPPER}} .woovator-customer-logout' => 'text-align: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Logout Hover
                $this->start_controls_tab(
                    'logout_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'woovator-pro' ),
                    ]
                );
                    $this->add_control(
                        'logout_content_text_hover_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .woovator-customer-logout a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'logout_content_hover_bg_color',
                        [
                            'label' => __( 'Background Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .woovator-customer-logout a:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'logout_content_hover_border',
                            'label' => __( 'Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .woovator-customer-logout a:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();
        

    }

    protected function render() {
        if ( Plugin::instance()->editor->is_edit_mode() ) {
            foreach ( wc_get_account_menu_items() as $endpoint => $label ) :
                if( $endpoint == 'customer-logout' ):
                    ?>
                        <div class="woovator-customer-logout">
                            <a href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>"><?php echo esc_html( $label ); ?></a>
                        </div>
                    <?php
                endif;
            endforeach;
        }else{
            if ( ! is_user_logged_in() ) { return __('You need to logged in first', 'woovator-pro'); }
            foreach ( wc_get_account_menu_items() as $endpoint => $label ) :
                if( $endpoint == 'customer-logout' ):
                    ?>
                        <div class="woovator-customer-logout">
                            <a href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>"><?php echo esc_html( $label ); ?></a>
                        </div>
                    <?php
                endif;
            endforeach;
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Myaccount_logout_ELement() );
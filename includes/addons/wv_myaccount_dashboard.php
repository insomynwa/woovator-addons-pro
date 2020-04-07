<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Myaccount_Dashboard_ELement extends Widget_Base {

    public function get_name() {
        return 'wv-myaccount-dashboard';
    }

    public function get_title() {
        return __( 'WV: Myaccount Dashboard', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-woocommerce';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {
        
        // Style
        $this->start_controls_section(
            'myaccount_content_style',
            array(
                'label' => __( 'Style', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->add_control(
                'myaccount_text_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
            $this->add_control(
                'myaccount_link_color',
                [
                    'label' => __( 'Link Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'myaccount_text_typography',
                    'selector' => '{{WRAPPER}}',
                ]
            );
            
            $this->add_responsive_control(
                'myaccount_alignment',
                [
                    'label' => __( 'Alignment', 'woovator-pro' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'woovator-pro' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'woovator-pro' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'woovator-pro' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'woovator-pro' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'prefix_class' => 'elementor%s-align-',
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}}' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render() {
        if ( Plugin::instance()->editor->is_edit_mode() ) {
            wc_get_template( 'myaccount/dashboard.php', array(
                'current_user' => get_user_by( 'id', get_current_user_id() ),
            ) );
        }else{
            if ( ! is_user_logged_in() ) { return __('You need to logged in first', 'woovator-pro'); }
            wc_get_template( 'myaccount/dashboard.php', array(
                'current_user' => get_user_by( 'id', get_current_user_id() ),
            ) );
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Myaccount_Dashboard_ELement() );
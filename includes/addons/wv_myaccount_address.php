<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Myaccount_Address_ELement extends Widget_Base {

    public function get_name() {
        return 'wv-account-address-edit';
    }

    public function get_title() {
        return __( 'WV: Myaccount Address', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-woocommerce';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {
        
        // Heading
        $this->start_controls_section(
            'address_heading_style',
            array(
                'label' => __( 'Heading', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'address_heading_typography',
                    'label'     => __( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} .woocommerce-Address-title h3',
                )
            );

            $this->add_control(
                'address_heading_color',
                [
                    'label' => __( 'Heading Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-Address-title h3' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'address_heading_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-Address-title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Address
        $this->start_controls_section(
            'address_content_style',
            array(
                'label' => __( 'Address', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'address_content_typography',
                    'label'     => __( 'Typography', 'woovator-pro' ),
                    'selector'  => '{{WRAPPER}} address',
                )
            );

            $this->add_control(
                'address_content_color',
                [
                    'label' => __( 'Address Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} address' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'address_content_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} address' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'address_content_align',
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
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}} address' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render() {
        if ( Plugin::instance()->editor->is_edit_mode() ) {
            global $wp;
            $type = '';
            if( isset( $wp->query_vars['edit-address'] ) ){
                $type = $wp->query_vars['edit-address'];
            }else{ $type = wc_edit_address_i18n( sanitize_title( $type ), true ); }
            echo '<div class="my-accouunt-form-edit-address">';
                \WC_Shortcode_My_Account::edit_address( $type );
            echo '</div>';
        }else{
            if ( ! is_user_logged_in() ) { return __('You need first to be logged in', 'woovator-pro'); }
            global $wp;
            $type = '';
            if( isset( $wp->query_vars['edit-address'] ) ){
                $type = $wp->query_vars['edit-address'];
            }else{ $type = wc_edit_address_i18n( sanitize_title( $type ), true ); }
            echo '<div class="my-accouunt-form-edit-address">';
                \WC_Shortcode_My_Account::edit_address( $type );
            echo '</div>';
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Myaccount_Address_ELement() );
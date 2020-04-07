<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Myaccount_Account_ELement extends Widget_Base {

    public function get_name() {
        return 'wv-myaccount-account';
    }

    public function get_title() {
        return __( 'WV: My Account', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-elementor';
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'myaccount_content_setting',
            [
                'label' => esc_html__( 'Settings', 'woovator-pro' ),
            ]
        );
            
            $this->add_control(
                'user_info_show',
                [
                    'label' => esc_html__( 'User Info', 'woovator-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'woovator-pro' ),
                    'label_off' => esc_html__( 'No', 'woovator-pro' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'menu_items',
                [
                    'label' => esc_html__( 'Menu Items', 'woovator-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'dashboard',
                    'options' => [
                        'dashboard' => esc_html__( 'Dashboard', 'woovator-pro' ),
                        'orders' => esc_html__( 'Orders', 'woovator-pro' ),
                        'downloads' => esc_html__( 'Downloads', 'woovator-pro' ),
                        'edit-address' => esc_html__( 'Addresses', 'woovator-pro' ),
                        'edit-account' => esc_html__( 'Account details', 'woovator-pro' ),
                        'customer-logout' => esc_html__( 'Logout', 'woovator-pro' ),
                        'customadd' => esc_html__( 'Custom', 'woovator-pro' ),
                    ],
                ]
            );

            $repeater->add_control(
                'menu_title', 
                [
                    'label' => esc_html__( 'Menu Title', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'New Menu Item' , 'woovator-pro' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'menu_key', 
                [
                    'label' => esc_html__( 'Menu Key', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'newmenuitem' , 'woovator-pro' ),
                    'label_block' => true,
                    'condition'=>[
                        'menu_items'=>'customadd',
                    ],
                ]
            );

            $repeater->add_control(
                'menu_url', 
                [
                    'label' => esc_html__( 'Menu URL', 'woovator-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( '#' , 'woovator-pro' ),
                    'label_block' => true,
                    'condition'=>[
                        'menu_items'=>'customadd',
                    ],
                ]
            );

            $this->add_control(
                'navigation_list',
                [
                    'label' => __( 'Navigation List', 'woovator-pro' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'menu_items' => 'dashboard',
                            'menu_title' => esc_html__( 'Dashboard', 'woovator-pro' ),
                        ],
                        [
                            'menu_items' => 'orders',
                            'menu_title' => esc_html__( 'Orders', 'woovator-pro' ),
                        ],
                        [
                            'menu_items' => 'downloads',
                            'menu_title' => esc_html__( 'Downloads', 'woovator-pro' ),
                        ],
                        [
                            'menu_items' => 'edit-address',
                            'menu_title' => esc_html__( 'Addresses', 'woovator-pro' ),
                        ],
                        [
                            'menu_items' => 'edit-account',
                            'menu_title' => esc_html__( 'Account details', 'woovator-pro' ),
                        ],
                        [
                            'menu_items' => 'customer-logout',
                            'menu_title' => esc_html__( 'Logout', 'woovator-pro' ),
                        ],
                    ],
                    'title_field' => '{{{ menu_title }}}',
                ]
            );

        $this->end_controls_section();

        // My Account User Info Style
        $this->start_controls_section(
            'myaccount_user_info_style',
            array(
                'label' => __( 'User Info', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'user_info_show'=>'yes'
                ]
            )
        );
                    
            $this->add_control(
                'myaccount_usermeta_text_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woovator-user-info' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'myaccount_usermeta_link_color',
                [
                    'label' => __( 'Logout Link', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woovator-logout a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'myaccount_usermeta_link_hover_color',
                [
                    'label' => __( 'Logout Link Hover', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woovator-logout a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'myaccount_usermeta_name_typography',
                    'label' => __( 'Name Typography', 'woovator-pro' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .woovator_myaccount_page .woovator-username',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'myaccount_usermeta_logout_typography',
                    'label' => __( 'Logout Typography', 'woovator-pro' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .woovator_myaccount_page .woovator-logout',
                ]
            );

            $this->add_responsive_control(
                'myaccount_usermeta_image_border_radius',
                [
                    'label' => __( 'Image Border Radius', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woovator-user-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'myaccount_usermeta_alignment',
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
                    ],
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woovator-user-area' => 'justify-content: {{VALUE}}',
                    ],
                ]
            );


        $this->end_controls_section();


        // My Account Menu Style
        $this->start_controls_section(
            'myaccount_menu_style',
            array(
                'label' => __( 'Menu', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'myaccount_menu_type',
                [
                    'label'   => __( 'Menu Type', 'woovator-pro' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'hleft' => [
                            'title' => __( 'Horizontal Left', 'woovator-pro' ),
                            'icon'  => 'eicon-h-align-left',
                        ],
                        'hright' => [
                            'title' => __( 'Horizontal Right', 'woovator-pro' ),
                            'icon'  => 'eicon-h-align-right',
                        ],
                        'vtop' => [
                            'title' => __( 'Vertical Top', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-top',
                        ],
                        'vbottom' => [
                            'title' => __( 'Vertical Bottom', 'woovator-pro' ),
                            'icon'  => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default'     => is_rtl() ? 'hright' : 'hleft',
                    'toggle'      => false,
                ]
            );

            $this->add_responsive_control(
                'myaccount_menu_area_margin',
                [
                    'label' => __( 'Menu Area Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'myaccount_menu_alignment',
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
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

            $this->start_controls_tabs('myaccount_menu_style_tabs');

                $this->add_responsive_control(
                    'myaccount_menu_area_width',
                    [
                        'label' => __( 'Menu Area Width', 'woovator-pro' ),
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
                            'unit' => '%',
                            'size' => 30,
                        ],
                        'condition'=>[
                            'myaccount_menu_type' => array( 'hleft','hright' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                // Menu Normal Color
                $this->start_controls_tab(
                    'myaccount_menu_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'woovator-pro' ),
                    ]
                );
                    
                    $this->add_control(
                        'myaccount_menu_text_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation ul li a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'myaccount_menu_text_typography',
                            'label' => __( 'Typography', 'woovator-pro' ),
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation ul li a',
                        ]
                    );

                    $this->add_responsive_control(
                        'myaccount_menu_padding',
                        [
                            'label' => __( 'Padding', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'myaccount_menu_margin',
                        [
                            'label' => __( 'Margin', 'woovator-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'myaccount_menu_border',
                            'label' => __( 'Border', 'woovator-pro' ),
                            'selector' => '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation ul li',
                        ]
                    );

                $this->end_controls_tab();

                // Menu Hover
                $this->start_controls_tab(
                    'myaccount_menu_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'woovator-pro' ),
                    ]
                );
                    
                    $this->add_control(
                        'myaccount_menu_text_hover_color',
                        [
                            'label' => __( 'Color', 'woovator-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation ul li a:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-navigation ul li.is-active a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'myaccount_content_style',
            array(
                'label' => __( 'Content', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->add_responsive_control(
                'myaccount_content_area_width',
                [
                    'label' => __( 'Content Area Width', 'woovator-pro' ),
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
                        'unit' => '%',
                        'size' => 68,
                    ],
                    'condition'=>[
                        'myaccount_menu_type' => array( 'hleft','hright' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-content' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'myaccount_text_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-content' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
            $this->add_control(
                'myaccount_link_color',
                [
                    'label' => __( 'Link Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-content a' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'myaccount_text_typography',
                    'selector' => '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-content',
                ]
            );

            $this->add_responsive_control(
                'myaccount_content_padding',
                [
                    'label' => __( 'Padding', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'myaccount_content_margin',
                [
                    'label' => __( 'Margin', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
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
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .woovator_myaccount_page .woocommerce-MyAccount-content' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( Plugin::instance()->editor->is_edit_mode() ) {
            $this->my_account_content( $settings['navigation_list'], $settings['user_info_show'], $settings['myaccount_menu_type'] );
        }else{
            if ( ! is_user_logged_in() ) { return __('You need to logged in first', 'woovator-pro'); }
            $this->my_account_content( $settings['navigation_list'], $settings['user_info_show'], $settings['myaccount_menu_type'] );
        }
        
    }

    public function my_account_content( $settings, $userinfo, $menutype ){
        $items       = array();
        $item_url    = array();
        if( isset( $settings ) ){
            foreach ( $settings as $key => $navigation ) {
                if( $navigation['menu_items'] == 'customadd' ){
                    $items[$navigation['menu_key']] = $navigation['menu_title'];
                    $item_url[$navigation['menu_key']] = $navigation['menu_url'];
                }else{
                   $items[$navigation['menu_items']] = $navigation['menu_title'];
               }
            }
        }else{
            $items = [
                'dashboard'       => esc_html__( 'Dashboard', 'woovator-pro' ),
                'orders'          => esc_html__( 'Orders', 'woovator-pro' ),
                'downloads'       => esc_html__( 'Downloads', 'woovator-pro' ),
                'edit-address'    => esc_html__( 'Addresses', 'woovator-pro' ),
                'edit-account'    => esc_html__( 'Account details', 'woovator-pro' ),
                'customer-logout' => esc_html__( 'Logout', 'woovator-pro' ),
            ];
        }
        
        new \WooVator_MyAccount( $items, $item_url, $userinfo );

        echo '<div class="woovator_myaccount_page woovator_myaccount_menu_pos_'.$menutype.'">';
            if( $menutype === 'vtop' || $menutype === 'hleft' ){ do_action( 'woocommerce_account_navigation' );}
            echo '<div class="woocommerce-MyAccount-content">';
                    do_action( 'woocommerce_account_content' );
            echo '</div>';
            if( $menutype === 'vbottom' || $menutype === 'hright' ){ do_action( 'woocommerce_account_navigation' ); }
        echo '</div>';
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Myaccount_Account_ELement() );
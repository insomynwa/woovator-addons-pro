<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WV_Product_Sale_Schedule_Element extends Widget_Base {

    public function get_name() {
        return 'wv-product-sale-schedule';
    }
    
    public function get_title() {
        return __( 'WV: Product Sale Schedule', 'woovator-pro' );
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_script_depends() {
        return [
            'countdown-min',
            'woovator-widgets-scripts-pro',
        ];
    }

    public function get_categories() {
        return array( 'woovator-addons-pro' );
    }

    protected function _register_controls() {

         // Sale Schedule
        $this->start_controls_section(
            'wv-products-sale-schedule-setting',
            [
                'label' => esc_html__( 'Sale Schedule', 'woovator-pro' ),
            ]
        );

            $this->add_control(
                'customlabel_days',
                [
                    'label'       => __( 'Days', 'woovator-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Days', 'woovator-pro' ),
                ]
            );

            $this->add_control(
                'customlabel_hours',
                [
                    'label'       => __( 'Hours', 'woovator-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Hours', 'woovator-pro' ),
                ]
            );

            $this->add_control(
                'customlabel_minutes',
                [
                    'label'       => __( 'Minutes', 'woovator-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Minutes', 'woovator-pro' ),
                ]
            );

            $this->add_control(
                'customlabel_seconds',
                [
                    'label'       => __( 'Seconds', 'woovator-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Seconds', 'woovator-pro' ),
                ]
            );

        $this->end_controls_section();

        // Style Countdown tab section
        $this->start_controls_section(
            'sale_schedule_counter_style_section',
            [
                'label' => __( 'Style', 'woovator-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'sale_schedule_counter_color',
                [
                    'label' => __( 'Color', 'woovator-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' =>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .ht-product-countdown-wrap .ht-product-countdown .cd-single .cd-single-inner h3' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .ht-product-countdown-wrap .ht-product-countdown .cd-single .cd-single-inner p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'sale_schedule_counter_background_color',
                    'label' => __( 'Counter Background', 'woovator-pro' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ht-product-countdown-wrap .ht-product-countdown .cd-single .cd-single-inner',
                ]
            );

            $this->add_responsive_control(
                'sale_schedule_counter_space_between',
                [
                    'label' => __( 'Space', 'woovator-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-product-countdown-wrap .ht-product-countdown .cd-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

    }

    protected function render() {

        $settings    = $this->get_settings_for_display();

        // Countdown Custom Label
        $data_customlavel = [];
        $data_customlavel['daytxt'] = ! empty( $settings['customlabel_days'] ) ? $settings['customlabel_days'] : 'Days';
        $data_customlavel['hourtxt'] = ! empty( $settings['customlabel_hours'] ) ? $settings['customlabel_hours'] : 'Hours';
        $data_customlavel['minutestxt'] = ! empty( $settings['customlabel_minutes'] ) ? $settings['customlabel_minutes'] : 'Min';
        $data_customlavel['secondstxt'] = ! empty( $settings['customlabel_seconds'] ) ? $settings['customlabel_seconds'] : 'Sec';

        // Sale Schedule
        $offer_start_date_timestamp = get_post_meta( get_the_ID(), '_sale_price_dates_from', true );
        $offer_start_date = $offer_start_date_timestamp ? date_i18n( 'Y/m/d', $offer_start_date_timestamp ) : '';
        $offer_end_date_timestamp = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
        $offer_end_date = $offer_end_date_timestamp ? date_i18n( 'Y/m/d', $offer_end_date_timestamp ) : '';

        if ( Plugin::instance()->editor->is_edit_mode() ) {
            echo '<div class="ht-single-product-countdown">'.__( 'Sale Schedule Counter', 'woovator-pro' ).'</div>';
        }else{
            if( $offer_end_date != '' ):
                if( $offer_start_date_timestamp && $offer_end_date_timestamp && current_time( 'timestamp' ) > $offer_start_date_timestamp && current_time( 'timestamp' ) < $offer_end_date_timestamp
                ): 
            ?>
                <div class="ht-single-product-countdown ht-product-countdown-wrap">
                    <div class="ht-product-countdown" data-countdown="<?php echo esc_attr( $offer_end_date ); ?>" data-customlavel='<?php echo wp_json_encode( $data_customlavel ) ?>'></div>
                </div>
            <?php endif; endif;
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WV_Product_Sale_Schedule_Element() );
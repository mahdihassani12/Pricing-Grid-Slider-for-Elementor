<?php
namespace Mahdi_Pricing_Plans\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Pricing_Plans_Widget extends Widget_Base {
    public function get_name() {
        return 'mahdi_pricing_plans';
    }

    public function get_title() {
        return esc_html__( 'Pricing Grid & Slider for Elementor', 'pricing-grid-slider-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'mahdi-widgets' ];
    }

    public function get_keywords() {
        return [ 'pricing', 'plans', 'table', 'subscription', 'slider', 'grid', 'rtl' ];
    }

    public function get_style_depends() {
        return [ 'swiper', 'e-swiper', 'pricing-grid-slider-for-elementor' ];
    }

    public function get_script_depends() {
        return [ 'elementor-frontend', 'pricing-grid-slider-for-elementor' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_layout',
            [ 'label' => esc_html__( 'Layout', 'pricing-grid-slider-for-elementor' ) ]
        );

        $this->add_control(
            'layout_type',
            [
                'label'   => esc_html__( 'Display Mode', 'pricing-grid-slider-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'   => esc_html__( 'Grid', 'pricing-grid-slider-for-elementor' ),
                    'slider' => esc_html__( 'Slider', 'pricing-grid-slider-for-elementor' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'     => esc_html__( 'Grid Columns', 'pricing-grid-slider-for-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options'   => [ '1' => '1', '2' => '2', '3' => '3', '4' => '4' ],
                'selectors' => [
                    '{{WRAPPER}} .mpp-pricing-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
                ],
                'condition' => [ 'layout_type' => 'grid' ],
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => esc_html__( 'Gap', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [ 'px' => [ 'min' => 0, 'max' => 80 ] ],
                'default' => [ 'size' => 24, 'unit' => 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .mpp-pricing-grid' => 'gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mpp-pricing-slider .swiper-wrapper' => 'align-items: stretch;',
                    '{{WRAPPER}} .mpp-pricing-wrapper' => '--mpp-slider-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'equal_height',
            [
                'label' => esc_html__( 'Equal Height Cards', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'pricing-grid-slider-for-elementor' ),
                'label_off' => esc_html__( 'No', 'pricing-grid-slider-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'slider_options_heading',
            [
                'label' => esc_html__( 'Slider Options', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [ 'layout_type' => 'slider' ],
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => esc_html__( 'Slides Per View', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [ '1' => '1', '2' => '2', '3' => '3', '4' => '4' ],
                'condition' => [ 'layout_type' => 'slider' ],
            ]
        );

        $this->add_control(
            'slider_loop',
            [
                'label' => esc_html__( 'Loop', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
                'condition' => [ 'layout_type' => 'slider' ],
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
                'condition' => [ 'layout_type' => 'slider' ],
            ]
        );

        $this->add_control(
            'slider_arrows',
            [
                'label' => esc_html__( 'Arrows', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [ 'layout_type' => 'slider' ],
            ]
        );

        $this->add_control(
            'slider_dots',
            [
                'label' => esc_html__( 'Pagination Dots', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [ 'layout_type' => 'slider' ],
            ]
        );


        $this->add_responsive_control(
            'slider_side_padding',
            [
                'label' => esc_html__( 'Slider Side Padding', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [ 'px' => [ 'min' => 0, 'max' => 120 ] ],
                'default' => [ 'size' => 0, 'unit' => 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .mpp-pricing-slider' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'layout_type' => 'slider' ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_plans',
            [ 'label' => esc_html__( 'Pricing Grid & Slider for Elementor', 'pricing-grid-slider-for-elementor' ) ]
        );

        $plan_repeater = new Repeater();

        $plan_repeater->add_control( 'badge_text', [
            'label' => esc_html__( 'Badge', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Popular', 'pricing-grid-slider-for-elementor' ),
            'label_block' => true,
        ] );

        $plan_repeater->add_control( 'title', [
            'label' => esc_html__( 'Title', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Pro', 'pricing-grid-slider-for-elementor' ),
            'label_block' => true,
        ] );

        $plan_repeater->add_control( 'subtitle', [
            'label' => esc_html__( 'Subtitle', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__( 'For growing businesses that need more power.', 'pricing-grid-slider-for-elementor' ),
        ] );

        $plan_repeater->add_control( 'currency', [
            'label' => esc_html__( 'Currency', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::TEXT,
            'default' => '$',
        ] );

        $plan_repeater->add_control( 'price', [
            'label' => esc_html__( 'Price', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::TEXT,
            'default' => '29',
        ] );

        $plan_repeater->add_control( 'period', [
            'label' => esc_html__( 'Period', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( '/ month', 'pricing-grid-slider-for-elementor' ),
        ] );

        $feature_repeater = new Repeater();

        $feature_repeater->add_control( 'feature_text', [
            'label' => esc_html__( 'Label', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Unlimited projects', 'pricing-grid-slider-for-elementor' ),
            'label_block' => true,
        ] );

        $feature_repeater->add_control( 'feature_icon', [
            'label' => esc_html__( 'Icon', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-check',
                'library' => 'fa-solid',
            ],
            'skin' => 'inline',
            'label_block' => false,
        ] );

        $feature_repeater->add_control( 'feature_icon_color', [
            'label' => esc_html__( 'Icon Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
        ] );

        $feature_repeater->add_control( 'feature_text_color', [
            'label' => esc_html__( 'Label Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
        ] );

        $plan_repeater->add_control( 'features_list', [
            'label' => esc_html__( 'Features', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $feature_repeater->get_controls(),
            'default' => $this->get_default_features( [
                'Unlimited projects',
                'Priority support',
                'Advanced analytics',
                'Custom integrations',
            ] ),
            'title_field' => '<span class="elementor-control-title"><i class="{{ feature_icon.value }}"></i> {{{ feature_text }}}</span>',
        ] );

        $plan_repeater->add_control( 'button_text', [
            'label' => esc_html__( 'Button Text', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Get Started', 'pricing-grid-slider-for-elementor' ),
        ] );

        $plan_repeater->add_control( 'button_link', [
            'label' => esc_html__( 'Button Link', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::URL,
            'placeholder' => 'https://example.com',
            'default' => [ 'url' => '#' ],
        ] );

        $plan_repeater->add_control( 'is_featured', [
            'label' => esc_html__( 'Featured Plan', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default' => '',
        ] );

        $this->add_control(
            'plans',
            [
                'label' => esc_html__( 'Plans', 'pricing-grid-slider-for-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $plan_repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default' => $this->get_default_plans(),
            ]
        );

        $this->end_controls_section();

        $this->register_style_controls();
    }

    private function register_style_controls() {
        $this->start_controls_section( 'section_card_style', [
            'label' => esc_html__( 'Card', 'pricing-grid-slider-for-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_responsive_control( 'card_padding', [
            'label' => esc_html__( 'Padding', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', 'rem', '%' ],
            'default' => [ 'top' => 32, 'right' => 28, 'bottom' => 32, 'left' => 28, 'unit' => 'px' ],
            'selectors' => [ '{{WRAPPER}} .mpp-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );

        $this->add_control( 'card_radius', [
            'label' => esc_html__( 'Border Radius', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem', '%' ],
            'range' => [ 'px' => [ 'min' => 0, 'max' => 80 ] ],
            'default' => [ 'size' => 24, 'unit' => 'px' ],
            'selectors' => [ '{{WRAPPER}} .mpp-card' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->start_controls_tabs( 'card_style_tabs' );
        $this->start_controls_tab( 'card_normal', [ 'label' => esc_html__( 'Normal', 'pricing-grid-slider-for-elementor' ) ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name' => 'card_background',
            'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .mpp-card',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'card_border',
            'selector' => '{{WRAPPER}} .mpp-card',
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name' => 'card_shadow',
            'selector' => '{{WRAPPER}} .mpp-card',
        ] );
        $this->end_controls_tab();

        $this->start_controls_tab( 'card_hover', [ 'label' => esc_html__( 'Hover', 'pricing-grid-slider-for-elementor' ) ] );
        $this->add_control( 'card_hover_transform', [
            'label' => esc_html__( 'Lift on Hover', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default' => 'yes',
        ] );
        $this->add_control( 'card_hover_border_color', [
            'label' => esc_html__( 'Border Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-card:hover' => 'border-color: {{VALUE}};' ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name' => 'card_hover_shadow',
            'selector' => '{{WRAPPER}} .mpp-card:hover',
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section( 'section_typography_style', [
            'label' => esc_html__( 'Typography & Colors', 'pricing-grid-slider-for-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'title_color', [
            'label' => esc_html__( 'Title Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-title' => 'color: {{VALUE}};' ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .mpp-title',
        ] );
        $this->add_control( 'subtitle_color', [
            'label' => esc_html__( 'Subtitle Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-subtitle' => 'color: {{VALUE}};' ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'subtitle_typography',
            'selector' => '{{WRAPPER}} .mpp-subtitle',
        ] );
        $this->add_control( 'price_color', [
            'label' => esc_html__( 'Price Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-price-wrap' => 'color: {{VALUE}};' ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'price_typography',
            'selector' => '{{WRAPPER}} .mpp-price',
        ] );
        $this->add_control( 'feature_color', [
            'label' => esc_html__( 'Feature Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-feature' => 'color: {{VALUE}};' ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'feature_typography',
            'selector' => '{{WRAPPER}} .mpp-feature-label',
        ] );
        $this->end_controls_section();

        $this->start_controls_section( 'section_features_style', [
            'label' => esc_html__( 'Features List', 'pricing-grid-slider-for-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_responsive_control( 'features_gap', [
            'label' => esc_html__( 'Items Gap', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-features' => 'gap: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'feature_icon_gap', [
            'label' => esc_html__( 'Icon Gap', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-feature' => 'gap: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_control( 'feature_icon_color', [
            'label' => esc_html__( 'Icon Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-feature-icon' => 'color: {{VALUE}};' ],
        ] );

        $this->add_control( 'feature_icon_bg', [
            'label' => esc_html__( 'Icon Background', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-feature-icon' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'feature_icon_size', [
            'label' => esc_html__( 'Icon Size', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 6, 'max' => 60 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-feature-icon' => 'font-size: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'feature_icon_box_size', [
            'label' => esc_html__( 'Icon Box Size', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 10, 'max' => 90 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-feature-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_control( 'feature_icon_radius', [
            'label' => esc_html__( 'Icon Radius', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-feature-icon' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'feature_icon_border',
            'selector' => '{{WRAPPER}} .mpp-feature-icon',
        ] );

        $this->end_controls_section();

        $this->start_controls_section( 'section_slider_style', [
            'label' => esc_html__( 'Slider Navigation', 'pricing-grid-slider-for-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [ 'layout_type' => 'slider' ],
        ] );

        $this->add_control( 'slider_arrows_heading', [
            'label' => esc_html__( 'Arrows', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::HEADING,
        ] );

        $this->add_responsive_control( 'arrow_size', [
            'label' => esc_html__( 'Button Size', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 24, 'max' => 100 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'arrow_icon_size', [
            'label' => esc_html__( 'Icon Size', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 6, 'max' => 36 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-button::before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'arrow_offset', [
            'label' => esc_html__( 'Side Offset', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => -80, 'max' => 120 ] ],
            'selectors' => [
                '{{WRAPPER}} .mpp-swiper-prev' => 'left: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .mpp-swiper-next' => 'right: {{SIZE}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .mpp-swiper-prev, .rtl {{WRAPPER}} .mpp-swiper-prev' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
                'body.rtl {{WRAPPER}} .mpp-swiper-next, .rtl {{WRAPPER}} .mpp-swiper-next' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
            ],
        ] );

        $this->add_control( 'arrow_color', [
            'label' => esc_html__( 'Icon Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-button::before' => 'border-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'arrow_bg', [
            'label' => esc_html__( 'Background', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-button' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'arrow_hover_color', [
            'label' => esc_html__( 'Hover Icon Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-button:hover::before' => 'border-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'arrow_hover_bg', [
            'label' => esc_html__( 'Hover Background', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-button:hover' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'arrow_radius', [
            'label' => esc_html__( 'Border Radius', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [ 'px' => [ 'min' => 0, 'max' => 80 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-button' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'arrow_border',
            'selector' => '{{WRAPPER}} .mpp-swiper-button',
        ] );

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name' => 'arrow_shadow',
            'selector' => '{{WRAPPER}} .mpp-swiper-button',
        ] );

        $this->add_control( 'slider_dots_heading', [
            'label' => esc_html__( 'Pagination', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_responsive_control( 'dots_size', [
            'label' => esc_html__( 'Dot Size', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 4, 'max' => 40 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'dots_gap', [
            'label' => esc_html__( 'Dots Gap', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-pagination' => 'gap: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'dots_bottom_offset', [
            'label' => esc_html__( 'Bottom Offset', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'range' => [ 'px' => [ 'min' => -40, 'max' => 120 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_control( 'dots_color', [
            'label' => esc_html__( 'Dot Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'dots_active_color', [
            'label' => esc_html__( 'Active Dot Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};' ],
        ] );

        $this->end_controls_section();

        $this->start_controls_section( 'section_button_style', [
            'label' => esc_html__( 'Button', 'pricing-grid-slider-for-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_responsive_control( 'button_padding', [
            'label' => esc_html__( 'Padding', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', 'rem' ],
            'selectors' => [ '{{WRAPPER}} .mpp-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );
        $this->add_control( 'button_radius', [
            'label' => esc_html__( 'Border Radius', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
            'selectors' => [ '{{WRAPPER}} .mpp-button' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ] );
        $this->start_controls_tabs( 'button_style_tabs' );
        $this->start_controls_tab( 'button_normal', [ 'label' => esc_html__( 'Normal', 'pricing-grid-slider-for-elementor' ) ] );
        $this->add_control( 'button_color', [
            'label' => esc_html__( 'Text Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-button' => 'color: {{VALUE}};' ],
        ] );
        $this->add_control( 'button_bg', [
            'label' => esc_html__( 'Background', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-button' => 'background-color: {{VALUE}};' ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'button_hover', [ 'label' => esc_html__( 'Hover', 'pricing-grid-slider-for-elementor' ) ] );
        $this->add_control( 'button_hover_color', [
            'label' => esc_html__( 'Text Color', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-button:hover' => 'color: {{VALUE}};' ],
        ] );
        $this->add_control( 'button_hover_bg', [
            'label' => esc_html__( 'Background', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-button:hover' => 'background-color: {{VALUE}};' ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section( 'section_badge_style', [
            'label' => esc_html__( 'Badge & Featured', 'pricing-grid-slider-for-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_control( 'badge_color', [
            'label' => esc_html__( 'Badge Text', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-badge' => 'color: {{VALUE}};' ],
        ] );
        $this->add_control( 'badge_bg', [
            'label' => esc_html__( 'Badge Background', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-badge' => 'background-color: {{VALUE}};' ],
        ] );
        $this->add_control( 'featured_border_color', [
            'label' => esc_html__( 'Featured Border', 'pricing-grid-slider-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .mpp-card.is-featured' => 'border-color: {{VALUE}};' ],
        ] );
        $this->end_controls_section();
    }

    private function get_default_features( $labels ) {
        $features = [];

        foreach ( $labels as $label ) {
            $features[] = [
                'feature_text' => esc_html__( $label, 'pricing-grid-slider-for-elementor' ),
                'feature_icon' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'feature_icon_color' => '',
                'feature_text_color' => '',
            ];
        }

        return $features;
    }

    private function get_default_plans() {
        return [
            [
                'title' => esc_html__( 'Starter', 'pricing-grid-slider-for-elementor' ),
                'subtitle' => esc_html__( 'Perfect for personal projects.', 'pricing-grid-slider-for-elementor' ),
                'currency' => '$',
                'price' => '19',
                'period' => esc_html__( '/ month', 'pricing-grid-slider-for-elementor' ),
                'features_list' => $this->get_default_features( [ '5 projects', 'Basic support', 'Core analytics', 'Community access' ] ),
                'button_text' => esc_html__( 'Start Now', 'pricing-grid-slider-for-elementor' ),
                'button_link' => [ 'url' => '#' ],
                'badge_text' => '',
                'is_featured' => '',
            ],
            [
                'title' => esc_html__( 'Professional', 'pricing-grid-slider-for-elementor' ),
                'subtitle' => esc_html__( 'Best choice for growing teams.', 'pricing-grid-slider-for-elementor' ),
                'currency' => '$',
                'price' => '49',
                'period' => esc_html__( '/ month', 'pricing-grid-slider-for-elementor' ),
                'features_list' => $this->get_default_features( [ 'Unlimited projects', 'Priority support', 'Advanced analytics', 'Custom integrations' ] ),
                'button_text' => esc_html__( 'Choose Pro', 'pricing-grid-slider-for-elementor' ),
                'button_link' => [ 'url' => '#' ],
                'badge_text' => esc_html__( 'Popular', 'pricing-grid-slider-for-elementor' ),
                'is_featured' => 'yes',
            ],
            [
                'title' => esc_html__( 'Enterprise', 'pricing-grid-slider-for-elementor' ),
                'subtitle' => esc_html__( 'For serious scale and support.', 'pricing-grid-slider-for-elementor' ),
                'currency' => '$',
                'price' => '99',
                'period' => esc_html__( '/ month', 'pricing-grid-slider-for-elementor' ),
                'features_list' => $this->get_default_features( [ 'Everything in Pro', 'Dedicated manager', 'SLA support', 'White-label options' ] ),
                'button_text' => esc_html__( 'Contact Sales', 'pricing-grid-slider-for-elementor' ),
                'button_link' => [ 'url' => '#' ],
                'badge_text' => '',
                'is_featured' => '',
            ],
        ];
    }


    private function get_slider_length_value( $settings, $key, $default = 0 ) {
        if ( isset( $settings[ $key ]['size'] ) && '' !== $settings[ $key ]['size'] ) {
            $unit = isset( $settings[ $key ]['unit'] ) && $settings[ $key ]['unit'] ? $settings[ $key ]['unit'] : 'px';
            return $settings[ $key ]['size'] . $unit;
        }

        return $default . 'px';
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $is_slider = 'slider' === $settings['layout_type'];
        $equal_height = 'yes' === $settings['equal_height'] ? ' has-equal-height' : '';
        $hover_lift = isset( $settings['card_hover_transform'] ) && 'yes' === $settings['card_hover_transform'] ? ' has-hover-lift' : '';
        $wrapper_classes = 'mpp-pricing-wrapper mpp-layout-' . esc_attr( $settings['layout_type'] ) . $equal_height . $hover_lift;

        $slider_config = [
            'slidesPerView' => isset( $settings['slides_per_view'] ) ? (int) $settings['slides_per_view'] : 3,
            'slidesPerViewTablet' => isset( $settings['slides_per_view_tablet'] ) ? (int) $settings['slides_per_view_tablet'] : 2,
            'slidesPerViewMobile' => isset( $settings['slides_per_view_mobile'] ) ? (int) $settings['slides_per_view_mobile'] : 1,
            'gap' => $this->get_slider_length_value( $settings, 'gap', 24 ),
            'gapTablet' => $this->get_slider_length_value( $settings, 'gap_tablet', 20 ),
            'gapMobile' => $this->get_slider_length_value( $settings, 'gap_mobile', 16 ),
            'loop' => 'yes' === ( $settings['slider_loop'] ?? '' ),
            'autoplay' => 'yes' === ( $settings['slider_autoplay'] ?? '' ),
            'arrows' => 'yes' === ( $settings['slider_arrows'] ?? '' ),
            'dots' => 'yes' === ( $settings['slider_dots'] ?? '' ),
        ];

        echo '<div class="' . esc_attr( $wrapper_classes ) . '">';

        if ( $is_slider ) {
            echo '<div class="mpp-pricing-slider swiper" data-mpp-slider="' . esc_attr( wp_json_encode( $slider_config ) ) . '">';
            echo '<div class="swiper-wrapper">';
        } else {
            echo '<div class="mpp-pricing-grid">';
        }

        if ( ! empty( $settings['plans'] ) && is_array( $settings['plans'] ) ) {
            foreach ( $settings['plans'] as $index => $plan ) {
                $this->render_plan( $plan, $index, $is_slider );
            }
        }

        echo '</div>';

        if ( $is_slider ) {
            if ( 'yes' === ( $settings['slider_arrows'] ?? '' ) ) {
                echo '<button class="mpp-swiper-button mpp-swiper-prev" type="button" aria-label="' . esc_attr__( 'Previous slide', 'pricing-grid-slider-for-elementor' ) . '"></button>';
                echo '<button class="mpp-swiper-button mpp-swiper-next" type="button" aria-label="' . esc_attr__( 'Next slide', 'pricing-grid-slider-for-elementor' ) . '"></button>';
            }
            if ( 'yes' === ( $settings['slider_dots'] ?? '' ) ) {
                echo '<div class="mpp-swiper-pagination"></div>';
            }
            echo '</div>';
        }

        echo '</div>';
    }

    private function normalize_features( $plan ) {
        if ( ! empty( $plan['features_list'] ) && is_array( $plan['features_list'] ) ) {
            return $plan['features_list'];
        }

        if ( empty( $plan['features'] ) ) {
            return [];
        }

        $features = [];
        foreach ( preg_split( '/\r\n|\r|\n/', $plan['features'] ) as $feature ) {
            $feature = trim( $feature );
            if ( '' === $feature ) {
                continue;
            }
            $features[] = [
                'feature_text' => $feature,
                'feature_icon' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'feature_icon_color' => '',
                'feature_text_color' => '',
            ];
        }

        return $features;
    }

    private function build_inline_style( $styles ) {
        $style = '';

        foreach ( $styles as $property => $value ) {
            if ( '' === $value || null === $value ) {
                continue;
            }
            $style .= sanitize_key( $property ) . ':' . esc_attr( $value ) . ';';
        }

        return $style ? ' style="' . $style . '"' : '';
    }

    private function render_plan( $plan, $index, $is_slider ) {
        $is_featured = ! empty( $plan['is_featured'] ) && 'yes' === $plan['is_featured'];
        $item_class = $is_slider ? 'swiper-slide mpp-pricing-item' : 'mpp-pricing-item';
        $card_class = 'mpp-card' . ( $is_featured ? ' is-featured' : '' );
        $features = $this->normalize_features( $plan );

        echo '<div class="' . esc_attr( $item_class ) . '">';
        echo '<article class="' . esc_attr( $card_class ) . '">';

        if ( ! empty( $plan['badge_text'] ) ) {
            echo '<span class="mpp-badge">' . esc_html( $plan['badge_text'] ) . '</span>';
        }

        if ( ! empty( $plan['title'] ) ) {
            echo '<h3 class="mpp-title">' . esc_html( $plan['title'] ) . '</h3>';
        }

        if ( ! empty( $plan['subtitle'] ) ) {
            echo '<p class="mpp-subtitle">' . esc_html( $plan['subtitle'] ) . '</p>';
        }

        echo '<div class="mpp-price-wrap">';
        if ( ! empty( $plan['currency'] ) ) {
            echo '<span class="mpp-currency">' . esc_html( $plan['currency'] ) . '</span>';
        }
        echo '<span class="mpp-price">' . esc_html( $plan['price'] ?? '' ) . '</span>';
        if ( ! empty( $plan['period'] ) ) {
            echo '<span class="mpp-period">' . esc_html( $plan['period'] ) . '</span>';
        }
        echo '</div>';

        if ( ! empty( $features ) ) {
            echo '<ul class="mpp-features">';
            foreach ( $features as $feature ) {
                $label = isset( $feature['feature_text'] ) ? trim( $feature['feature_text'] ) : '';
                if ( '' === $label ) {
                    continue;
                }

                $icon_style = $this->build_inline_style( [
                    'color' => $feature['feature_icon_color'] ?? '',
                ] );
                $label_style = $this->build_inline_style( [
                    'color' => $feature['feature_text_color'] ?? '',
                ] );

                echo '<li class="mpp-feature">';
                echo '<span class="mpp-feature-icon"' . $icon_style . ' aria-hidden="true">';
                if ( ! empty( $feature['feature_icon']['value'] ) ) {
                    Icons_Manager::render_icon( $feature['feature_icon'], [ 'aria-hidden' => 'true' ] );
                } else {
                    echo '<span class="mpp-feature-fallback">✓</span>';
                }
                echo '</span>';
                echo '<span class="mpp-feature-label"' . $label_style . '>' . esc_html( $label ) . '</span>';
                echo '</li>';
            }
            echo '</ul>';
        }

        if ( ! empty( $plan['button_text'] ) ) {
            $url = ! empty( $plan['button_link']['url'] ) ? $plan['button_link']['url'] : '#';
            $target = ! empty( $plan['button_link']['is_external'] ) ? ' target="_blank"' : '';
            $nofollow = ! empty( $plan['button_link']['nofollow'] ) ? ' rel="nofollow"' : '';
            echo '<a class="mpp-button" href="' . esc_url( $url ) . '"' . $target . $nofollow . '>' . esc_html( $plan['button_text'] ) . '</a>';
        }

        echo '</article>';
        echo '</div>';
    }
}

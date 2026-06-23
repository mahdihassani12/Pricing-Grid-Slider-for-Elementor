<?php
/**
 * Plugin Name: Benyamin Hope Pricing
 * Description: A flexible Elementor pricing plans widget with Grid/Slider modes, RTL support, and deep style controls.
 * Version: 1.0.6
 * Author: Mahdi Hassani
 * Author URI: 
 * Text Domain: mahdi-pricing-plans
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Elementor tested up to: 3.29
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Mahdi_Pricing_Plans_Plugin {
    const VERSION = '1.0.6';
    const MINIMUM_ELEMENTOR_VERSION = '3.5.0';
    const MINIMUM_PHP_VERSION = '7.4';

    private static $instance = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    public function init() {
        load_plugin_textdomain( 'mahdi-pricing-plans', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor' ] );
            return;
        }

        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_category' ] );
        add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_styles' ] );
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
    }

    public function admin_notice_missing_elementor() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        echo '<div class="notice notice-warning is-dismissible"><p>' . esc_html__( 'Benyamin Hope Pricing requires Elementor to be installed and activated.', 'mahdi-pricing-plans' ) . '</p></div>';
    }

    public function admin_notice_minimum_php_version() {
        echo '<div class="notice notice-warning is-dismissible"><p>' . sprintf(
            esc_html__( 'Benyamin Hope Pricing requires PHP %1$s or newer. You are running PHP %2$s.', 'mahdi-pricing-plans' ),
            esc_html( self::MINIMUM_PHP_VERSION ),
            esc_html( PHP_VERSION )
        ) . '</p></div>';
    }

    public function admin_notice_minimum_elementor_version() {
        echo '<div class="notice notice-warning is-dismissible"><p>' . sprintf(
            esc_html__( 'Benyamin Hope Pricing requires Elementor %1$s or newer.', 'mahdi-pricing-plans' ),
            esc_html( self::MINIMUM_ELEMENTOR_VERSION )
        ) . '</p></div>';
    }

    public function register_widget_category( $elements_manager ) {
        $elements_manager->add_category(
            'mahdi-widgets',
            [
                'title' => esc_html__( 'Benyamin Hope Widgets', 'mahdi-pricing-plans' ),
                'icon'  => 'fa fa-plug',
            ]
        );
    }

    public function register_styles() {
        wp_register_style(
            'mahdi-pricing-plans',
            plugins_url( 'assets/css/pricing-plans.css', __FILE__ ),
            [],
            self::VERSION
        );
    }

    public function register_scripts() {
        wp_register_script(
            'mahdi-pricing-plans',
            plugins_url( 'assets/js/pricing-plans.js', __FILE__ ),
            [ 'elementor-frontend' ],
            self::VERSION,
            true
        );
    }

    public function register_widgets( $widgets_manager ) {
        require_once __DIR__ . '/includes/widgets/class-pricing-plans-widget.php';
        $widgets_manager->register( new \Mahdi_Pricing_Plans\Widgets\Pricing_Plans_Widget() );
    }
}

Mahdi_Pricing_Plans_Plugin::instance();

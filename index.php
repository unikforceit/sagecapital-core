<?php
/**
 * Plugin Name: Sagecapital Core
 * Description: A WordPress plugin for core functionality.
 * Version: 1.0
 * Author: Sagecapital
 */

if (!defined('SAGECAPITAL_PLUGIN_DIR')) {
    define('SAGECAPITAL_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

if (!defined('SAGECAPITAL_PLUGIN_URL')) {
    define('SAGECAPITAL_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if (!defined('SAGECAPITAL_PLUGIN_INC')) {
    define('SAGECAPITAL_PLUGIN_INC', dirname(__FILE__) . '/');
}

require_once SAGECAPITAL_PLUGIN_INC . '/inc/functions.php';

class SAGECAPITAL
{

    public function __construct()
    {
        // Add hooks and actions here
        add_action('init', array($this, 'init'));
    }

    public function init()
    {
        // Register Elementor widget
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles_and_scripts'));
        add_action('elementor/widgets/register', array($this, 'register_elementor_widget'));
        add_action('elementor/elements/categories_registered', array($this, 'add_elementor_widget_categories'));
    }

    public function enqueue_styles_and_scripts() {
        // Enqueue your plugin's styles
        wp_enqueue_style('sagecapital-styles', SAGECAPITAL_PLUGIN_URL . 'css/style.css', array(), '1.0.0');

        // Enqueue your plugin's scripts
        wp_enqueue_script('sagecapital-chart', 'https://cdn.jsdelivr.net/npm/chart.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('sagecapital-script', SAGECAPITAL_PLUGIN_URL . 'js/script.js', array('jquery'), '1.0.0', true);
    }

    public function register_elementor_widget()
    {
        if (class_exists('Elementor\Widget_Base')) {
            require_once(SAGECAPITAL_PLUGIN_DIR . 'widget/chart-calculator.php');
            require_once(SAGECAPITAL_PLUGIN_DIR . 'widget/apy7-calculator.php');
            require_once(SAGECAPITAL_PLUGIN_DIR . 'widget/apy9-calculator.php');
            require_once(SAGECAPITAL_PLUGIN_DIR . 'widget/user-meta.php');
        }
    }

    public function add_elementor_widget_categories($elements_manager)
    {
        $elements_manager->add_category(
            'sagecapital',
            [
                'title' => esc_html__( 'Sagecapital', 'sagecapital' ),
                'icon' => 'eicon-code',
            ]
        );

    }

    public function activate()
    {

    }

    public function deactivate()
    {
        // Deactivation code, if needed
    }
}

$SAGECAPITAL = new SAGECAPITAL();

// Activation and deactivation hooks
register_activation_hook(__FILE__, array($SAGECAPITAL, 'activate'));
register_deactivation_hook(__FILE__, array($SAGECAPITAL, 'deactivate'));

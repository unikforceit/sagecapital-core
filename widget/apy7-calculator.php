<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Apy7_Calculator_Widget extends Widget_Base {

    public function get_name() {
        return 'apy7-calculator';
    }

    public function get_title() {
        return __('Apy Calculator Gold', 'sagecapital');
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        // Add widget controls here
        $this->start_controls_section(
            'content',
            [
                'label' => __('Calculator Settings', 'sagecapital'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title', 'textdomain' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
            <div class="apy-cal-page">
                <div class="calculator">
                    <div class="input-group">
                        <label for="investmentAmount7">Investment Amount:</label>
                        <input type="number" id="investmentAmount7" min="10000" max="50000" step="1000" value="10000">
                    </div>

                    <div class="input-group">
                        <label for="apy7">APY:</label>
                        <input type="text" id="apy7" value="7%" disabled>
                    </div>

                    <div class="input-group">
                        <label for="monthTerm7">Terms (Months):</label>
                        <input type="number" id="monthTerm7" min="4" max="100" step="1" value="4">
                    </div>

                    <div class="result">
                        <div class="result-box">
                            <p id="monthlyProfit7">Monthly Payouts: $0.00</p>
                        </div>
                        <div class="result-box">
                            <p id="yearlyProfit7">Total Gained: $0.00</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register(new Apy7_Calculator_Widget());
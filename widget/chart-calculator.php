<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Chart_Calculator_Widget extends Widget_Base {

    public function get_name() {
        return 'chart-calculator';
    }

    public function get_title() {
        return __('Calculator Chart', 'sagecapital');
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
           <div class="chart-cal-home">
               <div id="wrapper">
                   <div class="calculator">
                       <label for="tier">Select Tier:</label>
                       <select id="tier">
                           <option value="0">Select Tier</option>
                           <option value="0.07">Gold</option>
                           <option value="0.09">Platinum</option>
                       </select>
                       <label for="apy">APY:</label>
                       <div id="realTimeAPY"><span id="realTimeAPYValue">0%</span></div>
                       <label for="investmentAmount">Enter Amount:</label>
                       <input type="number" id="investmentAmount" min="10000" max="50000" step="1000" value="10000">

                       <label for="months">Month (Term):</label>
                       <input type="number" id="months" min="4" max="100" value="4">
                   </div>

                   <div class="chart-container">
                       <canvas id="chart"></canvas>
                   </div>
               </div>
           </div>
            <?php
        }
}

Plugin::instance()->widgets_manager->register(new Chart_Calculator_Widget());
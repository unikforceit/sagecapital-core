<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class User_meta_Widget extends Widget_Base {

    public function get_name() {
        return 'user-meta';
    }

    public function get_title() {
        return __('User Meta', 'sagecapital');
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
                'label' => __('User Meta Content', 'sagecapital'),
            ]
        );
        $this->add_control(
            'user_meta',
            [
                'label' => __('Posts', 'ageland'),
                'type' => Controls_Manager::SELECT2,
                'options' => sage_get_subscriber_meta(),
                'multiple' => true,
                'label_block' => true,
            ]
        ); // Post query

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="user-meta-custom">
            <?php echo $settings['user_meta'];?>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register(new User_meta_Widget());
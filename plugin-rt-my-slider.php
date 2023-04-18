<?php
/**
 * Plugin Name: RT My Slider
 */

defined('ABSPATH') || exit;

define( 'RT_SLIDER__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'RT_SLIDER__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

//create DB table
function rt_slider_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'rt_slider_tbl';
    $charset_collate = $wpdb->get_charset_collate();

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            image_name varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
register_activation_hook(__FILE__, 'rt_slider_create_table');


// Load plugin scripts and styles
function rt_slider_enqueue_scripts() {
  wp_enqueue_style('rt-slider-style', plugin_dir_url(__FILE__) . 'assets/css/rt-my-slider-style.css');
  wp_enqueue_script('rt-slider-script', plugin_dir_url(__FILE__) . 'assets/js/rt-my-slider-script.js', array('jquery'), '1.0', true);

  wp_localize_script('rt-slider-script', 'myajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('admin_init', 'rt_slider_enqueue_scripts');

// Register plugin page
function rt_slider_register_menu() {
  add_menu_page('RT My Slider', 'RT My Slider', 'manage_options', 'rt-my-slider', 'rt_slider_page');
}
add_action('admin_menu', 'rt_slider_register_menu');

//Connect plugin page HTML
function rt_slider_page() {
  require_once(RT_SLIDER__PLUGIN_DIR . 'templates/main-page.php' );
}

function rt_slider_handler_callback() {
if (isset($_POST['value'])){

    if ($_POST['value'] === 'slider1') {
        $slider_url = RT_SLIDER__PLUGIN_URL . 'assets/slider-img/slider1.jpg';
    }
    else if ($_POST['value'] === 'slider2') {
        $slider_url = RT_SLIDER__PLUGIN_URL . 'assets/slider-img/slider2.jpg';
    }
    echo $slider_url;
}
	
	wp_die();
};
add_action('wp_ajax_rt_slider', 'rt_slider_handler_callback');
add_action('wp_ajax_nopriv_rt_slider', 'rt_slider_handler_callback');

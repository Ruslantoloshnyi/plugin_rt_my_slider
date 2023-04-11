<?php

/**
 * Plugin Name: RT Get Plugin 
 * Author:      Ruslan Toloshnyi
 * Version:     1.0 
 */

defined('ABSPATH') || exit;


function register_my_page() {
    add_menu_page('RT slider', 'Slider RT', 'manage_options', 'RT_main', 'get_main_page', 'dashicons-controls-play', 80);
}
add_action('admin_menu', 'register_my_page');

function get_main_page() {
    require_once (plugin_dir_path( __FILE__ ) . '/templates/main-page.php');
}

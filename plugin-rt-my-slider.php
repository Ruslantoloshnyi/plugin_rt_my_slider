<?php
/*
Plugin Name: RT my slider
Description: Add sliders to your page.
Version:  1.0
Author: Ruslan Toloshnyi
*/

/*  Copyright 2023  Ruslan Toloshnyi  (email: ruslantoloshnyi@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>

<?php
defined('ABSPATH') || exit;

define('RT_SLIDER__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('RT_SLIDER__PLUGIN_URL', plugin_dir_url(__FILE__));

//Create DB table
function rt_slider_create_table()
{
  global $wpdb;

  $table_name = $wpdb->prefix . 'rt_slider_tbl';

  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    $sql = "CREATE TABLE $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            image_name varchar(255) NOT NULL,
            path varchar(255) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }
}
register_activation_hook(__FILE__, 'rt_slider_create_table');


// Load plugin scripts and styles
function rt_slider_enqueue_scripts()
{
  wp_enqueue_style('rt-slider-style', plugin_dir_url(__FILE__) . 'assets/css/rt-my-slider-style.css');
  wp_enqueue_style('rt-slider1-style', plugin_dir_url(__FILE__) . 'assets/css/rt-slider1-style.css');
  wp_enqueue_style('rt-slider-with-indicators-style', plugin_dir_url(__FILE__) . 'assets/css/rt-slider-with-indicators-style.css');
  wp_enqueue_script('rt-slider-script', plugin_dir_url(__FILE__) . 'assets/js/rt-my-slider-script.js', array('jquery'), '1.0', true);
  wp_enqueue_script('rt-slider1-script', plugin_dir_url(__FILE__) . 'assets/js/rt-slider1-script.js', array('jquery'), '1.0', true);
  wp_enqueue_script('rt-slider-with-indicators-script', plugin_dir_url(__FILE__) . 'assets/js/rt-slider-with-indicators-script.js', array('jquery'), '1.0', true);

  wp_localize_script('rt-slider-script', 'myajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('admin_init', 'rt_slider_enqueue_scripts');

//Register style and scrypt for shortcode
function salcodes_enqueue_scripts()
{  
    wp_register_style('salcodes-with-controls-style', plugin_dir_url(__FILE__) . 'assets/css/rt-slider1-style.css');
    wp_register_style('salcodes-with-indicators-style', plugin_dir_url(__FILE__) . 'assets/css/rt-slider-with-indicators-style.css');
    wp_register_script('salcodes-with-controls-scripts', plugin_dir_url(__FILE__) . 'assets/js/rt-slider1-script.js', array('jquery'), '1.0', true);
    wp_register_script('salcodes-with-indicators-scripts', plugin_dir_url(__FILE__) . 'assets/js/rt-slider-with-indicators-script.js', array('jquery'), '1.0', true);  
}
add_action('wp_enqueue_scripts', 'salcodes_enqueue_scripts');


// Register plugin page
function rt_slider_register_menu()
{
  add_menu_page('RT My Slider', 'RT My Slider', 'manage_options', 'rt-my-slider', 'rt_slider_page', 'dashicons-controls-play');
}
add_action('admin_menu', 'rt_slider_register_menu');

require_once(RT_SLIDER__PLUGIN_DIR . 'templates/sliders-shortcode.php');

//Connect plugin page HTML
function rt_slider_page()
{
  require_once(RT_SLIDER__PLUGIN_DIR . 'templates/main-page.php');
}

//Ajax handler
function rt_slider_handler_callback()
{
  if (isset($_POST['value'])) {

    if ($_POST['value'] === 'slider-with-controls') {
      $slider_url = RT_SLIDER__PLUGIN_URL . 'assets/slider-img/Slider-with-controls.jpg';
    } else if ($_POST['value'] === 'slider-with-indicators') {
      $slider_url = RT_SLIDER__PLUGIN_URL . 'assets/slider-img/Slider-with-indicators.jpg';
    }
    echo $slider_url;
  }

  if (isset($_POST['image_url'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'rt_slider_tbl';
    $image_url = $_POST['image_url'];
    $slide_row = $wpdb->get_row("SELECT * FROM $table_name WHERE `path` = '$image_url'");

    if (!$slide_row) {
      wp_die('Slide id not found');
    }

    $result = $wpdb->delete($table_name, ['id' => $slide_row->id]);
    if (!$result) {
      wp_die('Failed to delete slide from database');
    }

    $delete_dir_image = unlink(RT_SLIDER__PLUGIN_DIR . 'uploads/' . $slide_row->image_name);
    if (!$delete_dir_image) {
      wp_die('Failed to delete slide image from server');
    }

    echo 'Slide image deleted successfully';
  }

  wp_die();
};
add_action('wp_ajax_rt_slider', 'rt_slider_handler_callback');
add_action('wp_ajax_nopriv_rt_slider', 'rt_slider_handler_callback');


// add users image and remove buttons
function rt_slider_review_image()
{
?>
  <div class="review-image">
    <?php
    global $wpdb;
    $table_name = $wpdb->prefix . 'rt_slider_tbl';
    $slides = $wpdb->get_results("SELECT * FROM $table_name");
    foreach ($slides as $result) : ?>
      <div class="review-block">
        <button class="btn-remove-img">remove</button>
        <img src="<?php echo $result->path; ?>" height="100px" width="150px" alt="">
      </div>
    <?php endforeach; ?>
  </div>
<?php
}

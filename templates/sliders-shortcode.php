<?php

function rt_slider_with_controls_shortcode() {
    
    //Load scripts and styles
    wp_enqueue_style('salcodes-with-controls-style');   
    wp_enqueue_script('salcodes-with-controls-scripts');    
    ob_start();

    // Get images from database
    global $wpdb;
    $table_name = $wpdb->prefix . 'rt_slider_tbl';
    $slides = $wpdb->get_results("SELECT * FROM $table_name");

    // Output slider HTML   
?>
    <div class="slider-with-controls">
        <div class="slider">
            <div class="slider-list">
                <div class="slider-track">
                    <?php foreach ($slides as $slide) : ?>
                        <div class="slide"><img src="<?php echo $slide->path; ?>" alt=""></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="slider-arrows">
                <button type="button" class="prev">&lt;</button>
                <button type="button" class="next">&gt;</button>
            </div>
        </div>
    </div>
<?php

    return ob_get_clean();
}
add_shortcode('rt_slider_with_controls', 'rt_slider_with_controls_shortcode');

function rt_slider_with_indicators_shortcode() {
    
    //Load scripts and styles
    wp_enqueue_style('salcodes-with-indicators-style');
    wp_enqueue_script('salcodes-with-indicators-scripts');
    ob_start();

    // Get images from database
    global $wpdb;
    $table_name = $wpdb->prefix . 'rt_slider_tbl';
    $slides = $wpdb->get_results("SELECT * FROM $table_name");
?>

    <div class="slider-with-indicators">
        <div class="slider2">
            <div class="slider2-list">
                <div class="slider2-track">
                    <?php foreach ($slides as $slide) : ?>
                        <div class="slide2"><img src="<?php echo $slide->path; ?>" alt=""></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="slider2-arrows">
                <button type="button" class="prev2">&lt;</button>
                <button type="button" class="next2">&gt;</button>
            </div>
            <div class="slider2-dots">                
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('rt_slider_with_indicators', 'rt_slider_with_indicators_shortcode');
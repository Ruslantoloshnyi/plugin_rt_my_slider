<?php

function rt_slider_with_controls_shortcode() {
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

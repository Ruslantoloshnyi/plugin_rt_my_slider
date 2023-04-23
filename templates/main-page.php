<div class="wrap">
    <h1>RT My Slider</h1>
    <div id="rt-slider-container"></div>
</div>

<form id="upload-form" method="post" enctype="multipart/form-data">
    <label for="file-upload">Select file to upload:</label>
    <input type="file" id="file-upload" name="file">
    <button type="submit" name="submit">Upload</button>
</form>

<?php rt_slider_review_image(); ?>

<?php require_once(RT_SLIDER__PLUGIN_DIR . 'templates/uploads.php'); ?>

<label for="slider-select">check slider</label>
<select name="slider-select" id="slider-select">
    <option value="slider-with-controls">slider-with-controls</option>
    <option value="slider2">slider2</option>
</select>

<div class="slider-image">
    <img id="" src="<?php echo RT_SLIDER__PLUGIN_URL . 'assets/slider-img/Slider-with-controls.jpg'; ?>" alt="">
</div>

<?php echo do_shortcode('[rt_slider_with_controls]'); ?>







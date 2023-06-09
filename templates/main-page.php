<section class="rt-slider-section">

    <div class="rt-slider-container">

        <div class="rt-slider-heading">
            <h1>RT My Slider</h1>
        </div>

        <!-- Upload form -->
        <div class="rt-slider-form">
            <form id="upload-form" method="post" enctype="multipart/form-data">
                <label for="file-upload">Select file to upload:</label>
                <input type="file" id="file-upload" name="file">
                <button type="submit" name="submit">Upload</button>
            </form>
        </div> <!-- Upload form end -->

        <!-- User image -->
        <div class="rt-slider-review-image">
            <div class="your">Your images :</div>
            <?php rt_slider_review_image(); ?>
        </div> <!-- User image end -->

        <?php require_once(RT_SLIDER__PLUGIN_DIR . 'templates/uploads.php'); ?>

        <!-- Select slider section -->
        <label class="rt-check-slider-label" for="slider-select">Check slider</label>
        <select name="slider-select" id="slider-select">
            <option value="none">none</option>
            <option value="slider-with-controls">slider-with-controls</option>
            <option value="slider-with-indicators">slider-with-indicators</option>
        </select> <!-- Select slider section end -->

        <div class="your">Exemple :</div>

        <div class="slider-image" style="display: none">
            <img id="" src="<?php echo RT_SLIDER__PLUGIN_URL . 'assets/slider-img/Slider-with-controls.jpg'; ?>" alt="">
        </div>

        <div class="rt-slider-show">
            <div class="your">Your slider :</div>
            <?php echo do_shortcode('[rt_slider_with_controls]'); ?>
            <?php echo do_shortcode('[rt_slider_with_indicators]'); ?>
        </div>

        <div class="rt-slider-shortcode">
            <div class="your">Your shortcode :</div>
            <div class="shortcode-review"></div>
            <div class="shortcode-instruction">
                <p><b>Use a function "do_shortcode" to display your slider on the page</b></p>
                <p>do_shortcode( string $content, bool $ignore_html = false ): string</p>
                <p>$content - Content to search for shortcodes (your shortcode).</p>
                <p>$ignore_html - When true, shortcodes inside HTML elements will be skipped.
                    Default: false</p>
            </div>
        </div>

    </div>

</section>
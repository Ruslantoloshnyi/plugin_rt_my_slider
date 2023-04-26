"use strict"

const slider_select = document.querySelector('#slider-select');
const slider_image = document.querySelector('.slider-image img');
const btn_remove = document.querySelectorAll('.btn-remove-img');
const slide_uploads_img = document.querySelectorAll('.review-block img');
const review_blocks = document.querySelectorAll('.review-block');
const slider_with_controls = document.querySelector('.rt-slider-with-controls');
const slider_with_indicators = document.querySelector('.slider-with-indicators');
const slider_image_div = document.querySelector('.slider-image');
const shortcode = document.querySelector('.shortcode-review');

slider_with_controls.style.visibility = 'hidden';
slider_with_indicators.style.visibility = 'hidden';

function rt_slider_url_change() {
    const formData = new FormData();
    formData.append('action', 'rt_slider');
    formData.append('value', slider_select.value);

    fetch(myajax['ajaxurl'], {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(slider_url => {
            slider_image.src = slider_url;
        })
        .catch(error => console.error(error));
};

function rt_slider_remove_image() {

    for (let i = 0; i < review_blocks.length; i++) {
        btn_remove[i].addEventListener('click', function () {

            const formData = new FormData();
            formData.append('action', 'rt_slider');
            formData.append('image_url', slide_uploads_img[i].src);

            fetch(myajax['ajaxurl'], {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(text => {
                    console.log(text);
                })
                .catch(error => console.error(error));

            btn_remove[i].parentNode.remove();

        })
    }

};



slider_select.addEventListener('change', function () {
    rt_slider_url_change();

    //Check present slider
    if (slider_select.value == 'none') {
        slider_with_controls.style.display = 'none';
        slider_with_indicators.style.display = 'none';
        slider_image_div.style.visibility = 'hidden';        
    }
    if (slider_select.value == 'slider-with-controls') {
        slider_with_controls.style.visibility = 'visible';
        slider_with_controls.style.display = 'block';
        slider_with_indicators.style.display = 'none';
        slider_image_div.style.display = 'block';
        shortcode.textContent = '[rt_slider_with_controls]';
       }
    if (slider_select.value == 'slider-with-indicators') {
        slider_with_controls.style.display = 'none';
        slider_with_indicators.style.visibility = 'visible';
        slider_with_indicators.style.display = 'block';
        slider_image_div.style.display = 'block';
        shortcode.textContent = '[rt_slider_with_indicators]';
    }
});

rt_slider_remove_image();






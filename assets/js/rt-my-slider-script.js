"use strict"

const slider_select = document.querySelector('#slider-select');
const slider_image = document.querySelector('.slider-image img');
const btn_remove = document.querySelectorAll('.btn-remove-img');
const slide_uploads_img = document.querySelectorAll('.slide img');
const review_blocks = document.querySelectorAll('.review-block');

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
});

rt_slider_remove_image();






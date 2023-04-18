"use strict"

const slider_select = document.querySelector('#slider-select');
const slider_image = document.querySelector('.slider-image img');

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

slider_select.addEventListener('change', function() {
    rt_slider_url_change();
});


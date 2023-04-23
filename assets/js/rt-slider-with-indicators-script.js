"use strict"

const slider2 = document.querySelector('.slider2');
const slider2_list = document.querySelector('.slider2-list');
const slider2_track = document.querySelector('.slider2-track');
const slides2 = document.querySelectorAll('.slide2');
const btnPrev2 = document.querySelector('.prev2');
const btnNext2 = document.querySelector('.next2');
const dots = document.querySelectorAll('.dot');

// Cloning first slide and appending it to the end of the track
const firstSlideClone2 = slider2_track.firstElementChild.cloneNode(true);
slider2_track.appendChild(firstSlideClone2);

// Calculating slide width, quantity
let slideWidth2 = slider2.offsetWidth;
let slideQuantity2 = slider2_track.children.length;
let slideIndex2 = 1;

// Function update active dot
function setActiveDot() {
    dots.forEach((dot, index) => {
        dot.classList.remove('active');
        if (index === slideIndex2 - 1) {
            dot.classList.add('active');
        }
    });
};

// Listening for transitionend event to handle infinite scrolling and update active dot
slider2_track.addEventListener('transitionend', function () {
    if (slideIndex2 === 0) {
        slider2_track.style.transition = 'none';
        slideIndex2 = slideQuantity2 - 1;
        slider2_track.style.transform = `translateX(-${slideWidth2 * slideIndex2}px)`;
    } else if (slideIndex2 === slideQuantity2 - 1) {
        slider2_track.style.transition = 'none';
        slideIndex2 = 0;
        slider2_track.style.transform = `translateX(-${slideWidth2 * slideIndex2}px)`;
    }
    setActiveDot();
});

// Adding click event listener to dots to move to corresponding slide
dots.forEach((dot, index) => {
    dot.addEventListener('click', function () {
        slideIndex2 = index + 1;
        setActiveDot();
        slider2_track.style.transition = 'transform 0.6s ease-in-out';
        slider2_track.style.transform = `translateX(-${slideWidth2 * slideIndex2}px)`;
    });
});

// Adding click event listener to previous button
btnPrev2.addEventListener('click', function () {
    slideIndex2--;
    if (slideIndex2 < 0) {
        slideIndex2 = slideQuantity2 - 1;
    } else {
        slider2_track.style.transition = 'transform 0.6s ease-in-out';
        slider2_track.style.transform = `translateX(-${slideWidth2 * slideIndex2}px)`;
    }
    setActiveDot();
});

// Adding click event listener to next button
btnNext2.addEventListener('click', function () {
    slideIndex2++;
    if (slideIndex2 > slideQuantity2 - 1) {
        slideIndex2 = 0;
    } else {
        slider2_track.style.transition = 'transform 0.6s ease-in-out';
        slider2_track.style.transform = `translateX(-${slideWidth2 * slideIndex2}px)`;
    }
    setActiveDot();
});

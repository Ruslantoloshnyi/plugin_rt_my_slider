"use strict"

// Selecting DOM elements
const slider = document.querySelector('.slider');
const slider_list = document.querySelector('.slider-list');
const slider_track = document.querySelector('.slider-track');
const slide = document.querySelectorAll('.slide');
const btnPrev = document.querySelector('.prev');
const btnNext = document.querySelector('.next');

// Cloning first slide and appending it to the end of the track
const firstSlideClone = slider_track.firstElementChild.cloneNode(true);
slider_track.appendChild(firstSlideClone);

// Calculating slide width, quantity and initial index
let slideWidth = slider.offsetWidth;
let slideQuantity = slider_track.children.length;
let slideIndex = 1;

// Listening for transitionend event to handle infinite scrolling
slider_track.addEventListener('transitionend', function () {
  if (slideIndex === 0) {
    slider_track.style.transition = 'none';
    slideIndex = slideQuantity - 1;
    slider_track.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
  } else if (slideIndex === slideQuantity - 1) {
    slider_track.style.transition = 'none';
    slideIndex = 0;
    slider_track.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
  }
});

// Adding click event listener to previous button
btnPrev.addEventListener('click', function () {
  slideIndex--;
  if (slideIndex < 0) {
    slideIndex = slideQuantity - 1;
  } else {
    slider_track.style.transition = 'transform 0.6s ease-in-out';
    slider_track.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
  }
});

// Adding click event listener to next button
btnNext.addEventListener('click', function () {
  slideIndex++;
  if (slideIndex > slideQuantity - 1) {
    slideIndex = 0;
  } else {
    slider_track.style.transition = 'transform 0.6s ease-in-out';
    slider_track.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
  }
});


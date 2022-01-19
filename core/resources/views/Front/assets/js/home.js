"use strict";

$(function () {
    /****  Navbar on scroll ****/
    let NavBar = $("#appNavbar")
    window.onscroll = function () {
        if (window.scrollY >= 72) {
            NavBar.removeClass(" inverse transparent")
        } else {
            NavBar.addClass(" inverse transparent")
        }
    }
    /****  Home page slider settings ****/
    let swiper = new Swiper('.swiper-container.two', {
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        loop: true,
        centeredSlides: true,
        allowTouchMove: false,
        slidesPerView: 2,
        slideShadows: false,
        effect: 'coverflow',
        breakpoints: {
            300: {
                loop: true,
                slidesPerView: 1,
                coverflow: {
                    rotate: 0,
                    stretch: 600,
                    depth: 150,
                    modifier: 1.5,
                    slideShadows: false,
                },
            },
            769: {
                loop: true,
                slidesPerView: 1,
                coverflow: {
                    rotate: 0,
                    stretch: 600,
                    depth: 150,
                    modifier: 1.5,
                    slideShadows: false,
                },
            },
            1024: {
                loop: true,
                slidesPerView: 2,
                spaceBetween: 0,
                coverflow: {
                    rotate: 0,
                    stretch: 600,
                    depth: 150,
                    modifier: 1.5,
                    slideShadows: false,
                },
            }
        }
    });
});





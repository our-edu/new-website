
var swiper = new Swiper( '.swiper-container.two', {
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    loop: true,
    centeredSlides: true,
    allowTouchMove: false,
    slidesPerView: 2,
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
                slideShadows : false,
            },
        },
        769: {
            loop: true,
            slidesPerView: 2,
            coverflow: {
                rotate: 0,
                stretch: 600,
                depth: 150,
                modifier: 1.5,
                slideShadows : false,
            },
        },
        1024: {
            loop: true,
            slidesPerView: 2,
            coverflow: {
                rotate: 0,
                stretch: 600,
                depth: 150,
                modifier: 1.5,
                slideShadows : false,
            },
        }
    }
} );

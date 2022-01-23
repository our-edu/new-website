"use strict";

$(function () {
  'use strict';

  console.log("DOMContentLoaded");
  /****  Fanci box settings ****/

  Fancybox.bind('[data-fancybox="gallery"]', {
    caption: function caption(fancybox, carousel, slide) {
      return slide.index + 1 + " / " + carousel.slides.length + " <br />" + slide.caption;
    }
  });
  /****  Contact us form valiadation ****/
  // Fetch all the forms we want to apply custom Bootstrap validation styles to

  var forms = document.querySelectorAll('.needs-validation'); // Loop over them and prevent submission

  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      form.classList.add('was-validated');
    }, false);
  });
  /****  Books slider settings ****/

  var booksSliderWrapper = new Swiper(".booksSliderWrapper", {
    slidesPerView: 3,
    spaceBetween: 30,
    freeMode: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    breakpoints: {
      300: {
        loop: true,
        slidesPerView: 1
      },
      900: {
        loop: true,
        slidesPerView: 2,
        spaceBetween: 50
      },
      960: {
        loop: true,
        slidesPerView: 3
      }
    }
  });
  /****  Articles slider settings ****/

  var myArticleSwiper = new Swiper(".myArticleSwiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    navigation: {
      nextEl: ".next",
      prevEl: ".prev"
    }
  });
});
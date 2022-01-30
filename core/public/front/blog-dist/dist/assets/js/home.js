"use strict";

$(function () {
  /****  Navbar on scroll ****/
  var NavBar = $("#appNavbar");

  window.onscroll = function () {
    if (window.scrollY >= 72) {
      NavBar.removeClass(" inverse transparent");
    } else {
      NavBar.addClass(" inverse transparent");
    }
  };
  /****  Home page slider settings ****/


  var swiper = new Swiper('.swiper-container.two', {
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    loop: true,
    centeredSlides: true,
    allowTouchMove: true,
    slidesPerView: 2,
    slideShadows: false,
    autoplay: true,
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
          slideShadows: false
        }
      },
      769: {
        loop: true,
        slidesPerView: 1,
        coverflow: {
          rotate: 0,
          stretch: 600,
          depth: 150,
          modifier: 1.5,
          slideShadows: false
        }
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
          slideShadows: false
        }
      }
    }
  });

  function appendCss() {
    console.log('appendCss to twitter iframe');
    var head = $("#twitter-widget-0").contents().find("head");
    var css = "<style> \n                .timeline-Widget{\n                    background-color: transparent !important;\n                }\n                .timeline-TweetList-tweet{\n                border: 1px solid #B1B1B1 !important;\n                margin-bottom: 1rem !important;\n                border-radius:5px;\n                background: #FFF;\n\n              }</style>";
    $(head).append(css);
  }

  function waitForElement(querySelector, timeout) {
    return new Promise(function (resolve, reject) {
      var timer = false;
      if (document.querySelectorAll(querySelector).length) return resolve();
      var observer = new MutationObserver(function () {
        if (document.querySelectorAll(querySelector).length) {
          observer.disconnect();
          if (timer !== false) clearTimeout(timer);
          return resolve();
        }
      });
      observer.observe(document.body, {
        childList: true,
        subtree: true
      });
      if (timeout) timer = setTimeout(function () {
        observer.disconnect();
        reject();
      }, timeout);
    });
  }

  waitForElement("#twitter-widget-0", 3000).then(function () {
    appendCss();
  }).catch(function () {
    console.log("element did not load in 3 seconds");
  });
});
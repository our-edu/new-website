"use strict";

$(function () {
  console.log("DOMContentLoaded");
  /**** Page Loader ****/

  $(".loader").fadeOut(1000);
  /****  Setting nav bar active class ****/

  var pathname = window.location.pathname;
  $('#appNavbar .navbar-nav').find('li.activeLink').removeClass('activeLink');
  $('.navbar-nav > li > a[href="' + pathname + '"]').parent().addClass('activeLink');
  /****  AOS Settings ****/

  AOS.init({
    offset: 200,
    duration: 600,
    easing: 'ease-in-sine',
    delay: 100
  });
});
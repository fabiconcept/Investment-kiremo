"use strict";

/*
* Kohost v1.0.0 (https://themeforest.net/user/themetags)
* Copyright 2020 Themetags
* Licensed under ThemeForest License
*/
// TABLE OF CONTENTS
//  1. preloader
//  2. page scrolling feature - requires jQuery Easing plugin
//  3. fixed navbar
//  4. back to top
//  5. counter up js
//  6. tooltip
//  7. our clients logo carousel
//  8. magnify popup video
// 9. client-testimonial one item carousel
// 10. client-testimonial two
// 11. monthly and yearly pricing switch
// 12. coming soon count
// 13. contact form
// 14. custom vps hosting plan js
jQuery(function ($) {
  'use strict'; // 1. preloader

  $(window).ready(function () {
    $('#preloader').delay(200).fadeOut('fade');
  }); // 2. mega menu js

  $('.js-mega-menu').HSMegaMenu({
    event: 'hover',
    pageContainer: $('.container'),
    breakpoint: 767.98,
    hideTimeOut: 0
  }); // Off Canvas Menu Open & Close

  $('#offCanvas').on('click', function () {
    $('.nav-offcanvas').addClass('open');
    $('.offcanvas-overlay').addClass('on');
  });
  $('#offCanvasClose, .offcanvas-overlay').on('click', function () {
    $('.nav-offcanvas').removeClass('open');
    $('.offcanvas-overlay').removeClass('on');
  }); // 3. fixed navbar

  $(window).on('scroll', function () {
    // checks if window is scrolled more than 500px, adds/removes solid class
    if ($(this).scrollTop() > 0) {
      $('.main-header-menu-wrap').addClass('affix');
      $('.scroll-to-target').addClass('open');
    } else {
      $('.main-header-menu-wrap').removeClass('affix');
      $('.scroll-to-target').removeClass('open');
    } // checks if window is scrolled more than 500px, adds/removes top to target class


    if ($(this).scrollTop() > 500) {
      $('.scroll-to-target').addClass('open');
    } else {
      $('.scroll-to-target').removeClass('open');
    }
  }); // 4. back to top

  if ($('.scroll-to-target').length) {
    $(".scroll-to-target").on('click', function () {
      var target = $(this).attr('data-target'); // animate

      $('html, body').animate({
        scrollTop: $(target).offset().top
      }, 500);
    });
  } // 5. counter up js


  $('.count-number').rCounter(); // 6. tooltip

  $('.custom-map-location li span').tooltip('show');
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  }); // 7. our clients logo carousel

  $('.clients-carousel').owlCarousel({
    autoplay: true,
    loop: true,
    margin: 15,
    dots: false,
    slideTransition: 'linear',
    autoplayTimeout: 4500,
    autoplayHoverPause: true,
    autoplaySpeed: 4500,
    responsive: {
      0: {
        items: 2
      },
      500: {
        items: 3
      },
      600: {
        items: 4
      },
      800: {
        items: 5
      },
      1200: {
        items: 6
      }
    }
  }); // 8. magnify popup video

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  }); // 9. client-testimonial one item carousel

  $('.client-testimonial-1').owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    responsiveClass: true,
    autoplay: true,
    autoplayHoverPause: true,
    lazyLoad: true,
    responsive: {
      0: {
        items: 1
      },
      500: {
        items: 2
      },
      600: {
        items: 2
      },
      800: {
        items: 3
      },
      1200: {
        items: 3
      }
    }
  }); // 10. client-testimonial one item carousel

  $('.client-testimonial-2').owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    responsiveClass: true,
    autoplay: true,
    autoplayHoverPause: true,
    lazyLoad: true,
    responsive: {
      0: {
        items: 1
      },
      500: {
        items: 1
      },
      600: {
        items: 1
      },
      800: {
        items: 2
      },
      1200: {
        items: 2
      }
    }
  }); // 11. monthly and yearly pricing switch

  $("#js-contcheckbox").change(function () {
    if (this.checked) {
      $('.monthly-price').css('display', 'none');
      $('.yearly-price').css('display', 'block');
      $('.afterinput').addClass('text-success');
      $('.beforeinput').removeClass('text-success');
    } else {
      $('.monthly-price').css('display', 'block');
      $('.yearly-price').css('display', 'none');
      $('.afterinput').removeClass('text-success');
      $('.beforeinput').addClass('text-success');
    }
  }); // 12. coming soon count

  $('#clock').countdown('2025/01/30', function (event) {
    $(this).html(event.strftime('' + '<div class="row">' + '<div class="col">' + '<h2 class="mb-0">%-D</h2>' + '<h5 class="mb-0">Day%!d</h5>' + '</div>' + '<div class="col">' + '<h2 class="mb-0">%H</h2>' + '<h5 class="mb-0">Hours</h5>' + '</div>' + '<div class="col">' + '<h2 class="mb-0">%M</h2>' + '<h5 class="mb-0">Minutes</h5>' + '</div>' + '<div class="col">' + '<h2 class="mb-0">%S</h2>' + '<h5 class="mb-0">Seconds</h5>' + '</div>' + '</div>'));
  }); // 13. contact form

  if ($("#contactForm").length) {
    $("#contactForm").validator().on("submit", function (event) {
      if (event.isDefaultPrevented()) {
        // handle the invalid form...
        submitMSG(false, '#contact');
      } else {
        // everything looks good!
        event.preventDefault();
        submitContactForm();
      }
    });
  }

  function submitContactForm() {
    // Initiate Variables With Form Content
    var name = $('#contactForm input[name="name"]').val();
    var email = $('#contactForm input[name="email"]').val();
    var message = $('#contactForm textarea[name="message"]').val();

    if (name && email && message) {
      $.ajax({
        type: "POST",
        url: "libs/contact-form-process.php",
        data: "name=" + name + "&email=" + email + "&message=" + message,
        success: function success(text) {
          if (text == "success") {
            formSuccess();
          } else {
            submitMSG(false, '#contact');
          }
        }
      });
    } else {
      submitMSG(false, '#contact');
    }
  }

  function formSuccess() {
    $("#contactForm")[0].reset();
    submitMSG(true, '#contact');
  }

  function submitMSG(valid, parentSelector) {
    if (valid) {
      $(parentSelector + " .message-box").removeClass('d-none').addClass('d-block ');
      $(parentSelector + " .message-box div").removeClass('alert-danger').addClass('alert-success').text('Form submitted successfully');
    } else {
      $(parentSelector + " .message-box").removeClass('d-none').addClass('d-block ');
      $(parentSelector + " .message-box div").removeClass('alert-success').addClass('alert-danger').text('Found error in the form. Please check again.');
    }
  } // 14. custom vps hosting plan js
  //**************************** Need to change ********************
  // Change according to your plans
  //****************************************************************
  // vpsPlan      = VPS plan or package number
  // vpsCore      = VPS Core value from your plan
  // vpsMemory    = VPS Memory from your plan
  // vpsStorage   = VPS Storage value from your plan
  // vpsBandwidth = VPS bandwidth value from your plan
  // vpsPrice     = VPS price from your plan
  // vpsWHmcsUrl  = VPS plan url. Check from your WHMCS panel
  //****************************************************************


  var vpsPriceInfo = [{
    "vpsPlan": 1,
    "vpsCore": 1,
    "vpsMemory": 2,
    "vpsStorage": 10,
    "vpsBandwidth": 1000,
    "vpsPrice": 20,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=12"
  }, {
    "vpsPlan": 2,
    "vpsCore": 2,
    "vpsMemory": 4,
    "vpsStorage": 20,
    "vpsBandwidth": 2000,
    "vpsPrice": 40,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=13"
  }, {
    "vpsPlan": 3,
    "vpsCore": 3,
    "vpsMemory": 6,
    "vpsStorage": 30,
    "vpsBandwidth": 3000,
    "vpsPrice": 60,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=14"
  }, {
    "vpsPlan": 4,
    "vpsCore": 4,
    "vpsMemory": 8,
    "vpsStorage": 40,
    "vpsBandwidth": 4000,
    "vpsPrice": 80,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=13"
  }, {
    "vpsPlan": 5,
    "vpsCore": 5,
    "vpsMemory": 10,
    "vpsStorage": 50,
    "vpsBandwidth": 5000,
    "vpsPrice": 100,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=12"
  }, {
    "vpsPlan": 6,
    "vpsCore": 6,
    "vpsMemory": 12,
    "vpsStorage": 60,
    "vpsBandwidth": 6000,
    "vpsPrice": 120,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=13"
  }, {
    "vpsPlan": 7,
    "vpsCore": 7,
    "vpsMemory": 14,
    "vpsStorage": 70,
    "vpsBandwidth": 7000,
    "vpsPrice": 140,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=14"
  }, {
    "vpsPlan": 8,
    "vpsCore": 8,
    "vpsMemory": 16,
    "vpsStorage": 80,
    "vpsBandwidth": 8000,
    "vpsPrice": 160,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=12"
  }, {
    "vpsPlan": 9,
    "vpsCore": 9,
    "vpsMemory": 18,
    "vpsStorage": 90,
    "vpsBandwidth": 9000,
    "vpsPrice": 180,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=13"
  }, {
    "vpsPlan": 10,
    "vpsCore": 10,
    "vpsMemory": 20,
    "vpsStorage": 100,
    "vpsBandwidth": 10000,
    "vpsPrice": 200,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=14"
  }, {
    "vpsPlan": 11,
    "vpsCore": 11,
    "vpsMemory": 22,
    "vpsStorage": 110,
    "vpsBandwidth": 11000,
    "vpsPrice": 220,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=12"
  }, {
    "vpsPlan": 12,
    "vpsCore": 12,
    "vpsMemory": 24,
    "vpsStorage": 120,
    "vpsBandwidth": 12000,
    "vpsPrice": 240,
    "vpsWHmcsUrl": "https://themetags.net/whmcs/cart.php?a=add&pid=13"
  }];
  var cPlan = $('#c-plan');

  if (cPlan.length) {
    cPlan.slider({
      tooltip: 'always'
    });
    cPlan.on("slide", function (e) {
      $.each(vpsPriceInfo, function (index, vpsObj) {
        if (vpsObj.vpsPlan == e.value) {
          setVpsValue(vpsObj);
        }
      });
    });
    initSlider();
  }

  function initSlider() {
    cPlan.value = cPlan.data("slider-value");
    var defaultVpsCore = parseInt(cPlan.value);
    $.each(vpsPriceInfo, function (index, vpsObj) {
      // defaultVpsCore is default valeu to show. For my demo, I have set 6 from HTML.
      // vps-hosting.html: <input id="c-plan" type="text" data-slider-min="1" data-slider-max="12" data-slider-step="1" data-slider-value="6" data-currency="$" data-unit="GB">. 
      // You need to change accourting to your need.
      if (vpsObj.vpsPlan == defaultVpsCore) {
        $('.slider .tooltip', '#custom-plan').append('<div class="tooltip-up"></div>');
        $('.slider .tooltip-inner', '#custom-plan').attr("data-unit", cPlan.data("unit"));
        $('.slider .tooltip-up', '#custom-plan').attr("data-currency", cPlan.data("currency"));
        setVpsValue(vpsObj);
      }
    });
  }

  function setVpsValue(vpsObj) {
    $('.slider .tooltip-up', '#custom-plan').text(vpsObj.vpsPrice);
    $('.vpsPrice', '#custom-plan').text(cPlan.data("currency") + vpsObj.vpsPrice);
    $('.vpsCore span', '#custom-plan').text(vpsObj.vpsCore);
    $('.vpsMemory span', '#custom-plan').text(vpsObj.vpsMemory);
    $('.vpsStorage span', '#custom-plan').text(vpsObj.vpsStorage);
    $('.vpsBandwidth span', '#custom-plan').text(vpsObj.vpsBandwidth);
    $('.vpsWHmcsUrl', '#custom-plan').attr("href", vpsObj.vpsWHmcsUrl);
  } // 16. hero slider one


  $('.hero-slider-one').owlCarousel({
    loop: true,
    autoplay: true,
    dots: true,
    margin: 0,
    autoplayHoverPause: true,
    items: 1,
    smartSpeed: 1000,
    animateOut: "slideOutLeft",
    animateIn: "slideInRight"
  });
}); // JQuery end
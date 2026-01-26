(function ($) {
  /*
        1. Data Background Function
        2. Scroll top button
        3. Offcanvus toggle
        4. Theme Slider Functions
        5. Nice Select
        6. Mobile Menu
        7. Wow Js
        8. Article Hover
        9. Offcanvus
        10. Progressbar
        11. Preloader
        12. Header Sticky
        13. Counter Up
        14. Case Study Hover Function
        15. Magnific Popup
        16. Canvus Menu Toggle
        17. Canvus Menu
    */

  //1. Data Background Set
  $("[data-background]").each(function () {
    $(this).css(
      "background-image",
      "url(" + $(this).attr("data-background") + ")"
    );
  });

  $(".counterr").counterUp({
    delay: 10,
    time: 1000,
  });

  //12. header sticky
  $(window).on("scroll", function () {
    var scrollbarPosition = $(this).scrollTop();

    if (scrollbarPosition > 150) {
      $(".header-sticky").addClass("sticky-on");
    } else {
      $(".header-sticky").removeClass("sticky-on");
    }
  });

  //2. Scroll top button
  $(window).on("scroll", function () {
    var scrollBar = $(this).scrollTop();
    if (scrollBar > 150) {
      $(".scroll-top-btn").fadeIn();
    } else {
      $(".scroll-top-btn").fadeOut();
    }
  });
  $(".scroll-top-btn").on("click", function () {
    $("body,html").animate({
      scrollTop: 0,
    });
  });

  //3. Offcanvus toggle
  $(".offcanvus-toggle").on("click", function () {
    $(".offcanvus-box").addClass("active");
  });

  $(".offcanvus-close").on("click", function () {
    $(".offcanvus-box").removeClass("active");
  });

  $(document).on("mouseup", function (e) {
    var offCanvusMenu = $(".offcanvus-box");

    if (
      !offCanvusMenu.is(e.target) &&
      offCanvusMenu.has(e.target).length === 0
    ) {
      $(".offcanvus-box").removeClass("active");
    }
  });

  //4. Theme Slider Functions
  $(".feedback-sliderr").slick({
    slidesToShow: 3,
    autoplay: true,
    speed: 700,
    infinity: true,
    padding: 20,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  $(".gateways-sliderr").slick({
    slidesToShow: 6,
    autoplay: true,
    speed: 500,
    infinity: true,
    padding: 20,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 425,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  //feedback slider 2
  $(".cr2-feedback-slider").slick({
    slidesToShow: 4,
    vertical: true,
    arrows: false,
    autoplay: true,
    speed: 700,
    verticalSwiping: true,
    centerMode: true,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          vertical: false,
          verticalSwiping: false,
          slidesToShow: 2,
          centerMode: false,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 1,
          vertical: false,
          verticalSwiping: false,
          centerMode: false,
        },
      },
    ],
  });
  //hm4 feedback slider
  $(".hm4-feedback-slider").slick({
    slidesToShow: 2,
    prevArrow:
      '<button class="prev-btn"><svg width="48" height="39" viewBox="0 0 48 39" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.9961 1.1875L1.06641 19.2227C0.75 19.5391 0.75 20.0664 1.06641 20.3828L18.9961 38.418C19.418 38.7344 19.9453 38.7344 20.2617 38.418C20.5781 38.1016 20.5781 37.4688 20.2617 37.1523L3.70312 20.6992H47.1562C47.6836 20.6992 48 20.2773 48 19.75C48 19.3281 47.6836 18.9062 47.1562 18.9062H3.70312L20.2617 2.45312C20.5781 2.13672 20.5781 1.50391 20.2617 1.1875C19.9453 0.871094 19.3125 0.871094 18.9961 1.1875Z" /></svg></button>',
    nextArrow:
      '<button class="next-btn"><svg width="48" height="39" viewBox="0 0 48 39" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M29.0039 1.1875L46.9336 19.2227C47.25 19.5391 47.25 20.0664 46.9336 20.3828L29.0039 38.418C28.582 38.7344 28.0547 38.7344 27.7383 38.418C27.4219 38.1016 27.4219 37.4688 27.7383 37.1523L44.2969 20.6992H0.84375C0.316406 20.6992 0 20.2773 0 19.75C0 19.3281 0.316406 18.9062 0.84375 18.9062H44.2969L27.7383 2.45312C27.4219 2.13672 27.4219 1.50391 27.7383 1.1875C28.0547 0.871094 28.6875 0.871094 29.0039 1.1875Z" /></svg></button>',
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  //5. Nice Select
  $(".nice_select").niceSelect();

  //6. Mobile Menu
  $(".mobile-menu-toggle").on("click", function () {
    $(".mobile-menu").addClass("active");
  });

  $(".mobile-menu .close").on("click", function () {
    $(".mobile-menu").removeClass("active");
  });

  // $(".mobile-menu ul li.has-submenu i").each(function () {
  //     $(this).on("click", function () {
  //     $(this).siblings('ul').slideToggle();
  //     $(this).toggleClass("icon-rotate");
  //     });
  // });

  // $(document).on("mouseup", function (e) {
  //     var offCanvusMenu = $(".mobile-menu");

  //     if (!offCanvusMenu.is(e.target) && offCanvusMenu.has(e.target).length === 0) {
  //         $(".mobile-menu").removeClass("active");
  //     }
  // });

  //7. wow js
  new WOW().init();
})(jQuery);

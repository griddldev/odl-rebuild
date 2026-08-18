document.addEventListener('DOMContentLoaded', function () {
  var blocks = document.querySelectorAll('.crooked-carousel-block');

  blocks.forEach(function (block) {
    var container = block.querySelector('.swiper');
    if (!container) return;

    var prevBtn = block.querySelector('.carousel-prev');
    var nextBtn = block.querySelector('.carousel-next');

    new window.Swiper(container, {
      slidesPerView: 1.4,
      spaceBetween: 4,
      centeredSlides: true,
      loop: false,
      initialSlide: 0,
      navigation: {
        prevEl: prevBtn,
        nextEl: nextBtn,
      },
      breakpoints: {
        640: {
          slidesPerView: 2.4,
        },
        1024: {
          slidesPerView: 3.4,
        },
      },
    });
  });
});

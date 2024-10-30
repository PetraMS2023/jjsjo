var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 50,
  keyboard: {
    enabled: true,
  },
  autoplay: {
    delay: 1500,
    disableOnInteraction: true,
  },
  breakpoints: {
    300: {
      slidesPerView: 1,
    },
    520: {
      slidesPerView: 1.5,
    },
    750: {
      slidesPerView: 2.5,
    },
    900: {
      slidesPerView: 3,
    },
    1050: {
      slidesPerView: 3.5,
    },
    1250: {
      slidesPerView: 4,
    },
  },
});
// Shipping Swiper
const shippingSwiper = new Swiper(".shipping-swiper", {
    slidesPerView: 1,
    spaceBetween: 25,
    loop: true,
    grabCursor: true,
    pagination: {
        el: ".shipping-swiper ~ .swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".shipping-swiper ~ .swiper-button-next",
        prevEl: ".shipping-swiper ~ .swiper-button-prev",
    },
    breakpoints: {
        0: { slidesPerView: 1 },
        520: { slidesPerView: 1 , navigation: false},
        720:{slidesPerView: 2 , navigation: false},
        950: { slidesPerView: 3 },
    },
});

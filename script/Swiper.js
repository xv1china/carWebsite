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
        520: { slidesPerView: 2 },
        950: { slidesPerView: 3 },
    },
});

// Blog Swiper
const blogSwiper = new Swiper(".blog-swiper", {
    slidesPerView: 1,
    spaceBetween: 25,
    loop: true,
    grabCursor: true,
    pagination: {
        el: ".blog-pagination", 
        clickable: true,
    },
    navigation: {
        nextEl: ".blog-next",
        prevEl: ".blog-prev",
    },
    breakpoints: {
        0: { slidesPerView: 1 },
        768: { slidesPerView: 2 },
    },
});

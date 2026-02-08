// Shipping Swiper
(function() {
    'use strict';
    
    const swiperContainer = document.querySelector('.shipping-swiper');
    if (swiperContainer) {
        const swiperMainContainer = swiperContainer.closest('.swiper-main-container');
        
        const shippingSwiper = new Swiper(".shipping-swiper", {
            slidesPerView: 1,
            spaceBetween: 25,
            loop: true,
            grabCursor: true,
            pagination: {
                el: swiperMainContainer ? swiperMainContainer.querySelector('.swiper-pagination') : ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: swiperMainContainer ? swiperMainContainer.querySelector('.swiper-button-next') : ".swiper-button-next",
                prevEl: swiperMainContainer ? swiperMainContainer.querySelector('.swiper-button-prev') : ".swiper-button-prev",
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                520: { slidesPerView: 2, navigation: false },
                950: { slidesPerView: 3 },
            },
        });
    }
})();

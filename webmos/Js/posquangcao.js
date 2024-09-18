const myCustomSwiper = new Swiper('.custom-swiper-container', {
    loop: true, // Enable loop for infinite slides
    pagination: {
        el: '.custom-swiper-pagination',
        clickable: true, // Allow clicking on the dots for navigation
    },
    navigation: {
        nextEl: '.custom-swiper-button-next',
        prevEl: '.custom-swiper-button-prev',
    },
    autoplay: { 
        delay: 3000, // Auto-slide every 3 seconds
    },
});
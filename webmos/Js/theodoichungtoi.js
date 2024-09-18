var swiper = new Swiper('.swiper-container', {
    slidesPerView: 3,           // Display 3 slides per view
    spaceBetween: 20,           // 20px space between slides
    slidesPerGroup: 3,          // Move 3 slides at a time
    loop: true,                 // Enable continuous loop mode
    pagination: {
        el: '.swiper-pagination',
        clickable: true,        // Make pagination clickable
    },
    navigation: {
        nextEl: '.swiper-button-next', // Next button
        prevEl: '.swiper-button-prev', // Previous button
    },
});

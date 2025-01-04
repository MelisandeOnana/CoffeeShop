// public/js/swiper-init.js
document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 10000, // Temps en millisecondes entre les slides
            disableOnInteraction: false, // Continue l'autoplay même après une interaction utilisateur
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});
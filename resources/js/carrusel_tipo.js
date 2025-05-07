
    document.addEventListener("DOMContentLoaded", function () {
    const trackTipos = document.querySelector('.carrusel-track-tipos');
    const slidesTipos = document.querySelectorAll('.slide-tipo');
    const prevTipos = document.getElementById('prev-tipos');
    const nextTipos = document.getElementById('next-tipos');

    const totalSlides = slidesTipos.length;
    const slidesPerPage = 5;
    let currentPage = 0;

    const slideWidth = slidesTipos[0].offsetWidth;

    function updateCarruselTipos() {
    const offset = currentPage * slidesPerPage * slideWidth;
    trackTipos.style.transform = `translateX(-${offset}px)`;
}

    nextTipos.addEventListener('click', () => {
    if ((currentPage + 1) * slidesPerPage < totalSlides) {
    currentPage++;
    updateCarruselTipos();
}
});

    prevTipos.addEventListener('click', () => {
    if (currentPage > 0) {
    currentPage--;
    updateCarruselTipos();
}
});
});


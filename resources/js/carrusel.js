document.addEventListener('DOMContentLoaded', () => {
    let slideIndex = 0;

    // Función para mostrar las diapositivas
    function showSlides(n) {
        const slides = document.querySelectorAll('.slide');

        if (slides.length === 0) {
            console.error("No slides found!");
            return;
        }

        // Ciclo de carrusel (cuando se alcanza el final, vuelve al principio)
        if (n >= slides.length) slideIndex = 0;
        if (n < 0) slideIndex = slides.length - 1;

        // Ocultar todas las diapositivas
        slides.forEach(slide => slide.style.display = "none");

        // Mostrar la diapositiva actual
        slides[slideIndex].style.display = "block";
    }

    // Función para cambiar de diapositiva
    function moveSlide(n) {
        showSlides(slideIndex += n);
    }

    // Inicializa el carrusel
    showSlides(slideIndex);

    // Asignar los botones de control (anterior y siguiente)
    document.querySelector('.prev').addEventListener('click', () => moveSlide(-1));
    document.querySelector('.next').addEventListener('click', () => moveSlide(1));

    // Automatización del carrusel: cambiar la imagen cada 3 segundos
    setInterval(() => {
        moveSlide(1);  // Mover al siguiente slide
    }, 3000);  // Cada 3 segundos (3000 milisegundos)
});

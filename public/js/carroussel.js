document.addEventListener('DOMContentLoaded', function() {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-item');
    const totalSlides = slides.length;

    function changeSlide(direction) {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
        slides[currentSlide].classList.add('active');
    }

    setInterval(() => changeSlide(1), 5000); // Change de diapositive toutes les 5 secondes

    // document.querySelector('.carousel-control.prev').addEventListener('click', () => changeSlide(-1));
    // document.querySelector('.carousel-control.next').addEventListener('click', () => changeSlide(1));
});

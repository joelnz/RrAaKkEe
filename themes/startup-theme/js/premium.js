document.addEventListener('DOMContentLoaded', () => {
    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, { threshold: 0.08 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Slideshow (project pages)
    const slideshow = document.querySelector('.project-slideshow');
    if (slideshow) {
        const slides = slideshow.querySelectorAll('.project-slideshow__slide');
        const dots   = slideshow.querySelectorAll('.project-slideshow__dot');
        const prev   = slideshow.querySelector('.project-slideshow__nav--prev');
        const next   = slideshow.querySelector('.project-slideshow__nav--next');
        let current  = 0;

        function goTo(index) {
            slides[current].classList.remove('project-slideshow__slide--active');
            dots[current]?.classList.remove('project-slideshow__dot--active');
            current = (index + slides.length) % slides.length;
            slides[current].classList.add('project-slideshow__slide--active');
            dots[current]?.classList.add('project-slideshow__dot--active');
        }

        prev?.addEventListener('click', () => goTo(current - 1));
        next?.addEventListener('click', () => goTo(current + 1));
        dots.forEach((dot, i) => dot.addEventListener('click', () => goTo(i)));
    }
});

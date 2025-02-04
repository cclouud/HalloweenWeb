const cards = document.querySelectorAll('.card');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target); // Dejar de observar una vez que se ha hecho visible
        }
    });
});

cards.forEach(card => {
    observer.observe(card); // Observar cada tarjeta
});
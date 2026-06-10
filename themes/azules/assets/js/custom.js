document.addEventListener('DOMContentLoaded', function() {
    // RECUERDA: Cambia '.js-hamburger' por la clase de tu botón HTML
    const hamburger = document.querySelector('.js-hamburger'); 
    
    if (hamburger) {
        hamburger.addEventListener('click', function() {
            document.body.classList.toggle('is-open');
        });
    }
});

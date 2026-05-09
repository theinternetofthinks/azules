document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.faq-item');

    items.forEach(item => {
        const title = item.querySelector('h3');
        console.log('clicked')
        title.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });
});
document.addEventListener('DOMContentLoaded', () => {

    const container = document.getElementById('faq-container');
    if (!container || typeof Sortable === 'undefined') {
            return;
        }

        new Sortable(container, {
            animation: 150,
            handle: '.drag-handle',
            onEnd: () => {
                const items = container.querySelectorAll('.faq-item');
                items.forEach((item, index) => {
                    const pos = item.querySelector('.faq-position');
                    if (pos) pos.value = index;
                });
            }
        });

    // --- ELIMINAR FAQ ---
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-faq')) {
            const item = e.target.closest('.faq-item');
            if (item) {
                item.remove();
                updatePositions();
            }
        }
    });

    // --- RECALCULAR POSICIONES ---
    function updatePositions() {
        const items = container.querySelectorAll('.faq-item');
        items.forEach((item, index) => {
            const pos = item.querySelector('.faq-position');
            if (pos) pos.value = index;
        });
    }

});

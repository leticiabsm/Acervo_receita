document.addEventListener('DOMContentLoaded', function () {
    let index = window.ingredienteCount || 1;

    document.getElementById('add-ingrediente')?.addEventListener('click', function () {
        const template = document.getElementById('ingrediente-template').innerHTML;
        const newRow = template.replace(/__INDEX__/g, index);
        document.getElementById('ingredientes-container').insertAdjacentHTML('beforeend', newRow);
        index++;
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-ingrediente')) {
            e.target.closest('.ingrediente-item')?.remove();
        }
    });
});

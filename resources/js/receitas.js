
document.addEventListener('DOMContentLoaded', function () {
    const addIngredienteBtn = document.getElementById('add-ingrediente');
    const ingredientesContainer = document.getElementById('ingredientes-container');
    const ingredienteTemplate = document.getElementById('ingrediente-template').innerHTML;
    let ingredienteIndex = ingredientesContainer.querySelectorAll('.ingrediente-item').length;

    addIngredienteBtn.addEventListener('click', function () {
        addIngredienteField();
    });

    function addIngredienteField() {
        let html = ingredienteTemplate.replace(/__INDEX__/g, ingredienteIndex);
        ingredientesContainer.insertAdjacentHTML('beforeend', html);
        ingredienteIndex++;
    }

    ingredientesContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-ingrediente')) {
            e.target.closest('.ingrediente-item').remove();
        }
    });

    // Se não houver ingredientes, adiciona um campo inicial
    if (ingredienteIndex === 0) {
        addIngredienteField();
    }
});
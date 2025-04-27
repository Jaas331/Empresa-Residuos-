// Función para agregar un nuevo objeto
function addObject() {
    const container = document.getElementById('objects-container-inorganic'); // Contenedor de objetos
    const objectCount = container.children.length; // Contar los objetos actuales

    if (objectCount < 2) {
        // Crear un nuevo elemento
        const newCard = document.createElement('div');
        newCard.className = 'object-card'; // Clase CSS
        newCard.innerHTML = `
            <span contenteditable="true" name="span-day-inorganic">Ingresa día de la semana</span>
            <input type="hidden" id="input-day-inorganic" name="input-day-inorganic">
            <button class="remove-btn" onclick="removeObject(this)">x</button>
        `;
        container.appendChild(newCard); // Agregar el nuevo objeto al contenedor
    } else {
        alert("Solo se pueden agregar hasta 2 objetos.");
    }
}

function removeObject(element) {
    const parent = element.parentElement; // Contenedor padre del botón 'x'
    const container = document.getElementById('objects-container-inorganic'); // El contenedor principal

    // Asegúrate de que el elemento eliminado sea hijo directo del contenedor principal
    if (container.contains(parent)) {
        parent.remove(); // Elimina solo el hijo específico
    } else {
        console.warn("No se puede eliminar el contenedor principal.");
    }
}



document.addEventListener('DOMContentLoaded', () => {
    const btnSave = document.querySelector('.save-btn');
    const form = document.getElementById('main-form');

    btnSave.addEventListener('click', (e) => {
        // Evitar el envío por defecto mientras preparamos los datos
        e.preventDefault();
            // Elementos únicos
            const editableSpanDangerous = document.getElementById('editable-span-dangerous');
            const hiddenInputDangerous = document.getElementById('hidden-input-dangerous');
            hiddenInputDangerous.value = editableSpanDangerous.textContent;

            // Elementos múltiples
            const editableSpanInorganic = document.getElementsByName('span-day-inorganic');
            const hiddenInputInorganic = document.getElementsByName('input-day-inorganic');

            // Iterar sobre elementos inorgánicos
            for (let i = 0; i < editableSpanInorganic.length; i++) {
                hiddenInputInorganic[i].value = editableSpanInorganic[i].textContent;
            }

            e.preventDefault();

            // Contenedor de los objetos dinámicos
            const objectsContainer = document.getElementById('objects-container-inorganic');
            const spans = objectsContainer.querySelectorAll('[contenteditable="true"]');
    
            // Remover campos ocultos previamente añadidos, si existieran
            form.querySelectorAll('.dynamic-field').forEach(field => field.remove());
    
            // Agregar los valores dinámicos al formulario
            spans.forEach((span, index) => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `input-day-inorganic[]`; // Array en el formulario
                hiddenInput.value = span.textContent.trim(); // Capturar el contenido editable
                hiddenInput.className = 'dynamic-field'; // Clase para identificarlos si es necesario
                form.appendChild(hiddenInput);
            });
    
            // Ahora envía el formulario
            form.submit();


        });
});






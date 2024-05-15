document.addEventListener('DOMContentLoaded', () => {
    const popupContainer = document.querySelector('.popup-container-collection');
    const popupBox = document.querySelector('.popup-box-collection');

    // Agregar el evento a un contenedor estático que envuelve a los botones
    document.addEventListener('click', async (event) => {
        if (event.target.classList.contains('show-popup-collection')) {
            const showPopup = event.target;
            const editUrl = showPopup.getAttribute('data-edit-url');
            try {
                const response = await fetch(editUrl);
                const content = await response.text();
                popupBox.innerHTML = content;
                popupContainer.classList.add('active');
            } catch (error) {
                console.error('Error al cargar el contenido:', error);
            }
        }

        if (event.target.classList.contains('close-btn-collection')) {
            popupBox.innerHTML = '';
            popupContainer.classList.remove('active');
        }
    });

    // Mostrar ventana modal con mensaje de éxito si existe
    if (typeof successMessage !== 'undefined' && successMessage !== '') {
        alert(successMessage); // Aquí puedes usar tu modal personalizado
    }

    if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
        alert(errorMessage); // Aquí puedes usar tu modal personalizado
    }
});


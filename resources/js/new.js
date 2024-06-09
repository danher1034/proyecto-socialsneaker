/**
 * Maneja eventos y acciones en la página "new".
 */
 document.addEventListener('DOMContentLoaded', () => {
    const categories = document.querySelectorAll('.cat');
    const popupContainer = document.querySelector('.popup-container-new');
    const popupBox = document.querySelector('.popup-box-new');

    // Maneja los eventos de clic para mostrar o cerrar el popup de colección
    document.addEventListener('click', async (event) => {
        if (event.target.classList.contains('show-popup-new') || event.target.closest('.show-popup-new')) {
            const showPopup = event.target.closest('.show-popup-new');
            const editUrl = showPopup.getAttribute('data-edit-url');
            try {
                const response = await fetch(editUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const content = await response.text();
                popupBox.innerHTML = content;
                popupContainer.classList.add('active');
            } catch (error) {
                console.error('Error al cargar el contenido:', error);
            }
        }

        if (event.target.classList.contains('close-btn-new')) {
            popupBox.innerHTML = '';
            popupContainer.classList.remove('active');
        }
    });
    
    /**
     * Maneja el clic en las categorías para filtrar por tipo.
     */
     categories.forEach(category => {
        category.addEventListener('click', () => {
            const type = category.getAttribute('data-type');
            const url = new URL(window.location.href);

            if (type === 'all') {
                window.location.href = url.origin + url.pathname;
            } else {
                url.searchParams.set('type', type);
                window.location.href = url.toString();
            }
        });
    });

    const searchButton = document.getElementById('searchButton');
    const searchInput = document.getElementById('busqueda');
    
    /**
     * Maneja el clic en el botón de búsqueda para filtrar por término de búsqueda.
     */
    searchButton.addEventListener('click', () => {
        const search = searchInput.value;
        const url = new URL(window.location.href);
        url.searchParams.set('search', search);
        window.location.href = url.toString();
    });

    if (typeof successMessage !== 'undefined' && successMessage !== '') {
        alert(successMessage);
    }

    if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
        alert(errorMessage);
    }


});






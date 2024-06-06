/**
 * Maneja eventos y acciones en la página "new".
 */
 document.addEventListener('DOMContentLoaded', () => {
    const categories = document.querySelectorAll('.cat');
    
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

    // Mostrar ventana modal con mensaje de éxito si existe
    if (typeof successMessage !== 'undefined' && successMessage !== '') {
        alert(successMessage);
    }

    if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
        alert(errorMessage);
    }
});






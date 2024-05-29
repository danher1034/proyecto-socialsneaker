document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('busqueda');
    const loader = document.getElementById('loader');
    let timeoutId;

    // Función para manejar la entrada del usuario
    window.handleInput = () => {
        // Mostrar el loader
        loader.style.display = 'inline-block';

        // Limpiar cualquier timeout existente
        clearTimeout(timeoutId);

        // Configurar un nuevo timeout para realizar la búsqueda después de 1 segundo
        timeoutId = setTimeout(performSearch, 1000);
    };

    // Función para realizar la búsqueda en tiempo real
    const performSearch = () => {
        const search = searchInput.value;
        const url = new URL(window.location.href);
        url.searchParams.set('search', search);

        // Realizar una solicitud AJAX a la URL de búsqueda
        fetch(url.toString())
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const results = doc.getElementById('search-results').innerHTML;
                document.getElementById('search-results').innerHTML = results;
                // Ocultar el loader
                loader.style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                // Ocultar el loader en caso de error
                loader.style.display = 'none';
            });
    };

    // Mostrar ventana modal con mensaje de éxito si existe
    if (typeof successMessage !== 'undefined' && successMessage !== '') {
        alert(successMessage); // Aquí puedes usar tu modal personalizado
    }

    if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
        alert(errorMessage); // Aquí puedes usar tu modal personalizado
    }
});





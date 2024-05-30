document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('busqueda');
    let loader = document.getElementById('loader');
    let timeoutId;

    // Función para manejar la entrada del usuario
    window.handleInput = () => {
        // Mostrar el loader y ocultar el mensaje de no resultados y la lista de personas
        loader.style.display = 'inline-block';

        const noResultsMessage = document.getElementById('no-results-message');
        if (noResultsMessage) {
            noResultsMessage.style.display = 'none';
        }

        const peopleList = document.getElementById('plist');
        if (peopleList) {
            peopleList.style.display = 'none';
        }

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

                // Volver a asignar la referencia al loader después de actualizar el DOM
                loader = document.getElementById('loader');

                // Mostrar u ocultar el mensaje de no resultados según corresponda
                const noResultsMessage = document.getElementById('no-results-message');
                if (noResultsMessage) {
                    noResultsMessage.style.display = noResultsMessage.innerHTML.includes("No se encontraron resultados de búsqueda") ? 'block' : 'none';
                }

                // Mostrar la lista de personas si hay resultados
                const peopleList = document.getElementById('plist');
                if (peopleList) {
                    peopleList.style.display = 'block';
                }

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

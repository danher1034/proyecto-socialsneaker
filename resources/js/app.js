function openNav() {
    document.getElementById("mobile-menu").style.width = "100%";
}

function closeNav() {
    document.getElementById("mobile-menu").style.width = "0%";
}

window.openNav = openNav;
window.closeNav = closeNav;

document.addEventListener('DOMContentLoaded', () => {
    const showPopup = document.querySelector('.show-popup-edit');
    const popupContainer = document.querySelector('.popup-container');
    const closeBtn = document.querySelector('.close-btn');
    const popupBox = document.querySelector('.popup-box');

    if (showPopup && popupContainer && closeBtn && popupBox) {
        showPopup.onclick = async () => {
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

        closeBtn.onclick = () => {
            popupBox.innerHTML = ''; // Limpiar el contenido del popup al cerrar
            popupContainer.classList.remove('active');
        }
    } else {
        console.error('Uno o más elementos no fueron encontrados en el DOM.');
    }

    // Mostrar ventana modal con mensaje de éxito si existe
    if (typeof successMessage !== 'undefined' && successMessage !== '') {
        alert(successMessage); // Aquí puedes usar tu modal personalizado
    }

    if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
        alert(errorMessage); // Aquí puedes usar tu modal personalizado
    }
});


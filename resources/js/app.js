import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

/**
 * Abre el menú lateral en dispositivos móviles.
 */
function openNav() {
    document.getElementById("mobile-menu").style.width = "100%";
}

/**
 * Cierra el menú lateral en dispositivos móviles.
 */
function closeNav() {
    document.getElementById("mobile-menu").style.width = "0%";
}

window.openNav = openNav;
window.closeNav = closeNav;

document.addEventListener('DOMContentLoaded', () => {
    const showPopupButtons = document.querySelectorAll('.show-popup-edit');
    const popupContainer = document.querySelector('.popup-container');
    const closeBtn = document.querySelector('.close-btn');
    const popupBox = document.querySelector('.popup-box');



    if (showPopupButtons && popupContainer && closeBtn && popupBox) {
        showPopupButtons.forEach(button => {
            /**
             * Maneja el evento de clic en los botones para mostrar el popup de edición.
             */
            button.onclick = async () => {
                const editUrl = button.getAttribute('data-edit-url');
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
        });
        /**
         * Maneja el evento de clic en el botón de cerrar el popup.
         */
        closeBtn.onclick = () => {
            popupBox.innerHTML = ''; // Limpiar el contenido del popup al cerrarlo
            popupContainer.classList.remove('active');
        }
    } else {
        console.error('Uno o más elementos no fueron encontrados en el DOM.');
    }

    /**
     * Muestra un mensaje de éxito si está definido.
     */
    if (typeof successMessage !== 'undefined' && successMessage !== '') {
        alert(successMessage);
    }

    /**
     * Muestra un mensaje de error si está definido.
     */
    if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
        alert(errorMessage);
    }
});




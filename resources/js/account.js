document.addEventListener('DOMContentLoaded', () => {
    const showPopup = document.querySelector('.show-popup');
    const popupContainer = document.querySelector('.popup-container');
    const closeBtn = document.querySelector('.close-btn');
    const popupBox = document.querySelector('.popup-box');

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
});

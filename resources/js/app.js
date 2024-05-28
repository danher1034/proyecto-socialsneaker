function openNav() {
    document.getElementById("mobile-menu").style.width = "100%";
}

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
            button.onclick = async () => {
                const editUrl = button.getAttribute('data-edit-url');
                try {
                    const response = await fetch(editUrl);
                    const content = await response.text();
                    popupBox.innerHTML = content;
                    popupContainer.classList.add('active');
                } catch (error) {
                    console.error('Error al cargar el contenido:', error);
                }
            }
        });

        closeBtn.onclick = () => {
            popupBox.innerHTML = ''; // Clear the popup content when closing
            popupContainer.classList.remove('active');
        }
    } else {
        console.error('Uno o más elementos no fueron encontrados en el DOM.');
    }
    if (typeof successMessage !== 'undefined' && successMessage !== '') {
        alert(successMessage); // Aquí puedes usar tu modal personalizado
    }

    if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
        alert(errorMessage); // Aquí puedes usar tu modal personalizado
    }
});



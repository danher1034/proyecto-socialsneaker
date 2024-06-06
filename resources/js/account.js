import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function () {

    // Función para manejar formularios de comentarios
    function handleCommentForms() {
        // Lógica para manejar formularios de comentarios si es necesario
    }

    // Delegación de eventos para los popups de colección
    document.addEventListener('click', async (event) => {
        if (event.target.classList.contains('show-popup-collection') || event.target.closest('.show-popup-collection')) {
            const showPopup = event.target.closest('.show-popup-collection');
            const editUrl = showPopup.getAttribute('data-edit-url');
            try {
                const response = await fetch(editUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const content = await response.text();
                const popupContainer = document.querySelector('.popup-container-collection');
                const popupBox = document.querySelector('.popup-box-collection');
                popupBox.innerHTML = content;
                popupContainer.classList.add('active');
                handleCommentForms(); // Asegúrate de aplicar el manejador a los formularios en el popup
            } catch (error) {
                console.error('Error al cargar el contenido:', error);
            }
        }

        if (event.target.classList.contains('close-btn-collection')) {
            const popupContainer = document.querySelector('.popup-container-collection');
            const popupBox = document.querySelector('.popup-box-collection');
            popupBox.innerHTML = '';
            popupContainer.classList.remove('active');
        }
    });

    // Manejo del primer dropdown
    const dropBtn = document.querySelector('.dropbtn');
    const dropdownContent = document.querySelector('.dropdown-content');

    if (dropBtn && dropdownContent) {
        dropBtn.addEventListener('click', function () {
            dropdownContent.classList.toggle('show');
        });

        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                if (dropdownContent.classList.contains('show')) {
                    dropdownContent.classList.remove('show');
                }
            }
        };
    }

    const langDropBtn = document.querySelector('.dropbtn-i');
    const langDropdownContent = document.querySelector('.dropdown-content-i');

    if (langDropBtn && langDropdownContent) {
        langDropBtn.addEventListener('click', function (event) {
            event.stopPropagation();
            langDropdownContent.classList.toggle('show');
        });

        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn-i')) {
                if (langDropdownContent.classList.contains('show')) {
                    langDropdownContent.classList.remove('show');
                }
            }
        };

        langDropdownContent.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    }

    // Manejar la confirmación de eliminación de cuenta usando SweetAlert2
    document.getElementById('delete-account').addEventListener('click', function (event) {
        Swal.fire({
            title: messages.delete_confirm_title,
            text: messages.delete_confirm_text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: messages.delete_confirm_button
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: messages.deleted_title,
                    text: messages.deleted_text,
                    icon: "success"
                });
                document.getElementById('delete-account-form').submit();
            }
        });
    });

    // Manejar el evento de clic en el botón de seguir/dejar de seguir
    const followButton = document.getElementById('follow-button');

    if (followButton) {
        followButton.addEventListener('click', function () {
            const userId = this.getAttribute('data-user-id');
            const url = `/follow/${userId}`;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content') })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.followed) {
                        followButton.textContent = 'Siguiendo';
                    } else {
                        followButton.textContent = 'Seguir';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    }
});


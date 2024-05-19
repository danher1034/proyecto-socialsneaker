document.addEventListener('DOMContentLoaded', () => {
    const commentForms = document.querySelectorAll('.coment_form');

    commentForms.forEach((commentForm) => {
        const commentInput = commentForm.querySelector('input[name="text"]');
        const submitButton = commentForm.querySelector('button[type="submit"]');

        if (commentInput && submitButton) {
            commentInput.addEventListener('input', () => {
                if (commentInput.value.trim().length > 0) {
                    submitButton.classList.remove('hidden');
                } else {
                    submitButton.classList.add('hidden');
                }
            });

            commentForm.addEventListener('submit', (event) => {
                if (commentInput.value.trim().length === 0) {
                    event.preventDefault();
                    alert('Por favor, añade un comentario antes de enviar.');
                }
            });
        }
    });

    const popupContainer = document.querySelector('.popup-container-collection');
    const popupBox = document.querySelector('.popup-box-collection');

    document.addEventListener('click', async (event) => {
        if (event.target.classList.contains('show-popup-collection') || event.target.closest('.show-popup-collection')) {
            const showPopup = event.target.closest('.show-popup-collection');
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

    if (typeof successMessage !== 'undefined' && successMessage !== '') {
        alert(successMessage);
    }

    if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
        alert(errorMessage);
    }

    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', async (event) => {
            const collectionId = button.getAttribute('data-id');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(`/collections/like/${collectionId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    const icon = button.querySelector('i');

                    if (result.liked) {
                        icon.classList.remove('bi-heart', 'corazon');
                        icon.classList.add('bi-heart-fill', 'corazon-lleno');
                    } else {
                        icon.classList.remove('bi-heart-fill', 'corazon-lleno');
                        icon.classList.add('bi-heart', 'corazon');
                    }
                } else {
                    console.error('Error al dar like');
                }
            } catch (error) {
                console.error('Error en la petición de like:', error);
            }
        });
    });
});








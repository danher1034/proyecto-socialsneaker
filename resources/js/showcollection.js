document.addEventListener('DOMContentLoaded', () => {
    // Función para manejar formularios de comentarios
    const handleCommentForms = (container = document) => {
        const commentForms = container.querySelectorAll('.coment_form');

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

                commentForm.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    if (commentInput.value.trim().length === 0) {
                        alert('Por favor, añade un comentario antes de enviar.');
                        return;
                    }

                    const formData = new FormData(commentForm);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    try {
                        const response = await fetch(commentForm.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData
                        });

                        if (response.ok) {
                            const result = await response.json();
                            if (result.success) {
                                const newComment = document.createElement('div');
                                newComment.classList.add('d-flex', 'align-items-center', 'mb-1');
                                newComment.innerHTML = `
                                    <img src="${result.comment.user.image_user}" alt="${result.comment.user.name}'s Image" class="img-fluid rounded-circle user-image-comment">
                                    &nbsp;&nbsp;
                                    <strong>${result.comment.user.name}</strong>
                                    &nbsp;
                                    ${result.comment.text}
                                `;
                                
                                // Insert new comment before the form
                                commentForm.insertAdjacentElement('beforebegin', newComment);

                                // Reset form
                                commentInput.value = '';
                                submitButton.classList.add('hidden');

                                // Specific handling for popup update in show.blade.php
                                if (container.classList.contains('popup-box-collection')) {
                                    // Refresh comments in the popup
                                    const commentsContainer = container.querySelector('.comments-users-show');
                                    if (commentsContainer) {
                                        commentsContainer.appendChild(newComment);
                                    }
                                }

                            } else {
                                alert(result.message);
                            }
                        } else {
                            alert('Error al enviar el comentario.');
                        }
                    } catch (error) {
                        console.error('Error en la petición de comentario:', error);
                    }
                });
            }
        });
    };

    // Función para manejar botones de like
    const handleLikeButtons = (container = document) => {
        container.querySelectorAll('.like-button').forEach(button => {
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
    };

    // Llama a la función para manejar los formularios de comentarios
    handleCommentForms();
    handleLikeButtons();

    const popupContainer = document.querySelector('.popup-container-collection');
    const popupBox = document.querySelector('.popup-box-collection');

    // Maneja los eventos de clic para mostrar o cerrar el popup de colección
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
                popupBox.innerHTML = content;
                popupContainer.classList.add('active');
                handleCommentForms(popupBox); // Aplicar manejador de formularios en el popup
                handleLikeButtons(popupBox); // Aplicar manejador de botones de like en el popup
            } catch (error) {
                console.error('Error al cargar el contenido:', error);
            }
        }

        if (event.target.classList.contains('close-btn-collection')) {
            popupBox.innerHTML = '';
            popupContainer.classList.remove('active');
        }
    });

    // Mostrar ventana modal con mensaje de éxito si existe
    if (typeof successMessage !== 'undefined' && successMessage !== '') {
        alert(successMessage);
    }

});

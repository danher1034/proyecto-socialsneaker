document.addEventListener('DOMContentLoaded', function () {
    const followButton = document.getElementById('follow-button');

    // Manejo del primer dropdown
    const dropBtn = document.querySelector('.dropbtn');
    const dropdownContent = document.querySelector('.dropdown-content');

    if (dropBtn && dropdownContent) {
        dropBtn.addEventListener('click', function () {
            dropdownContent.classList.toggle('show');
        });

        window.onclick = function(event) {
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

        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn-i')) {
                if (langDropdownContent.classList.contains('show')) {
                    langDropdownContent.classList.remove('show');
                }
            }
        };

        langDropdownContent.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }

    // Manejo de eliminación de cuenta
    document.getElementById('delete-account').addEventListener('click', function(event) {
        event.preventDefault();
        if (confirm('¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.')) {
            document.getElementById('delete-account-form').submit();
        }
    });

    // Manejo del botón de seguir
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
                    followButton.classList.remove('btn-primary');
                    followButton.classList.add('btn-secondary');
                } else {
                    followButton.textContent = 'Seguir';
                    followButton.classList.remove('btn-secondary');
                    followButton.classList.add('btn-primary');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});


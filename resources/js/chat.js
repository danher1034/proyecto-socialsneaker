/**
 * Maneja el envío del formulario de mensaje en el chat.
 * @param {Event} e - El evento de envío del formulario.
 */
document.getElementById('message-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Previene el envío tradicional del formulario

    let formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let messageList = document.querySelector('.chat-history ul');
            let newMessage = document.createElement('li');
            newMessage.classList.add('clearfix');
            newMessage.innerHTML = `
                <div class="message other-message float-right">
                    ${data.message.text}
                </div>
            `;
            messageList.appendChild(newMessage);
            document.getElementById('message-text').value = ''; // Limpia el campo de texto
        } else {
            console.error('Error:', data.error);
        }
    })
    .catch(error => console.error('Error:', error));
});




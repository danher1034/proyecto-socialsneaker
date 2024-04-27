import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe automáticamente
        if (validateForm()) {
            // Si la validación es exitosa, puedes enviar el formulario aquí
            this.submit(); // Envía el formulario
        }
    });
});
// Función para validar el formulario antes de enviarlo
function validateForm() {
    event.preventDefault();
    var name = document.getElementById('name_sign').value;
    var email = document.getElementById('email_sign').value;
    var birthday = document.getElementById('birthday_sign').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('password_confirmation').value;
    console.log('mau')
    // Realizar todas las validaciones de JavaScript
    if (name.trim() === '') {
        alert('Por favor, introduce un nombre de usuario.');
        return false;
    }
    if (!validateEmail(email)) {
        alert('Por favor, introduce una dirección de correo electrónico válida.');
        return false;
    }
    if (!validateBirthday(birthday)) {
        alert('Debes tener al menos 16 años para registrarte.');
        return false;
    }
    if (password.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return false;
    }
    if (password !== confirmPassword) {
        alert('Las contraseñas no coinciden.');
        return false;
    }

    // Si todas las validaciones de JavaScript pasan, enviar el formulario
    return true;
}


// Función para validar un correo electrónico
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// Función para validar la fecha de cumpleaños (debe ser mayor de 16 años)
function validateBirthday(birthday) {
    var birthdayDate = new Date(birthday);
    var today = new Date();
    var minAge = 16;
    var minDate = new Date(today.getFullYear() - minAge, today.getMonth(), today.getDate());

    return birthdayDate <= minDate;
}






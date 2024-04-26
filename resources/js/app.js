import './bootstrap';

// Función para validar el formulario antes de enviarlo
function validateForm(event) {
    // Obtener los valores de los campos del formulario
    event.preventDefault();
    var name = document.getElementById('name_sign').value;
    var name = document.getElementById('name_sign').value;
    var email = document.getElementById('email_sign').value;
    var birthday = document.getElementById('birthday_sign').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('password_confirmation').value;

    // Verificar que el nombre de usuario no esté vacío
    if (name.trim() === '') {
        alert('Por favor, introduce un nombre de usuario.');
        return false;
    }

    // Verificar que se haya ingresado un correo electrónico válido
    if (!validateEmail(email)) {
        alert('Por favor, introduce una dirección de correo electrónico válida.');
        return false;
    }

    // Verificar que se haya ingresado una fecha de cumpleaños válida (mayor de 16 años)
    if (!validateBirthday(birthday)) {
        alert('Debes tener al menos 16 años para registrarte.');
        return false;
    }

    // Verificar que la contraseña tenga al menos 8 caracteres
    if (password.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return false;
    }

    // Verificar que la contraseña y su confirmación coincidan
    if (password !== confirmPassword) {
        alert('Las contraseñas no coinciden.');
        return false;
    }

    // Si todas las validaciones son exitosas, enviar el formulario
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






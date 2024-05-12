const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
    password: /^.{8,50}$/, // 4 a 12 digitos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    fechaNacimiento: /^\d{4}\-\d{2}\-\d{2}$/ // Formato YYYY-MM-DD
};

const campos = {
    usuario: false,
    password: false,
    correo: false,
    fechaNacimiento: false
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "name":
            validarCampo(expresiones.usuario, e.target, 'name');
            break;
        case "email":
            validarCampo(expresiones.correo, e.target, 'email');
            break;
        case "birthday":
            validarFechaNacimiento(e.target);
            break;
        case "password":
            validarCampo(expresiones.password, e.target, 'password');
            validarPassword2();
            break;
        case "password_confirmation":
            validarPassword2();
            break;
    }
};


const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
};

const validarPassword2 = () => {
    const inputPassword1 = document.getElementById('password');
    const inputPassword2 = document.getElementById('password_confirmation');

    if (inputPassword1.value !== inputPassword2.value) {
        document.getElementById(`grupo__password_confirmation`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__password_confirmation`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__password_confirmation i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__password_confirmation i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__password_confirmation .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos['password_confirmation'] = false;
    } else {
        document.getElementById(`grupo__password_confirmation`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__password_confirmation`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__password_confirmation i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__password_confirmation i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__password_confirmation .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos['password_confirmation'] = true;
    }

};

const validarFechaNacimiento = (input) => {
    const fechaNacimiento = input.value;
    const fechaNacimientoDate = new Date(fechaNacimiento);
    const edadMilisegundos = Date.now() - fechaNacimientoDate.getTime();
    const edadFecha = new Date(edadMilisegundos);

    const edad = Math.abs(edadFecha.getUTCFullYear() - 1970);

    if (edad < 16) {
        // Aquí es donde se produce el error si `input` no corresponde al elemento esperado
        document.getElementById(`grupo__fechaNacimiento`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__fechaNacimiento`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__fechaNacimiento i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__fechaNacimiento i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__fechaNacimiento .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos['fechaNacimiento'] = false;
    } else {
        document.getElementById(`grupo__fechaNacimiento`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__fechaNacimiento`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__fechaNacimiento i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__fechaNacimiento i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__fechaNacimiento .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos['fechaNacimiento'] = true;
    }
};


inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});


formulario.addEventListener('submit', (e) => {
    e.preventDefault(); // Detener el envío inicial del formulario

    const terminos = document.getElementById('terminos');

    // Verificar si todos los campos son válidos
    if (campos['name'] && campos['email'] && campos['password'] && campos['password_confirmation'] && campos['fechaNacimiento'] && terminos.checked) {
        // Si todos los campos son válidos, enviar el formulario
        formulario.submit();

        // Resetear el formulario y mostrar mensaje de éxito (si es necesario)
        formulario.reset();
        document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
        setTimeout(() => {
            document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
        }, 5000);

        // Remover las clases de validación correcta después del envío
        document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
            icono.classList.remove('formulario__grupo-correcto');
        });
    } else {
        // Mostrar mensaje de error porque no todos los campos son válidos
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
    }
});

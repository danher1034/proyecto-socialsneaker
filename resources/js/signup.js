/**
 * Maneja eventos y validación del formulario de registro.
 */
document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.getElementById('formulario');
    const inputs = document.querySelectorAll('#formulario input');

    // Expresiones regulares para validación
    const expresiones = {
        usuario: /^[a-zA-Z0-9\_\-]{5,16}$/,
        password: /^.{8,50}$/,
        correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
        fechaNacimiento: /^\d{4}\-\d{2}\-\d{2}$/
    };

    const campos = {
        usuario: false,
        password: false,
        correo: false,
        fechaNacimiento: false
    };

    /**
     * Valida el formulario antes de enviarlo.
     * @param {Event} e - Evento de envío del formulario.
     */    
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

    /**
     * Valida un campo de entrada del formulario.
     * @param {RegExp} expresion - Expresión regular para la validación.
     * @param {HTMLInputElement} input - Elemento de entrada a validar.
     * @param {string} campo - Nombre del campo a validar.
     */
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

    /**
     * Valida la coincidencia de los campos de contraseña.
     */
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

    /**
     * Valida la fecha de nacimiento.
     * @param {HTMLInputElement} input - Elemento de entrada que contiene la fecha de nacimiento.
     */
    const validarFechaNacimiento = (input) => {
        const fechaNacimiento = input.value;
        const fechaNacimientoDate = new Date(fechaNacimiento);
        const edadMilisegundos = Date.now() - fechaNacimientoDate.getTime();
        const edadFecha = new Date(edadMilisegundos);

        const edad = Math.abs(edadFecha.getUTCFullYear() - 1970);

        if (edad < 16) {
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

    // Agrega eventos de validación a los campos del formulario
    inputs.forEach((input) => {
        input.addEventListener('keyup', validarFormulario);
        input.addEventListener('blur', validarFormulario);
    });

    // Maneja el evento de envío del formulario
    formulario.addEventListener('submit', (e) => {
        e.preventDefault();

        const terminos = document.getElementById('terminos');

        // Verifica si todos los campos están validados y el checkbox de términos está marcado
        if (campos['name'] && campos['email'] && campos['password'] && campos['password_confirmation'] && campos['fechaNacimiento'] && terminos.checked) {
            formulario.submit();

            formulario.reset();
            document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
            setTimeout(() => {
                document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
            }, 5000);

            document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
                icono.classList.remove('formulario__grupo-correcto');
            });
        } else {
            document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
        }
    });

    // Maneja el evento de carga del DOM para el desplegable de idiomas
    document.addEventListener('DOMContentLoaded', function () {
        const langDropBtn = document.querySelector('.dropbtn-i');
        const langDropdownContent = document.querySelector('.dropdown-content-i');

        if (langDropBtn && langDropdownContent) {
            langDropBtn.addEventListener('click', function (event) {
                event.stopPropagation(); // Evitar que el evento de clic se propague al cuerpo del documento
                langDropdownContent.classList.toggle('show');
                console.log("Dropdown toggled");
            });

            langDropdownContent.addEventListener('click', function(event) {
                event.stopPropagation(); // Evitar que el evento de clic se propague al cuerpo del documento
            });

            // Cierra el desplegable cuando se hace clic fuera de él
            window.addEventListener('click', function(event) {
                if (!event.target.matches('.dropbtn-i')) {
                    if (langDropdownContent.classList.contains('show')) {
                        langDropdownContent.classList.remove('show');
                        console.log("Dropdown closed");
                    }
                }
            });
        }
    });
});

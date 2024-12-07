import UsuarioService from "../services/usuario.js";

const formElement = document.getElementById('formLogin');
const emailElement = document.getElementById('email');
const passwordElement = document.getElementById('password');
const submitButton = document.getElementById('submitButton');
const usuarioService = new UsuarioService();

emailElement.value = '';

function validarCampos() {
    if (emailElement.value.trim() === '' || passwordElement.value.trim() === '' || !formElement.checkValidity()) {
        submitButton.disabled = true;
    } else {
        submitButton.disabled = false;
    }
}

emailElement.addEventListener('input', validarCampos);
passwordElement.addEventListener('input', validarCampos);
validarCampos();

formElement.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (!formElement.checkValidity()) {
        return;
    }

    const email = emailElement.value;
    const password = passwordElement.value;

    try {
        const response = await usuarioService.login(email, password);

        if (response.tieneError) {
            alert(response.mensaje);
        }
    } catch (error) {
        alert(error);
    }
});

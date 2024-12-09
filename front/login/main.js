import GeneralResponse from "../models/dtos/general-response.dto.js";
import UsuarioService from "../services/usuario.js";

const formElement = document.getElementById('formLogin');
const emailElement = document.getElementById('email');
const passwordElement = document.getElementById('password');
const submitButton = document.getElementById('submitButton');
const usuarioService = new UsuarioService();

emailElement.value = '';

formElement.addEventListener('input', () => {
    if (!formElement.checkValidity()) {
        submitButton.disabled = true;
    } else {
        submitButton.disabled = false;
    }
});

formElement.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (!formElement.checkValidity()) {
        return;
    }

    const email = emailElement.value.trim().toUpperCase();
    const password = passwordElement.value;

    try {
        const response = await usuarioService.login(email, password);
        const generapRsp = new GeneralResponse(response.tieneError, response.mensaje, response.data);

        if (generapRsp.tieneError) {
            alert(response.mensaje);
            return;
        }
    } catch (error) {
        alert(error);
    }
});

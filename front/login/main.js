import GeneralResponse from "../models/dtos/general-response.dto.js";
import SessionService from "../services/session.js";
import UsuarioService from "../services/usuario.js";

const formElement = document.getElementById('formLogin');
const emailElement = document.getElementById('email');
const passwordElement = document.getElementById('password');
const submitButton = document.getElementById('submitButton');
const usuarioSrv = new UsuarioService();
const sessionSrv = new SessionService();

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
        const loginRsp = await usuarioSrv.login(email, password);
        let generalRsp = new GeneralResponse(loginRsp.tieneError, loginRsp.mensaje, loginRsp.data);

        if (generalRsp.tieneError) {
            alert(loginRsp.mensaje);
            return;
        }
    } catch (error) {
        alert(error);
    }
});

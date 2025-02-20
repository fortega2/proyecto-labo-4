import GeneralResponse from "../../models/dtos/general-response.dto.js";
import SessionService from "../../services/session.js";
import UsuarioService from "../../services/usuario.js";

const formElement = document.getElementById('formLogin') as HTMLFormElement;
const emailElement = document.getElementById('email') as HTMLInputElement;
const passwordElement = document.getElementById('password') as HTMLInputElement;
const submitButton = document.getElementById('submitButton') as HTMLButtonElement;

const validarForm = () => {
    if (!formElement.checkValidity()) {
        submitButton.disabled = true;
    } else {
        submitButton.disabled = false;
    }
};

const usuarioSrv = new UsuarioService();
const sessionSrv = new SessionService();

emailElement.value = '';
passwordElement.value = '';
validarForm();

formElement?.addEventListener('input', validarForm);

formElement?.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (!formElement.checkValidity()) {
        return;
    }

    const email = emailElement?.value.trim();
    const password = passwordElement?.value;

    try {
        const loginRsp = await usuarioSrv.login(email, password);
        let generalRsp = new GeneralResponse(loginRsp.data, loginRsp.tieneError, loginRsp.mensaje);

        if (generalRsp.tieneError) {
            alert(loginRsp.mensaje);
            return;
        }
    } catch (error) {
        alert(error);
    }
});

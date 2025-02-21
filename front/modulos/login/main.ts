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

    const rsp = await usuarioSrv.login(email, password);

    if (rsp.tieneError) {
        alert(rsp.mensaje);
    } else {
        window.location.href = '../home/index.html';
    }
});

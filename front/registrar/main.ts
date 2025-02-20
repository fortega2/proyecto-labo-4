import GeneralResponse from "../models/dtos/general-response.dto.js";
import UsuarioService from "../services/usuario.js";

const formElement = document.getElementById('form') as HTMLFormElement;
const nombreElement = document.getElementById('nombre') as HTMLInputElement;
const apellidoElement = document.getElementById('apellido') as HTMLInputElement;
const passwordElement = document.getElementById('password') as HTMLInputElement;
const emailElement = document.getElementById('email') as HTMLInputElement;
const dniElement = document.getElementById('dni') as HTMLInputElement;
const celularElement = document.getElementById('celular') as HTMLInputElement;
const inicioSesionButton = document.getElementById('inicioSesion') as HTMLButtonElement;
const registrarButton = document.getElementById('registrar') as HTMLButtonElement;

const resetearCamposForm = () => {
    nombreElement.value = '';
    apellidoElement.value = '';
    emailElement.value = '';
    dniElement.value = '';
    celularElement.value = '';
    registrarButton.disabled = true;
}

const volverLogin = () => {
    window.location.href = '../login';
}

const usuarioService = new UsuarioService();

resetearCamposForm();

inicioSesionButton.addEventListener('click', volverLogin);

formElement.addEventListener('input', () => {
    if (!formElement.checkValidity()) {
        registrarButton.disabled = true;
    } else {
        registrarButton.disabled = false;
    }
});

formElement.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (!formElement.checkValidity()) {
        return;
    }

    const usuario = {
        nombre: nombreElement.value.trim().toUpperCase(),
        apellido: apellidoElement.value.trim().toUpperCase(),
        password: passwordElement.value,
        email: emailElement.value.trim(),
        dni: parseInt(dniElement.value, 10),
        celular: celularElement.value ? parseInt(celularElement.value, 10) : null,
    };

    try {
        const response = await usuarioService.crear(usuario);
        const generapRsp = new GeneralResponse(response.tieneError, response.mensaje, response.data);

        if (generapRsp.tieneError) {
            alert(response.mensaje);
            return;
        }

        alert(generapRsp.mensaje);
        volverLogin();
    } catch (error) {
        alert(error);
    }
});

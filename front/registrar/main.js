import GeneralResponse from "../models/dtos/general-response.dto.js";
import UsuarioService from "../services/usuario.js";

const formElement = document.getElementById('form');
const nombreElement = document.getElementById('nombre');
const apellidoElement = document.getElementById('apellido');
const passwordElement = document.getElementById('password');
const emailElement = document.getElementById('email');
const dniElement = document.getElementById('dni');
const celularElement = document.getElementById('celular');
const inicioSesionButton = document.getElementById('inicioSesion');
const registrarButton = document.getElementById('registrar');
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
        email: emailElement.value.trim().toUpperCase(),
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

function resetearCamposForm() {
    nombreElement.value = '';
    apellidoElement.value = '';
    emailElement.value = '';
    dniElement.value = '';
    celularElement.value = '';
    registrarButton.disabled = true;
}

function volverLogin() {
    window.location.href = '../login';
}

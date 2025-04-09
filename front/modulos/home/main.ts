import { NombrePagina } from "../../constantes.js";
import Usuario from "../../models/entities/usuario.model.js";
import SessionService from "../../services/session.js";

const cerrarSesionBtn = document.getElementById('cerrarSessionBtn') as HTMLButtonElement;
const misVuelosBtn = document.getElementById('misVuelosBtn') as HTMLButtonElement;
const perfilBtn = document.getElementById('perfilBtn') as HTMLButtonElement;
const userNameSpan = document.getElementById('userName') as HTMLSpanElement;
const nombrePaginaSpan = document.getElementById('nombrePagina') as HTMLSpanElement;
const sessionService = new SessionService();
let datosUsuario = new Usuario();

const volverLogin = () => {
    const loginPath = '../login/index.html';
    window.location.href = loginPath;
};
const getSessionData = async () => {
    const rsp = await sessionService.getSessionData();

    if (rsp.tieneError) {
        alert(rsp.mensaje);
        return;
    }

    datosUsuario = JSON.parse(rsp.data.usuario);
    userNameSpan.innerText = `${datosUsuario.nombre} ${datosUsuario.apellido}`;
};

getSessionData();
nombrePaginaSpan.innerText = NombrePagina;

cerrarSesionBtn?.addEventListener('click', async () => {
    const rsp = await sessionService.sessionDestroy();

    if (rsp.tieneError) {
        alert(rsp.mensaje);
        return;
    }

    volverLogin();
});

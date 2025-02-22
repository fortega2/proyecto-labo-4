import Usuario from "../../models/entities/usuario.model.js";
import SessionService from "../../services/session.js";

const cerrarSesionBtn = document.getElementById('cerrarSessionBtn') as HTMLButtonElement;
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
    console.log(datosUsuario);
};

const sessionService = new SessionService();

getSessionData();

cerrarSesionBtn?.addEventListener('click', async () => {
    const rsp = await sessionService.sessionDestroy();

    if (rsp.tieneError) {
        alert(rsp.mensaje);
        return;
    }

    volverLogin();
});

"use strict";
const cerrarSesionBtn = document.getElementById('cerrarSesionBtn');
const volverLogin = () => {
    const loginPath = '../login';
    window.location.href = loginPath;
};
cerrarSesionBtn === null || cerrarSesionBtn === void 0 ? void 0 : cerrarSesionBtn.addEventListener('click', () => {
    volverLogin();
});

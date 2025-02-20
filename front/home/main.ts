const cerrarSesionBtn = document.getElementById('cerrarSesionBtn');
const volverLogin = () => {
    const loginPath = '../login';
    window.location.href = loginPath;
}

cerrarSesionBtn?.addEventListener('click', () => {
    volverLogin();
});

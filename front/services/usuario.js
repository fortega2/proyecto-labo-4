import { BACK_WS } from "../environments/environment.js";

class UsuarioService {
    constructor() {
        this.urlUsuario = `${BACK_WS}/usuario`;
    }

    async login(email, password) {
        const encodedEmail = encodeURIComponent(email);
        const encodedPassword = encodeURIComponent(password);

        const response = await fetch(`${this.urlUsuario}/loginUsuario.php?email=${encodedEmail}&password=${encodedPassword}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        return response.json();
    }

    async crear(usuario) {
        const response = await fetch(`${this.urlUsuario}/insert.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(usuario),
        });

        return response.json();
    }
}

export default UsuarioService;

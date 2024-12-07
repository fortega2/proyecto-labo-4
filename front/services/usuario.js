import { API_URL } from "../environments/environment.js";

class UsuarioService {
    constructor() {
        this.urlUsuario = `${API_URL}/usuario`;
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
}

export default UsuarioService;

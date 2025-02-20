class UsuarioService {
    private readonly _urlUsuario = 'http://localhost/proyecto-labo-4/back/controllers/usuario';

    public async login(email: string, password: string) {
        const encodedEmail = encodeURIComponent(email);
        const encodedPassword = encodeURIComponent(password);

        const response = await fetch(`${this._urlUsuario}/loginUsuario.php?email=${encodedEmail}&password=${encodedPassword}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        return response.json();
    }

    public async crear(usuario: any) {
        const response = await fetch(`${this._urlUsuario}/insert.php`, {
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

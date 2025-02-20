class SessionService {
    private readonly _urlSession = 'http://localhost/proyecto-labo-4/back/controllers/session';

    public async getAll() {
        const response = await fetch(`${this._urlSession}/getAll.php`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        return response.json();
    }

    public async getByKey(key: string) {
        const encodedKey = encodeURIComponent(key);

        const response = await fetch(`${this._urlSession}/getByKey.php?key=${encodedKey}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        return response.json();
    }
}

export default SessionService;

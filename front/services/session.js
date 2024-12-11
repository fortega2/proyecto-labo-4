import { BACK_WS } from "../environments/environment.js";

class SessionService {
    constructor() {
        this.urlSession = `${BACK_WS}/session`;
    }

    async getAll() {
        const response = await fetch(`${this.urlSession}/getAll.php`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        return response.json();
    }

    async getByKey(key) {
        const encodedKey = encodeURIComponent(key);

        const response = await fetch(`${this.urlSession}/getByKey.php?key=${encodedKey}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        return response.json();
    }
}

export default SessionService;

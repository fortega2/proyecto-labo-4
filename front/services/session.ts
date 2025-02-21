import GeneralResponse from "../models/dtos/general-response.dto";

class SessionService {
    private readonly _urlSession = 'http://localhost/proyecto-labo-4/back/controllers/session';

    public async getAll(): Promise<GeneralResponse<any[]>> {
        const response = await fetch(`${this._urlSession}/getAll.php`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        return response.json();
    }

    public async getByKey(key: string): Promise<GeneralResponse<any>> {
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

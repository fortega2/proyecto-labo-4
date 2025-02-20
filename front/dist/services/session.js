var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
class SessionService {
    constructor() {
        this._urlSession = 'http://localhost/proyecto-labo-4/back/controllers/session';
    }
    getAll() {
        return __awaiter(this, void 0, void 0, function* () {
            const response = yield fetch(`${this._urlSession}/getAll.php`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            return response.json();
        });
    }
    getByKey(key) {
        return __awaiter(this, void 0, void 0, function* () {
            const encodedKey = encodeURIComponent(key);
            const response = yield fetch(`${this._urlSession}/getByKey.php?key=${encodedKey}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            return response.json();
        });
    }
}
export default SessionService;

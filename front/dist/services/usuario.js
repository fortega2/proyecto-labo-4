var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
class UsuarioService {
    constructor() {
        this._urlUsuario = 'http://localhost/proyecto-labo-4/back/controllers/usuario';
    }
    login(email, password) {
        return __awaiter(this, void 0, void 0, function* () {
            const encodedEmail = encodeURIComponent(email);
            const encodedPassword = encodeURIComponent(password);
            const response = yield fetch(`${this._urlUsuario}/loginUsuario.php?email=${encodedEmail}&password=${encodedPassword}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            return response.json();
        });
    }
    crear(usuario) {
        return __awaiter(this, void 0, void 0, function* () {
            const response = yield fetch(`${this._urlUsuario}/insert.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(usuario),
            });
            return response.json();
        });
    }
}
export default UsuarioService;

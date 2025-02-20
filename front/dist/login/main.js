var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import GeneralResponse from "../models/dtos/general-response.dto.js";
import SessionService from "../services/session.js";
import UsuarioService from "../services/usuario.js";
const formElement = document.getElementById('formLogin');
const emailElement = document.getElementById('email');
const passwordElement = document.getElementById('password');
const submitButton = document.getElementById('submitButton');
const validarForm = () => {
    if (!formElement.checkValidity()) {
        submitButton.disabled = true;
    }
    else {
        submitButton.disabled = false;
    }
};
const usuarioSrv = new UsuarioService();
const sessionSrv = new SessionService();
emailElement.value = '';
passwordElement.value = '';
validarForm();
formElement === null || formElement === void 0 ? void 0 : formElement.addEventListener('input', validarForm);
formElement === null || formElement === void 0 ? void 0 : formElement.addEventListener('submit', (event) => __awaiter(void 0, void 0, void 0, function* () {
    event.preventDefault();
    if (!formElement.checkValidity()) {
        return;
    }
    const email = emailElement === null || emailElement === void 0 ? void 0 : emailElement.value.trim();
    const password = passwordElement === null || passwordElement === void 0 ? void 0 : passwordElement.value;
    try {
        const loginRsp = yield usuarioSrv.login(email, password);
        let generalRsp = new GeneralResponse(loginRsp.data, loginRsp.tieneError, loginRsp.mensaje);
        if (generalRsp.tieneError) {
            alert(loginRsp.mensaje);
            return;
        }
    }
    catch (error) {
        alert(error);
    }
}));

class GeneralResponse {
    constructor(tieneError = false, mensaje = '', data = null) {
        this.tieneError = tieneError;
        this.mensaje = mensaje;
        this.data = data;
    }
}

export default GeneralResponse;
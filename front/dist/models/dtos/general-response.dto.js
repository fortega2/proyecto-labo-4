class GeneralResponse {
    constructor(data, tieneError = false, mensaje = '') {
        this.data = data;
        this.tieneError = tieneError;
        this.mensaje = mensaje;
    }
}
export default GeneralResponse;

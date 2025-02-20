class GeneralResponse<T> {
    public data: T;
    public tieneError: boolean;
    public mensaje: string;

    constructor(data: T, tieneError = false, mensaje = '') {
        this.data = data;
        this.tieneError = tieneError;
        this.mensaje = mensaje;
    }
}

export default GeneralResponse;

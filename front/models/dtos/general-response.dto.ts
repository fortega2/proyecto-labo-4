class GeneralResponse<T> {
    public data: T | null;
    public tieneError: boolean;
    public mensaje: string;

    constructor(data: T | null, tieneError = false, mensaje = '') {
        this.data = data;
        this.tieneError = tieneError;
        this.mensaje = mensaje;
    }
}

export default GeneralResponse;

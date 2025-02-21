class Usuario {
    public id: number | null;
    public nombre: string;
    public apellido: string;
    public password: string;
    public dni: number;
    public celular: number | null;
    public email: string;
    public idPerfil: number;
    public fechaAlta: string;
    public fechaModificacion: string | null;
    public usuarioModificacion: number | null;

    constructor() {
        this.id = null;
        this.nombre = '';
        this.apellido = '';
        this.password = '';
        this.dni = 0;
        this.celular = 0;
        this.email = '';
        this.idPerfil = 0;
        this.fechaAlta = '';
        this.fechaModificacion = '';
        this.usuarioModificacion = 0;
    }
}

export default Usuario;
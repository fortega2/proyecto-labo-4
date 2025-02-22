import BaseEntity from "./base-entity.model.js";

class Usuario extends BaseEntity {
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
        super(null);
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
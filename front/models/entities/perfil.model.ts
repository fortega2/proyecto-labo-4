import BaseEntity from "./base-entity.model.js";

class Perfil extends BaseEntity {
    public descripcion: string;
    public fechaCreacion: string;

    constructor(id: number, descripcion: string, fechaCreacion: string) {
        super(id);
        this.descripcion = descripcion;
        this.fechaCreacion = fechaCreacion;
    }
}

export default Perfil;

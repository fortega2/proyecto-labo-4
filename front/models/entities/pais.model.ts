import BaseEntity from "./base-entity.model";

class Pais extends BaseEntity {
    public descripcion: string;
    public codigo: string;

    constructor(id: number, descripcion: string, codigo: string) {
        super(id);
        this.descripcion = descripcion;
        this.codigo = codigo;
    }
}

export default Pais;

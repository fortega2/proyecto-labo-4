import BaseEntity from "./base-entity.model.js";

class Ciudad extends BaseEntity {
    public nombre: string;
    public idPais: number;
    public codigo: string;

    constructor(id: number, nombre: string, idPais: number, codigo: string) {
        super(id);
        this.nombre = nombre;
        this.idPais = idPais;
        this.codigo = codigo;
    }
}

export default Ciudad;

<?php
class Ciudad {
    public int $id;
    public string $nombre;
    public int $idPais;
    public string $codigo;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->nombre = $data['nombre'];
        $this->idPais = $data['idPais'];
        $this->codigo = $data['codigo'];
    }
}

<?php
class Pais {
    public int $id;
    public string $descripcion;
    public string $codigo;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->descripcion = $data['descripcion'];
        $this->codigo = $data['codigo'];
    }
}

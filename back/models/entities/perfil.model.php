<?php
namespace Models\Entities;

class Perfil {
    public int $id;
    public string $descripcion;
    public string $fechaCreacion;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->descripcion = $data['descripcion'];
        $this->fechaCreacion = $data['fechaCreacion'];
    }
}

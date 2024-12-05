<?php
class Usuario {
    public int | null $id;
    public string $nombre;
    public string $apellido;
    public string $password;
    public int $dni;
    public int | null $celular;
    public string $email;
    public int $idPerfil;
    public string $fechaAlta;
    public string | null $fechaModificacion;
    public int | null $usuarioModificacion;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->nombre = $data['nombre'];
        $this->apellido = $data['apellido'];
        $this->password = $data['password'];
        $this->dni = $data['dni'];
        $this->celular = $data['celular'];
        $this->email = $data['email'];
        $this->idPerfil = $data['idPerfil'];
        $this->fechaAlta = $data['fechaAlta'];
        $this->fechaModificacion = $data['fechaModificacion'];
        $this->usuarioModificacion = $data['usuarioModificacion'];
    }
}

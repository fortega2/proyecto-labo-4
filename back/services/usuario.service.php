<?php
require_once __DIR__ . '/database.service.php';
require_once __DIR__ . '/../interfaces/crud.interface.php';
require_once __DIR__ . '/../interfaces/data-access.interface.php';
require_once __DIR__ . '/../models/entities/usuario.model.php';

class UsuarioService implements CRUD, DataAccess {
    private DataBaseService $dateBaseService;

    public function __construct() {
        $this->dateBaseService = DataBaseService::getInstance();
    }

    public function loginUsuario(string $email, string $password) {
        $query = "SELECT
                    id,
                    nombre,
                    apellido,
                    password,
                    dni,
                    celular,
                    email,
                    id_perfil AS idPerfil,
                    fecha_alta AS fechaAlta,
                    fecha_modificacion AS fechaModificacion,
                    usuario_modificacion AS usuarioModificacion
                FROM
                    usuarios
                WHERE
                    email = ?";
        $types = "s";
        $params = [$email];

        $resultData = $this->dateBaseService->executeQuery($query, $types, $params);

        if ($resultData != null) {
            $usuario = new Usuario($resultData);
            if (password_verify($password, $usuario->password)) {
                $usuario->password = "";
                return $usuario;
            }
        }

        return null;
    }

    public function getById(int $id) {
        $query = "SELECT
                    id,
                    nombre,
                    apellido,
                    password,
                    dni,
                    celular,
                    email,
                    id_perfil AS idPerfil,
                    fecha_alta AS fechaAlta,
                    fecha_modificacion AS fechaModificacion,
                    usuario_modificacion AS usuarioModificacion
                FROM
                    usuarios
                WHERE
                    id = ?";
        $types = "i";
        $params = [$id];

        $resultData = $this->dateBaseService->executeQuery($query, $types, $params);

        if ($resultData != null) {
            return new Usuario($resultData);
        }

        return null;
    }

    public function getAll() {
        $query = "SELECT
                    id,
                    nombre,
                    apellido,
                    password,
                    dni,
                    celular,
                    email,
                    id_perfil AS idPerfil,
                    fecha_alta AS fechaAlta,
                    fecha_modificacion AS fechaModificacion,
                    usuario_modificacion AS usuarioModificacion
                FROM
                    usuarios";
        $types = "";
        $params = [];

        $resultData = $this->dateBaseService->executeQueryArray($query, $types, $params);

        if ($resultData != null) {
            $usuarios = [];
            foreach ($resultData as $data) {
                $usuario = new Usuario($data);
                array_push($usuarios, $usuario);
            }
    
            return $usuarios;
        }

        return null;
    }
    
    public function insert(object $object) {
        $query = "INSERT INTO usuarios
                    (id, nombre, apellido, password, dni, celular, email, id_perfil, fecha_alta)
                VALUES
                    (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
        $types = "sssiisis";

        $hashedPassword = password_hash($object->password, PASSWORD_DEFAULT);

        $params = [
            $object->nombre,
            $object->apellido,
            $hashedPassword,
            $object->dni,
            $object->celular,
            $object->email,
            $object->idPerfil,
            $object->fechaAlta,
        ];

        return $this->dateBaseService->executeCrud($query, $types, $params);
    }

    public function update(object $object) {
        $query = "UPDATE usuarios
                SET
                    nombre = ?,
                    apellido = ?,
                    dni = ?,
                    celular = ?,
                    email = ?,
                    id_perfil = ?,
                    fecha_modificacion = ?,
                    usuario_modificacion = ?
                WHERE
                    id = ?";
    $types = "ssiisisii";

    $params = [
        $object->nombre,
        $object->apellido,
        $object->dni,
        $object->celular,
        $object->email,
        $object->idPerfil,
        $object->fechaModificacion,
        $object->usuarioModificacion,
        $object->id
    ];

        return $this->dateBaseService->executeCrud($query, $types, $params);
    }

    public function delete(int $id) {
        $query = "DELETE FROM usuarios WHERE id = ?";
        $types = "i";
        $params = [$id];

        return $this->dateBaseService->executeCrud($query, $types, $params);
    }
}

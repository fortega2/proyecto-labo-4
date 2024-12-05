<?php
require_once __DIR__ . '/database.service.php';
require_once __DIR__ . '/../interfaces/crud.interface.php';
require_once __DIR__ . '/../interfaces/data-access.interface.php';
require_once __DIR__ . '/../models/entities/perfil.model.php';

class PerfilService implements CRUD, DataAccess {
    private DataBaseService $dateBaseService;

    public function __construct() {
        $this->dateBaseService = DataBaseService::getInstance();
    }

    public function getById(int $id) {
        $query = "SELECT id, descripcion, fecha_creacion AS fechaCreacion FROM perfiles WHERE id = ?";
        $types = "i";
        $params = [$id];

        $resultData = $this->dateBaseService->executeQuery($query, $types, $params);

        if ($resultData != null) {
            return new Perfil($resultData);
        }

        return null;
    }

    public function getAll() {
        $query = "SELECT id, descripcion, fecha_creacion AS fechaCreacion FROM perfiles";
        $types = "";
        $params = [];

        $resultData = $this->dateBaseService->executeQueryArray($query, $types, $params);

        if ($resultData != null) {
            $perfiles = [];
            foreach ($resultData as $data) {
                $perfil = new Perfil($data);
                array_push($perfiles, $perfil);
            }
    
            return $perfiles;
        }

        return null;
    }

    public function insert(object $object) {
        $query = "INSERT INTO perfiles (descripcion, fecha_creacion) VALUES (?, ?)";
        $types = "ss";
        $params = [$object->descripcion, $object->fechaCreacion];

        return $this->dateBaseService->executeCrud($query, $types, $params);
    }

    public function update(object $object) {
        $query = "UPDATE perfiles SET descripcion = ?, fecha_creacion = ? WHERE id = ?";
        $types = "ssi";
        $params = [$object->descripcion, $object->fechaCreacion, $object->id];

        return $this->dateBaseService->executeCrud($query, $types, $params);
    }

    public function delete(int $id) {
        $query = "DELETE FROM perfiles WHERE id = ?";
        $types = "i";
        $params = [$id];

        return $this->dateBaseService->executeCrud($query, $types, $params);
    }
}

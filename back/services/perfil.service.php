<?php
// Imports
require_once __DIR__ . '/database.service.php';
require_once __DIR__ . '/../interfaces/crud.interface.php';
require_once __DIR__ . '/../models/entities/perfil.model.php';

class PerfilService implements CRUD {
    private DataBaseService $_dateBaseService;

    public function __construct() {
        $this->_dateBaseService = DataBaseService::getInstance();
    }

    public function getById(int $id) {
        $query = "SELECT id, descripcion, fecha_creacion AS fechaCreacion FROM perfiles WHERE id = ?";
        $types = "i";
        $params = [$id];

        $resultData = $this->_dateBaseService->executeQuerySelect($query, $types, $params);

        if ($resultData !== null) {
            $perfil = new Perfil($resultData);
            return $perfil;
        }

        return null;
    }

    public function getAll() {
        // TODO
    }

    public function insert(object $object) {
        // TODO
    }

    public function update(object $object) {
        // TODO
    }

    public function delete(int $id) {
        // TODO
    }
}
?>
<?php
require_once __DIR__ . '/database.service.php';
require_once __DIR__ . '/../interfaces/data-access.interface.php';
require_once __DIR__ . '/../models/entities/ciudad.model.php';

class CiudadService implements DataAccessCode {
    private DataBaseService $dateBaseService;

    public function __construct() {
        $this->dateBaseService = DataBaseService::getInstance();
    }

    public function getById($id) {
        $query = "SELECT id, nombre, id_pais AS idPais, codigo FROM ciudades WHERE id = ?";
        $types = "i";
        $params = [$id];

        $resultData = $this->dateBaseService->executeQuery($query, $types, $params);

        if ($resultData != null) {
            return new Ciudad($resultData);
        }

        return null;
    }
    
    public function getByCode($codigo) {
        $query = "SELECT id, nombre, id_pais AS idPais, codigo FROM ciudades WHERE codigo = ?";
        $types = "s";
        $params = [$codigo];

        $resultData = $this->dateBaseService->executeQuery($query, $types, $params);

        if ($resultData != null) {
            return new Ciudad($resultData);
        }

        return null;
    }

    public function getAll() {
        $query = "SELECT id, nombre, id_pais AS idPais, codigo FROM ciudades";
        $types = "";
        $params = [];

        $resultData = $this->dateBaseService->executeQueryArray($query, $types, $params);

        if ($resultData != null) {
            $ciudades = [];
            foreach ($resultData as $data) {
                $ciudad = new Ciudad($data);
                array_push($ciudades, $ciudad);
            }
            return $ciudades;
        }

        return null;
    }
}

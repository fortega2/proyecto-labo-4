<?php
namespace Services;

use Services\DataBaseService;
use Interfaces\DataAccessCode;
use Models\Entities\Pais;

class PaisService implements DataAccessCode {
    private DataBaseService $dateBaseService;

    public function __construct() {
        $this->dateBaseService = DataBaseService::getInstance();
    }

    public function getById($id) {
        $query = "SELECT id, descripcion, codigo FROM paises WHERE id = ?";
        $types = "i";
        $params = [$id];

        $resultData = $this->dateBaseService->executeQuery($query, $types, $params);

        if ($resultData != null) {
            return new Pais($resultData);
        }

        return null;
    }

    public function getByCode($codigo) {
        $query = "SELECT id, descripcion, codigo FROM paises WHERE codigo = ?";
        $types = "s";
        $params = [$codigo];

        $resultData = $this->dateBaseService->executeQuery($query, $types, $params);

        if ($resultData != null) {
            return new Pais($resultData);
        }

        return null;
    }

    public function getAll() {
        $query = "SELECT id, descripcion, codigo FROM paises";
        $types = "";
        $params = [];

        $resultData = $this->dateBaseService->executeQueryArray($query, $types, $params);

        if ($resultData != null) {
            $paises = [];
            foreach ($resultData as $data) {
                $pais = new Pais($data);
                array_push($paises, $pais);
            }
            return $paises;
        }

        return null;
    }
}

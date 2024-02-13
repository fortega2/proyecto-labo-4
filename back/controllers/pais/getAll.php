<?php
require_once __DIR__ . '/../../models/entities/pais.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/pais.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

try {
    $paisService = new PaisService();
    $pais = $paisService->getAll();

    $response->tieneError = false;
    $response->resultado = $pais;

    if ($pais == null) {
        $response->mensaje = "No se encontraron paises";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;
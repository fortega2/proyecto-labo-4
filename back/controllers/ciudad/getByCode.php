<?php
require_once __DIR__ . '/../../models/entities/ciudad.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/ciudad.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

if (!isset($_GET['codigo'])) {
    $response->tieneError = true;
    $response->mensaje = "El id es requerido";
    $json = json_encode($response);
    echo $json;
    return;
}

$code = $_GET['codigo'];

try {
    $ciudadService = new CiudadService();
    $pais = $ciudadService->getByCode($code);

    $response->tieneError = false;
    $response->resultado = $pais;

    if ($pais == null) {
        $response->mensaje = "No se encontró la ciudad";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

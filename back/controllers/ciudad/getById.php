<?php
require_once __DIR__ . '/../../models/entities/ciudad.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/ciudad.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

if (!isset($_GET['id'])) {
    $response->tieneError = true;
    $response->mensaje = "El id es requerido";
    $json = json_encode($response);
    echo $json;
    return;
}

$id = $_GET['id'];

try {
    $ciudadService = new CiudadService();
    $pais = $ciudadService->getById($id);

    $response->tieneError = false;
    $response->data = $pais;

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

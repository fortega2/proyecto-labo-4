<?php
use Services\PaisService;
use Models\DTOs\Response\GeneralResponse;

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
    $paisService = new PaisService();
    $pais = $paisService->getById($id);

    $response->tieneError = false;
    $response->resultado = $pais;

    if ($pais == null) {
        $response->mensaje = "No se encontró el país";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

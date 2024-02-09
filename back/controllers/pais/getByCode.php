<?php
require_once __DIR__ . '/../../models/entities/pais.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/pais.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

if (!isset($_GET['codigo'])) {
    $response->tieneError = true;
    $response->mensaje = "El id es requerido";
    $json = json_encode($response);
    echo $json;
    return;
}

$codigo = $_GET['codigo'];

try {
    $paisService = new PaisService();
    $pais = $paisService->getByCode($codigo);

    $response->tieneError = false;
    $response->resultado = $pais;

    if ($pais == null) 
        $response->mensaje = "No se encontró el país";
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;
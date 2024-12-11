<?php
require_once __DIR__ . '/../../models/entities/perfil.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/perfil.service.php';

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
    $perfilService = new PerfilService();
    $perfil = $perfilService->getById($id);

    $response->tieneError = false;
    $response->data = $perfil;

    if ($perfil == null) {
        $response->mensaje = "No se encontró el perfil";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

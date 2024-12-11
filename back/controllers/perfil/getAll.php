<?php
require_once __DIR__ . '/../../models/entities/perfil.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/perfil.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

try {
    $perfilService = new PerfilService();
    $perfiles = $perfilService->getAll();

    $response->tieneError = false;
    $response->data = $perfiles;

    if ($perfiles == null) {
        $response->mensaje = "No se encontraron perfiles";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

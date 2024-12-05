<?php
use Services\PerfilService;
use Models\DTOs\Response\GeneralResponse;

header('Content-Type: application/json');

$response = new GeneralResponse();

try {
    $perfilService = new PerfilService();
    $perfiles = $perfilService->getAll();

    $response->tieneError = false;
    $response->resultado = $perfiles;

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

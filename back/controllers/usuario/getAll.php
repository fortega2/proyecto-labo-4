<?php
require_once __DIR__ . '/../../models/entities/usuario.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/usuario.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

try {
    $usuarioService = new UsuarioService();
    $usuarios = $usuarioService->getAll();

    $response->tieneError = false;
    $response->data = $usuarios;

    if ($usuarios == null) {
        $response->mensaje = "No se encontró ningún usuario";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

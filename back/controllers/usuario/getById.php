<?php
require_once __DIR__ . '/../../models/entities/usuario.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/usuario.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

if (!isset($_GET['id'])) {
    $response->tieneError = true;
    $response->mensaje = "Es requerido el ID para buscar un usuario";
    $json = json_encode($response);
    echo $json;
    return;
}

$id = $_GET['id'];

try {
    $usuarioService = new UsuarioService();
    $usuario = $usuarioService->getById($id);

    $response->tieneError = false;
    $response->data = $usuario;

    if ($usuario == null) {
        $response->mensaje = "No se encontró el usuario";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

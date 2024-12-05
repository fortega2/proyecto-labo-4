<?php
use Services\UsuarioService;
use Models\DTOs\Response\GeneralResponse;

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
    $response->resultado = $usuario;

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

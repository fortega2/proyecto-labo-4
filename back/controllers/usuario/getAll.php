<?php
use Services\UsuarioService;
use Models\DTOs\Response\GeneralResponse;

header('Content-Type: application/json');

$response = new GeneralResponse();

try {
    $usuarioService = new UsuarioService();
    $usuarios = $usuarioService->getAll();

    $response->tieneError = false;
    $response->resultado = $usuarios;

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

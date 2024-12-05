<?php
use Services\UsuarioService;
use Models\DTOs\Response\GeneralResponse;

header('Content-Type: application/json');

$response = new GeneralResponse();

if (!isset($_GET['email'])) {
    $response->tieneError = true;
    $response->mensaje = "Es requerido el email para buscar un usuario";
    $json = json_encode($response);
    echo $json;
    return;
}

if (!isset($_GET['password'])) {
    $response->tieneError = true;
    $response->mensaje = "Es requerida la contraseña para buscar un usuario";
    $json = json_encode($response);
    echo $json;
    return;
}

$email = $_GET['email'];
$password = $_GET['password'];

try {
    $usuarioService = new UsuarioService();
    $usuario = $usuarioService->loginUsuario($email, $password);

    $response->tieneError = false;
    $response->resultado = $usuario;

    if ($usuario == null) {
        $response->mensaje = "No se encontró el usuario. El email o la contraseña son incorrectos.";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

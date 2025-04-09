<?php
require_once __DIR__ . '/../../models/entities/usuario.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/usuario.service.php';
require_once __DIR__ . '/../../services/session.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

if (!isset($_GET['email'])) {
    $response->tieneError = true;
    $response->mensaje = "Es requerido el email para buscar un usuario";
    echo json_encode($response);
    http_response_code(400);
    return;
}

if (!isset($_GET['password'])) {
    $response->tieneError = true;
    $response->mensaje = "Es requerida la contraseña para buscar un usuario";
    echo json_encode($response);
    http_response_code(400);
    return;
}

$email = $_GET['email'];
$password = $_GET['password'];

try {
    $usuarioService = new UsuarioService();
    $usuario = $usuarioService->loginUsuario($email, $password);

    $response->tieneError = false;
    $response->data = $usuario;

    if ($usuario == null) {
        $response->tieneError = true;
        $response->mensaje = "No se encontró el usuario. El email o la contraseña son incorrectos.";
        http_response_code(404);
    } else {
        $usuario->password = '';
        $sessionSrv = SessionService::getInstance();
        if (!$sessionSrv->isSessionStarted()) {
            $sessionSrv->startSession();
            $sessionSrv->setSessionDataByKey('usuario', json_encode($usuario));
        } else {
            $sessionSrv->unsetAllSessionData();
            $sessionSrv->setSessionDataByKey('usuario', json_encode($usuario));
        }
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}


echo json_encode($response);

<?php
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/session.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();
$sessionSrv = SessionService::getInstance();

if (!isset($_GET['key'])) {
    $response->tieneError = true;
    $response->mensaje = "Es requerida la clave de la sesión para buscar un dato";
    http_response_code(400);
    echo json_encode($response);
    return;
}

$sessionKey = $_GET['key'];

try {
    if (!$sessionSrv->isSessionStarted()) {
        $sessionSrv->startSession();
    }

    $response->data = $sessionSrv->getSessionDataByKey($sessionKey);

    if ($response->data == null) {
        $response->tieneError = true;
        $response->mensaje = "No se encontró el dato en la sesión";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

echo json_encode($response);

<?php
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/session.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();
$sessionSrv = SessionService::getInstance();

try {
    if (!$sessionSrv->isSessionStarted()) {
        $response->data = true;
        $response->mensaje = "La sesión ya está cerrada";
        echo json_encode($response);
        return;
    }

    $sessionSrv->unsetAllSessionData();
    $response->data = $sessionSrv->closeSession();
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

echo json_encode($response);

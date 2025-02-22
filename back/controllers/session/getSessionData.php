<?php
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/session.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();
$sessionSrv = SessionService::getInstance();

try {
    if (!$sessionSrv->isSessionStarted()) {
        $sessionSrv->startSession();
    }

    $response->data = $sessionSrv->getSessionData();
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

echo json_encode($response);

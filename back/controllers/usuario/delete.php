<?php
require_once __DIR__ . '/../../models/entities/usuario.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/usuario.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

if (!isset($_GET['id'])) {
    $response->tieneError = true;
    $response->mensaje = "Se requiere el id para eliminar el usuario";
    $json = json_encode($response);
    echo $json;
    return;
}

$id = $_GET['id'];

try {
    $usuarioService = new UsuarioService();
    $rowsAffected = $usuarioService->delete($id);

    $response->tieneError = false;
    $response->data = $rowsAffected;

    if ($rowsAffected == 0) {
        $response->mensaje = "No se pudo eliminar el usuario " . $id;
    } else {
        $response->mensaje = "El usuario con ID " . $id . " se eliminó exitosamente";
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

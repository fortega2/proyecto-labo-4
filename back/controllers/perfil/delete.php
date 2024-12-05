<?php
use Services\PerfilService;
use Models\DTOs\Response\GeneralResponse;

header('Content-Type: application/json');

$response = new GeneralResponse();

if (!isset($_GET['id'])) {
    $response->tieneError = true;
    $response->mensaje = "El id es requerido";
    $json = json_encode($response);
    echo $json;
    return;
}

$id = $_GET['id'];

try {
    $perfilService = new PerfilService();
    $rowsAffected = $perfilService->delete($id);

    $response->tieneError = false;
    $response->resultado = $rowsAffected;

    if ($rowsAffected == 0) {
        $response->mensaje = "No se pudo eliminar el perfil " . $id;
    } else {
        $response->mensaje = "El perfil " . $id . " se eliminó exitosamente";
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

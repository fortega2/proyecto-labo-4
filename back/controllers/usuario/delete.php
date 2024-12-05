<?php
use Services\UsuarioService;
use Models\DTOs\Response\GeneralResponse;

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
    $response->resultado = $rowsAffected;

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

<?php
require_once __DIR__ . '/../../models/entities/perfil.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/perfil.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

// Obtener datos del body
$datosBody = json_decode(file_get_contents('php://input'), true);

if (!isset($datosBody['id'])) {
    $response->tieneError = true;
    $response->mensaje = "El ID es requerido";
    $json = json_encode($response);
    echo $json;
    return;
}

if (!isset($datosBody['descripcion'])) {
    $response->tieneError = true;
    $response->mensaje = "La descripción es requerida";
    $json = json_encode($response);
    echo $json;
    return;
}

if (!isset($datosBody['fechaCreacion'])) {
    $response->tieneError = true;
    $response->mensaje = "La fecha de creación es requerida";
    $json = json_encode($response);
    echo $json;
    return;
}

$id = $datosBody['id'];
$descripcion = $datosBody['descripcion'];
$fechaCreacion = $datosBody['fechaCreacion'];

$perfil = new Perfil(
    [
        "id" => $id,
        "descripcion" => $descripcion,
        "fechaCreacion" => $fechaCreacion
    ]
);

try {
    $perfilService = new PerfilService();
    $rowsAffected = $perfilService->update($perfil);

    $response->tieneError = false;
    $response->resultado = $rowsAffected;

    if ($rowsAffected == 0) 
        $response->mensaje = "No se pudo modificar el perfil " . $perfil->id . " " . $perfil->descripcion;
    else
        $response->mensaje = "El perfil " . $perfil->id . " se modificó exitosamente";
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;
?>
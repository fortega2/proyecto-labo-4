<?php
use Services\PerfilService;
use Models\Entities\Perfil;
use Models\DTOs\Response\GeneralResponse;

header('Content-Type: application/json');

$response = new GeneralResponse();

// Obtener datos del body
$datosBody = json_decode(file_get_contents('php://input'), true);

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

$descripcion = $datosBody['descripcion'];
$fechaCreacion = $datosBody['fechaCreacion'];

$perfil = new Perfil(
    [
        "id" => -1,
        "descripcion" => $descripcion,
        "fechaCreacion" => $fechaCreacion
    ]
);

try {
    $perfilService = new PerfilService();
    $rowsAffected = $perfilService->insert($perfil);

    $response->tieneError = false;
    $response->resultado = $rowsAffected;

    if ($rowsAffected == 0) {
        $response->mensaje = "No se pudo crear el perfil " . $perfil->id . " " . $perfil->descripcion;
    } else {
        $response->mensaje = "Perfil creado exitosamente";
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

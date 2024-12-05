<?php
use Services\PaisService;
use Models\DTOs\Response\GeneralResponse;

header('Content-Type: application/json');

$response = new GeneralResponse();

try {
    $paisService = new PaisService();
    $pais = $paisService->getAll();

    $response->tieneError = false;
    $response->resultado = $pais;

    if ($pais == null) {
        $response->mensaje = "No se encontraron paises";
        http_response_code(404);
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

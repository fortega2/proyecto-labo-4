<?php
require_once __DIR__ . '/../../models/entities/usuario.model.php';
require_once __DIR__ . '/../../models/dtos/response/general-response.model.php';
require_once __DIR__ . '/../../services/usuario.service.php';

header('Content-Type: application/json');

$response = new GeneralResponse();

$datosBody = json_decode(file_get_contents('php://input'), true);

if (!isset($datosBody['nombre'])) {
    $response->tieneError = true;
    $response->mensaje = "El nombre es requerido";
    $json = json_encode($response);
    echo $json;
    return;
}

if (!isset($datosBody['apellido'])) {
    $response->tieneError = true;
    $response->mensaje = "El apellido es requerido";
    $json = json_encode($response);
    echo $json;
    return;
}

if (!isset($datosBody['password'])) {
    $response->tieneError = true;
    $response->mensaje = "La contraseña es requerida";
    $json = json_encode($response);
    echo $json;
    return;
}

if (!isset($datosBody['dni'])) {
    $response->tieneError = true;
    $response->mensaje = "El DNI es requerido";
    $json = json_encode($response);
    echo $json;
    return;
}

if (!isset($datosBody['email'])) {
    $response->tieneError = true;
    $response->mensaje = "El email es requerido";
    $json = json_encode($response);
    echo $json;
    return;
}

$nombre = $datosBody['nombre'];
$apellido = $datosBody['apellido'];
$password = $datosBody['password'];
$dni = $datosBody['dni'];
$email = $datosBody['email'];
$idPerfil = 2;
$celular;

if (isset($datosBody['celular'])) {
    $celular = $datosBody['celular'];
} else {
    $celular = null;
}

$usuario = new Usuario(
    [
        "id" => null,
        "nombre" => $nombre,
        "apellido" => $apellido,
        "password" => $password,
        "dni" => $dni,
        "celular" => $celular,
        "email" => $email,
        "idPerfil" => $idPerfil,
        "fechaAlta" => date('Y-m-d H:i:s'),
        "fechaModificacion" => null,
        "usuarioModificacion" => null
    ]
);

try {
    $usuarioService = new UsuarioService();
    $rowsAffected = $usuarioService->insert($usuario);

    $response->tieneError = false;
    $response->resultado = $rowsAffected;

    if ($rowsAffected == 0) {
        $response->tieneError = true;
        $response->mensaje = "No se pudo crear el usuario " . $usuario->nombre . " " . $usuario->apellido;
        http_response_code(400);
    } else {
        $response->mensaje = "Usuario creado exitosamente";
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

echo json_encode($response);

<?php
use Services\UsuarioService;
use Models\Entities\Usuario;
use Models\DTOs\Response\GeneralResponse;

header('Content-Type: application/json');

$response = new GeneralResponse();

$datosBody = json_decode(file_get_contents('php://input'), true);

$id = $datosBody['id'];
$nombre = $datosBody['nombre'];
$apellido = $datosBody['apellido'];
$dni = $datosBody['dni'];
$celular = $datosBody['celular'];
$email = $datosBody['email'];
$idPerfil = $datosBody['idPerfil'];
$idPais = $datosBody['idPais'];
$idCiudad = $datosBody['idCiudad'];
$usuarioModificacion = $datosBody['usuarioModificacion'];

$usuario = new Usuario([
    "id" => $id,
    "nombre" => $nombre,
    "apellido" => $apellido,
    "password" => "",
    "dni" => $dni,
    "celular" => $celular,
    "email" => $email,
    "idPerfil" => $idPerfil,
    "idPais" => $idPais,
    "idCiudad" => $idCiudad,
    "fechaAlta" => "",
    "fechaModificacion" => date('Y-m-d H:i:s'),
    "usuarioModificacion" => $usuarioModificacion
]);

try {
    $usuarioService = new UsuarioService();
    $rowsAffected = $usuarioService->update($usuario);

    $response->tieneError = false;
    $response->resultado = $rowsAffected;

    if ($rowsAffected == 0) {
        $response->mensaje = "No se pudo actualizar el usuario " . $usuario->nombre . " " . $usuario->apellido;
        http_response_code(404);
    } else {
        $response->mensaje = "Usuario actualizado exitosamente";
    }
} catch (Exception $e) {
    $response->tieneError = true;
    $response->mensaje = $e->getMessage();
}

$json = json_encode($response);
echo $json;

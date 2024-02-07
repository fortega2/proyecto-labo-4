<?php
class GeneralResponse {
    // Campos de la clase con anotaciones de tipo
    public bool $tieneError;
    public string $mensaje;
    public $resultado; // Tipo de dato genérico

    // Constructor de la clase con anotaciones de tipo y valores predeterminados
    public function __construct(bool $tieneError = false, string $mensaje = "", $resultado = null) {
        $this->tieneError = $tieneError;
        $this->mensaje = $mensaje;
        $this->resultado = $resultado;
    }
}
?>
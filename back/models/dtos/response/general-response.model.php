<?php
class GeneralResponse {
    public bool $tieneError;
    public string $mensaje;
    public $resultado;

    public function __construct(bool $tieneError = false, string $mensaje = "", $resultado = null) {
        $this->tieneError = $tieneError;
        $this->mensaje = $mensaje;
        $this->resultado = $resultado;
    }
}

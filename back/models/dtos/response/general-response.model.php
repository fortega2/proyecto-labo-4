<?php
class GeneralResponse {
    public bool $tieneError;
    public string $mensaje;
    public mixed $data;

    public function __construct(bool $tieneError = false, string $mensaje = "", $data = null) {
        $this->tieneError = $tieneError;
        $this->mensaje = $mensaje;
        $this->data = $data;
    }
}

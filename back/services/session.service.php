<?php
class SessionService {
    /**
     * @var SessionService $instance Instancia única de la clase SessionService.
     */
    private static SessionService $instance;

    // Constructor privado para evitar la creación de instancias.
    private function __construct() {}

    /**
     * Método para obtener una instancia única de la clase.
     * Si no existe la instancia, se crea una nueva.
     * Si ya existe, se retorna la instancia existente.
     *
     * @return SessionService La instancia única de la clase.
    */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Inicia una sesión.
     *
     * @return void
    */
    public function startSession() {
        session_start();
    }

    /**
     * Cierra una sesión.
     *
     * @return void
    */
    public function closeSession() {
        session_destroy();
    }

    /**
     * Verifica si una sesión está iniciada.
     *
     * @return bool True si la sesión está iniciada, false en caso contrario.
    */
    public function isSessionStarted() {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    /**
     * Obtiene los datos de la sesión.
     *
     * @return array Los datos de la sesión.
    */
    public function getSessionData() {
        return $_SESSION;
    }

    /**
     * Establece los datos de la sesión.
     *
     * @param array $data Los datos de la sesión.
     * @return void
    */
    public function setSessionData(array $data) {
        $_SESSION = $data;
    }

    /**
     * Obtiene un dato de la sesión.
     *
     * @param string $key La clave del dato a obtener.
     * @return mixed El dato de la sesión.
    */
    public function getSessionDataByKey(string $key) {
        return $_SESSION[$key];
    }

    /**
     * Establece un dato de la sesión.
     *
     * @param string $key La clave del dato a establecer.
     * @param mixed $value El valor del dato a establecer.
     * @return void
    */
    public function setSessionDataByKey(string $key, mixed $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Elimina un dato de la sesión.
     *
     * @param string $
     * @return void
    */
    public function unsetSessionDataByKey(string $key) {
        unset($_SESSION[$key]);
    }

    /**
     * Elimina todos los datos de la sesión.
     *
     * @return void
    */
    public function unsetAllSessionData() {
        session_unset();
    }

    /**
     * Verifica si un dato existe en la sesión.
     *
     * @param string $key La clave del dato a verificar.
     * @return bool True si el dato existe, false en caso contrario.
    */
    public function isSessionDataKeySet(string $key) {
        return isset($_SESSION[$key]);
    }

    /**
     * Obtiene el ID de la sesión.
     *
     * @return string El ID de la sesión.
    */
    public function getSessionId() {
        return session_id();
    }

    /**
     * Establece el ID de la sesión.
     *
     * @param string $id El ID de la sesión.
     * @return void
    */
    public function setSessionId(string $id) {
        session_id($id);
    }

    /**
     * Regenera el ID de la sesión.
     *
     * @return void
    */
    public function regenerateSessionId() {
        session_regenerate_id();
    }

    /**
     * Establece un tiempo de vida para la sesión.
     *
     * @param int $lifetime El tiempo de vida de la sesión en segundos.
     * @return void
    */
    public function setSessionLifetime(int $lifetime) {
        session_set_cookie_params($lifetime);
    }
}

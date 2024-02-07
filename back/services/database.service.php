<?php
class DataBaseService {
    private string $host = "b5oonaccrh45cpi3gevs-mysql.services.clever-cloud.com";
    private string $database = "b5oonaccrh45cpi3gevs";
    private string $user = "ugjhggs4vvwnlhjj";
    private string $password = "EvxLgkoFS9Od10ybf3ZN";

    private static DataBaseService $instance;
    private mysqli $connection;

    private function __construct() {}

    /**
     * Método para obtener una instancia única de la clase.
     * Si no existe la instancia, se crea una nueva.
     * Si ya existe, se retorna la instancia existente.
     *
     * @return DataBaseService La instancia única de la clase.
    */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Obtiene la conexión a la base de datos.
     *
     * @return mysqli La conexión a la base de datos.
    */
    public function getDatabseConecction() {
        if (!$this->connection || !$this->connection->ping()) {
            $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);
    
            if ($this->connection->connect_errno) {
                die("Error de conexión: " . $this->connection->connect_errno . " - " . $this->connection->connect_error);
            }
        }

        return $this->connection;
    }

    /**
     * Cierra la conexión a la base de datos si es que está activa.
    */
    public function closeDatabaseConecction() {
        if ($this->connection && $this->connection->ping()) {
            $this->connection->close();
        }
    }
}
?>
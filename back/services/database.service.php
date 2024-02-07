<?php
class DataBaseService {
    private string $host = "b5oonaccrh45cpi3gevs-mysql.services.clever-cloud.com";
    private string $database = "b5oonaccrh45cpi3gevs";
    private string $user = "ugjhggs4vvwnlhjj";
    private string $password = "EvxLgkoFS9Od10ybf3ZN";

    private static DataBaseService $instance;

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
    public function getDatabaseConnection() {
        $connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($connection->connect_errno) {
            die("Error de conexión: " . $connection->connect_errno . " - " . $connection->connect_error);
        }

        return $connection;
    }

    public function executeQuerySelect(string $query, string $types, array $params) {
        $connection = $this->getDatabaseConnection();
        $stmt = $this->prepareStatement($connection, $query, $types, $params);
        $result = $this->executeStatementResult($stmt);
        $data = $this->fetchData($result);
    
        $this->closeResources($stmt, $result, $connection);
    
        return $data;
    }
    
    private function prepareStatement($connection, $query, $types, $params) {
        $stmt = $connection->prepare($query);
    
        if (!$stmt) {
            die('Error al preparar la declaración: ' . $connection->error);
        }
    
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
    
        return $stmt;
    }
    
    private function executeStatementResult($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result) {
            die('Error al obtener el resultado: ' . $stmt->error);
        }
    
        return $result;
    }

    private function executeStatementRowsAffected($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (!$result) {
            die('Error al obtener el resultado: ' . $stmt->error);
        }
        
        $rows = $result->num_rows;
    
        return $rows;
    }
    
    private function fetchData($result) {
        $data = $result->fetch_assoc();
        $result->free();
    
        return $data;
    }
    
    private function closeResources($stmt, $result, $connection) {
        $stmt->close();
        $connection->close();
    }
}
?>
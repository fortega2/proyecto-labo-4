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
     * Ejecuta una consulta SQL y devuelve los resultados un resultado.
     *
     * @param string $query La consulta SQL a ejecutar.
     * @param string $types Los tipos de datos de los parámetros de la consulta.
     * @param array $params Los parámetros de la consulta.
     * @return array El resultado de la consulta como un array asociativo.
    */
    public function executeQuery(string $query, string $types, array $params) {
        $connection = $this->getDatabaseConnection();
        $stmt = $this->prepareStatement($connection, $query, $types, $params);
        $result = $this->executeStatementResult($stmt);
        $data = $this->fetchData($result);
    
        $this->closeResources($stmt, $result, $connection);
    
        return $data;
    }

    /**
     * Ejecuta una consulta SQL y devuelve los resultados como un array asociativo.
     *
     * @param string $query La consulta SQL a ejecutar.
     * @param string $types Los tipos de datos de los parámetros de la consulta.
     * @param array $params Los parámetros de la consulta.
     * @return array Los resultados de la consulta como un array asociativo.
    */
    public function executeQueryArray(string $query, string $types, array $params) {
        $connection = $this->getDatabaseConnection();
        $stmt = $this->prepareStatement($connection, $query, $types, $params);
        $result = $this->executeStatementResult($stmt);
        $data = $this->fetchDataArray($result);

        $this->closeResources($stmt, $result, $connection);

        return $data;
    }

    /**
     * Ejecuta una consulta de inserción, actualización o eliminación en la base de datos.
     *
     * @param string $query La consulta SQL a ejecutar.
     * @param string $types Los tipos de datos de los parámetros de la consulta.
     * @param array $params Los parámetros de la consulta.
     * @return int El número de filas afectadas por la consulta.
    */
    public function executeInsertUpdateOrDelete(string $query, string $types, array $params) {
        $connection = $this->getDatabaseConnection();
        $stmt = $this->prepareStatement($connection, $query, $types, $params);
        $rows = $this->executeStatementRowsAffected($stmt);

        $this->closeResources($stmt, null, $connection);

        return $rows;
    }

    /**
     * Obtiene la conexión a la base de datos.
     *
     * @return mysqli La conexión a la base de datos.
    */
    private function getDatabaseConnection() {
        $connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($connection->connect_errno) {
            die("Error de conexión: " . $connection->connect_errno . " - " . $connection->connect_error);
        }

        return $connection;
    }
    
    /**
     * Prepara una declaración SQL con parámetros y tipos de datos.
     *
     * @param object $connection La conexión a la base de datos.
     * @param string $query La consulta SQL a preparar.
     * @param string $types Los tipos de datos de los parámetros.
     * @param array $params Los valores de los parámetros.
     * @return object La declaración preparada.
    */
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

    /**
     * Ejecuta una declaración preparada y devuelve el resultado.
     *
     * @param object $stmt La declaración preparada.
     * @return object El resultado de la ejecución.
    */
    private function executeStatementResult($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die('Error al obtener el resultado: ' . $stmt->error);
        }

        return $result;
    }

    /**
     * Ejecuta una declaración preparada y devuelve el número de filas afectadas.
     *
     * @param object $stmt La declaración preparada.
     * @return int El número de filas afectadas.
    */
    private function executeStatementRowsAffected($stmt) {
        $stmt->execute();
        $rows = $stmt->affected_rows;
        return $rows;
    }

    /**
     * Obtiene una fila de datos del resultado y libera los recursos.
     *
     * @param object $result El resultado de la ejecución.
     * @return array Los datos de la fila.
    */
    private function fetchData($result) {
        $data = $result->fetch_assoc();
        $result->free();
        return $data;
    }

    /**
     * Obtiene un array de filas de datos del resultado y libera los recursos.
     *
     * @param object $result El resultado de la ejecución.
     * @return array El array de datos.
    */
    private function fetchDataArray($result) {
        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $result->free();
        return $data;
    }

    /**
     * Cierra los recursos utilizados por la declaración, el resultado y la conexión.
     *
     * @param object $stmt La declaración preparada.
     * @param object $result El resultado de la ejecución.
     * @param object $connection La conexión a la base de datos.
     * @return void
    */
    private function closeResources($stmt, $result, $connection) {
        $stmt->close();
        $connection->close();
    }
}
?>
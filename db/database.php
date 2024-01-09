<?php

class Database {

    private $host = 'localhost';
    private $db_name = 'booking';
    private $username = 'root';
    private $password = '';
    private $connection;

    public function getConnection() {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            echo 'La conexion a la base de datos ha sido un exito';
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }

        return $this->connection;
    }

    public function disconnection() {
        $this->connection = null;
    }
}

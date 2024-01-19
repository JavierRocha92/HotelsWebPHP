<?php

class Db {

    private $host = 'localhost';
    private $db_name = 'booking';
    private $username = 'root';
    private $password = '';
    private $connection;

    public function getConnection() {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        } catch (PDOException $e) {
            
        }

        return $this->connection;
    }

    public function disconnection() {
        $this->connection = null;
    }
}

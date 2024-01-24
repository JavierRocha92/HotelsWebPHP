<?php

class Db {

    public function getConnection() {
        require './config/config.php';
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:host=' . $bd_parameters['host'] . ';dbname=' . $bd_parameters['db_name'], $bd_parameters['username'], $bd_parameters['password']);
        } catch (PDOException $e) {
            return array(
                'code' => $e->getCode(),
                'error' => true
            );
        }

        return $this->connection;
    }

    public function disconnection() {
        $this->connection = null;
    }
}

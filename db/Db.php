<?php

class Db {

    /**
     * @var PDO|null The database connection object
     */
    private $connection;

    /**
     * Get a database connection
     *
     * @return PDO|array Returns a PDO database connection or an error array
     */
    public function getConnection() {
        require './config/config.php'; // Include the database configuration

        $this->connection = null;

        try {
            // Create a new PDO instance for the database connection
            $this->connection = new PDO('mysql:host=' . $bd_parameters['host'] . ';dbname=' . $bd_parameters['db_name'], $bd_parameters['username'], $bd_parameters['password']);
            //test message
//            echo 'The connection is good';
        } catch (PDOException $e) {
            // If an exception occurs, return an error array
            return array(
                'code' => $e->getCode(),
                'error' => true
            );
        }

        // Return the database connection
        return $this->connection;
    }

    /**
     * Close the database connection
     */
    public function disconnection() {
        $this->connection = null;
    }
}

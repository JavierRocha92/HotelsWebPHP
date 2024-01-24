<?php

require_once './db/Db.php';
require_once 'objects/Usuario.php';

/**
 * Class to represetn usuario model to fetch information from database
 */
class UsuarioModel {

    /**
     * 
     * @var Database object database to manage interaction to database
     */
    private $db;

    /**
     * 
     * @var PDO PDO object to storage dtabase connection obsject
     */
    private $pdo;

    /**
     * Funtion to construct object
     */
    function __construct() {
        $this->db = new Db();
        $this->pdo = $this->db->getConnection();
    }

    /**
     * Function to fetch all Usuario from database
     * 
     * @return Array[Usuario] or Array with error information
     */
    function getUsuarios() {

        try {
            $sql = 'SELECT * FROM usuarios';
            if (!is_array($this->pdo)) {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
                $allUsers = $stmt->fetchAll();
                $this->bd->disconnection();
                return $allUsers;
            } else {
                return $this->pdo;
            }
        } catch (PDOException $expdo) {
            return array(
                'code' => $expdo->getCode(),
                'error' => true
            );
        } catch (Exception $exc) {
            return array(
                'code' => $exc->getCode(),
                'error' => true
            );
        }
    }

    /**
     * Fucntion to fetch values from usuario seraching by username given as parameter as keyword
     * 
     * @param string $username
     * @return Array[Usuario] or Array with error information
     */
    function isExists($username) {
        try {
            $sql = "SELECT * from usuarios WHERE nombre = ?;";

            if (!is_array($this->pdo)) {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(array($username));
                $exists = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->db->disconnection();
                return $exists;
            } else {
                return $this->pdo;
            }
        } catch (PDOException $expdo) {
            return array(
                'code' => $expdo->getCode(),
                'error' => true
            );
        } catch (Exception $exc) {
            return array(
                'code' => $exc->getCode(),
                'error' => true
            );
        }
    }

    /**
     * Fucntion to get usuario information from database using username and password as keyword
     * 
     * @param string $user
     * @param string $password
     * @return @return Array[Usuario] or Array with error information
     */
    function getUser($user, $password) {
        try {
            $sql = "SELECT * from Usuarios WHERE nombre = ? and contraseña = ?";

            if (!is_array($this->pdo)) {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(array($user, hash('sha256', $password)));
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
                if ($stmt) {
                    $userObject = $stmt->fetch();
                    $this->db->disconnection();
                    return $userObject;
                } else {
                    return false;
                }
            } else {
                return $this->pdo;
            }
        } catch (PDOException $expdo) {
            return array(
                'code' => $expdo->getCode(),
                'error' => true
            );
        } catch (Exception $exc) {
            return array(
                'code' => $exc->getCode(),
                'error' => true
            );
        }
    }
}

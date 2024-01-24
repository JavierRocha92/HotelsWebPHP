<?php

require_once './db/Db.php';
require_once 'objects/Usuario.php';

class UsuarioModel {

    private $db;
    private $pdo;

    function __construct() {
        $this->db = new Db();
        $this->pdo = $this->db->getConnection();
    }

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

    function getUser($user, $password) {
        try {
            $sql = "SELECT * from Usuarios WHERE nombre = ? and contraseña = ?";

            if (!is_array($this->pdo)) {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(array($user, hash('sha256',$password)));
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

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
        $sql = 'SELECT * FROM usuarios';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $allUsers = $stmt->fetchAll();
        $this->bd->disconnection();
        return $allUsers;
    }

    function existsInDb($keyWord, $value, $table) {
        $sql = "SELECT $keyWord from $table WHERE $keyWord = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($value));
        $exists = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->db->disconnection();
        return $stmt;
    }

    function getUser($user, $password) {
        $sql = "SELECT * from Usuarios WHERE nombre = ? and contraseña = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($user, $password));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        if ($stmt) {
            $userObject = $stmt->fetch();
            $this->db->disconnection();
            return $userObject;
        } else {
            return false;
        }
    }
}

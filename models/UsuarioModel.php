<?php
require './db/Database.php';
require 'objects/Usuario.php';

class UsuarioModel {

    private $db;
    private $pdo;

    function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }
    
    function getUsuarios(){
        $sql = 'SELECT * FROM usuarios';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,'Usuario');
        $allUsers = $stmt->fetchAll();
        return $allUsers;
    }
}

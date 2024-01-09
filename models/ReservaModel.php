<?php
require './db/Database.php';
require 'objects/Reserva.php';

class ReservaModel {

    private $db;
    private $pdo;

    function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }
    
    function getReservas(){
        $sql = 'SELECT * FROM reservas';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,'Reserva');
        $allBookings = $stmt->fetchAll();
        return $allBookings;
    }
}

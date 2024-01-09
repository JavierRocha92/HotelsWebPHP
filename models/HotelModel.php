<?php
require './db/Database.php';
require 'objects/Hotel.php';
class HotelModel {

    private $db;
    private $pdo;

    function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }
    
    function getHotels(){
        $sql = "SELECT * FROM hoteles";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,'Hotel');
        $allHotels = $stmt->fetchAll();
        return $allHotels;
    }
    
     function getHabitaciones() {
        $sql = "SELECT * FROM habitaciones;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Habitacion');
        $allRooms = $stmt->fetchAll();
        return $allRooms;
    }

}

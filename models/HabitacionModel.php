<?php

require_once "./db/Db.php";
require_once "objects/Habitacion.php";

class HabitacionModel {

    private $db;
    private $pdo;

    function __construct() {
        $this->db = new Db();
        $this->pdo = $this->db->getConnection();
    }

    function getHabitaciones($hotel_id) {
        $sql = "SELECT * FROM habitaciones where id_hotel = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($hotel_id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Habitacion');
        $allRooms = $stmt->fetchAll();
        return $allRooms;
    }
}

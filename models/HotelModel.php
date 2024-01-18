<?php

require_once './db/Db.php';
require_once 'objects/Hotel.php';

class HotelModel {

    private $db;
    private $pdo;

    function __construct() {
        $this->db = new Db();
        $this->pdo = $this->db->getConnection();
    }

    function getHotels() {
        try {
            
//            $image = file_get_contents('./assets/images/habitacion_id_3.jpg');
//            echo $image;
//            exit;
//            $stmt = $this->pdo->prepare('UPDATE habitaciones SET foto = ? WHERE id = 3');
//            $stmt->bindParam(1, $image, PDO::PARAM_LOB);
//            $stmt->execute();
            
            $sql = "SELECT * FROM hoteles";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Hotel');
            $allHotels = $stmt->fetchAll();
            $this->db->disconnection();
            return $allHotels;
        } catch (Exception $exc) {
            echo $exc;
        }
    }

    function getHotel($hotel_id) {

        try {
            $sql = "SELECT * FROM hoteles WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array($hotel_id));
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Hotel');
            $hotel = $stmt->fetch();
            $this->db->disconnection();
            return $hotel;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}

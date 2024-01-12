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
    
    function getHotels(){
        $sql = "SELECT * FROM hoteles";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,'Hotel');
        $allHotels = $stmt->fetchAll();
        $this->db->disconnection();
        return $allHotels;
    }
    
    function getHotel($hotel_id){
        $sql = "SELECT * FROM hoteles WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($hotel_id));
        $stmt->setFetchMode(PDO::FETCH_CLASS,'Hotel');
        $hotel = $stmt->fetch();
        $this->db->disconnection();
        return $hotel;
    }
    
    

}

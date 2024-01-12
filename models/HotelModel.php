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
        $sql = "SELECT ho.id, nombre, direccion, ciudad, pais, num_habitaciones,"
                . " ho.descripcion, foto, id_hotel, num_habitacion, tipo, precio ,"
                . "ha.descripcion FROM hoteles ho JOIN habitaciones ha on (ho.id = ha.id_hotel);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_CLASS,'Hotel');
        $allHotels = $this->getHotelsAndRoomsAsObjects($stmt);
//        $allHotels = $stmt->fetchAll();
        foreach ($allHotels as $hotel) {
            echo $hotel[0].'<br>';
            foreach ($hotel[1] as $room) {
                echo "$room<br>";
            }
        }
        exit;
        return $allHotels;
    }

    function getHotelsAndRoomsAsObjects($stmt) {
        $rooms = array();
        $hotel = null;
        $hotels = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($hotel == null) {
                $hotel = new Hotel($row['id'], $row['nombre'], $row['direccion'], $row['ciudad'], $row['pais'], $row['num_habitaciones'], $row['descripcion'], $row['foto']);
            } else {
                if ($hotel->getId() != $row['id']) {
                    array_push($hotels, array($hotel, $rooms));
                    $rooms = array();
                    $hotel = new Hotel($row['id'], $row['nombre'], $row['direccion'], $row['ciudad'], $row['pais'], $row['num_habitaciones'], $row['descripcion'], $row['foto']);
                }
            }
            $room = new Habitacion($row['id_hotel'], $row['num_habitacion'], $row['tipo'], $row['precio'], $row['descripcion']);
            array_push($rooms, $room);
        }
        array_push($hotels, array($hotel, $rooms));
        return $hotels;
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

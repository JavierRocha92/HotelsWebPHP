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
        try {
            $sql = "SELECT * FROM habitaciones where id_hotel = ?;";
            if (!is_array($this->pdo)) {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(array($hotel_id));
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Habitacion');
                $allRooms = $stmt->fetchAll();
                $this->db->disconnection();
                return $allRooms;
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

    function getHabitacionesByBooking($allBookings) {

        try {
            $rooms = array();
            foreach ($allBookings as $booking) {
                $sql = "SELECT * FROM habitaciones WHERE ID = ?";
                if (!is_array($this->pdo)) {
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute(array($booking->getId_habitacion()));
                    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Habitacion');
                    array_push($rooms, $stmt->fetch());
                    $this->db->disconnection();
                    return $rooms;
                } else {
                    return $this->pdo;
                }
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

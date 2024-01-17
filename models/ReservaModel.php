<?php

require_once './db/Db.php';
require_once 'objects/Reserva.php';

class ReservaModel {

    private $db;
    private $pdo;

    function __construct() {
        $this->db = new Db();
        $this->pdo = $this->db->getConnection();
    }

    function getReservas($user_id) {
        $sql = 'SELECT * FROM reservas where id_usuario = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($user_id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reserva');
        $allBookings = $stmt->fetchAll();
        return $allBookings;
    }

    function insertReserva($data) {
        $user = $data[0];
        $room_id = $data[1];
        $hotel_id = $data[2];
        $initDate = date('Y-m-d');
        $finalDate = date('Y-m-d');
        try {
            $sql = 'INSERT INTO Reservas (id_usuario, id_hotel, id_habitacion,fecha_entrada, fecha_salida) VALUES (?, ?, ?, ? ,?)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array($user->getId(), $hotel_id, $room_id, $initDate, $finalDate));
            $booking_id = $this->pdo->lastInsertId();
            return $booking_id;
        } catch (Exception $ex) {
            return false;
        }
    }

    function deleteBooking($booking_id) {
        try {
            $sql = "DELETE FROM reservas WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array($booking_id));
            return true;
        } catch (Exception $exc) {
            echo 'La aplicación se encuntra en labores de mantenimiento, sentimos las molestias.';
        }
    }

    function updateBooking($values) {
        //format date to mysql
        $fecha_entrada = date("Y-m-d", strtotime($values['fecha_entrada']));
        $fecha_salida = date("Y-m-d", strtotime($values['fecha_salida']));
//        echo $fecha_entrada;
//        echo '<br>'; 
//        echo $fecha_salida;
//        exit;
        try {
            $sql = "UPDATE reservas SET id_habitacion = ?, fecha_entrada = ?,"
                    . "fecha_salida = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
//            echo $stmt;
            $stmt->execute(
                    array($values['room_id'],
                        $fecha_entrada,
                        $fecha_salida,
                        $values['booking_id'])
            );
            return true;
        } catch (Exception $exc) {
            echo 'La aplicación esta en labores de mantenimiento.';
        }
        
        //HAY QUE MIRAR POQUE NO ACTUALIZA BIEN DEL TODO POR EJEMPLO
        //E TIPO DE HABITACION
        
    }
}

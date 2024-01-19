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

    function insertReserva($postValues) {
        global $user;
        $initDate = date("Y-m-d", strtotime($postValues['fecha_entrada']));
        $finalDate = date("Y-m-d", strtotime($postValues['fecha_salida']));
        try {
            $sql = 'INSERT INTO Reservas (id_usuario, id_hotel, id_habitacion,fecha_entrada, fecha_salida) VALUES (?, ?, ?, ? ,?)';
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute(array($user->getId(),
                $postValues['hotel_id'],
                $postValues['room_id'],
                $initDate,
                $finalDate));

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
//        print_r($values);
//        exit;
        //format date to mysql
        $fecha_entrada = date("Y-m-d", strtotime($values['fecha_entrada']));
        $fecha_salida = date("Y-m-d", strtotime($values['fecha_salida']));
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
    }
}

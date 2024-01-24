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
        try {
            $sql = 'SELECT * FROM reservas WHERE id_usuario = ?';
            if (!is_array($this->pdo)) {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(array($user_id));
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reserva');
                $allBookings = $stmt->fetchAll();
                $this->db->disconnection();
                return $allBookings;
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

    function insertReserva($postValues) {
        global $user;
        $initDate = date("Y-m-d", strtotime($postValues['fecha_entrada']));
        $finalDate = date("Y-m-d", strtotime($postValues['fecha_salida']));

        try {
            $sql = 'INSERT INTO Reservas (id, id_usuario, id_hotel, id_habitacion,fecha_entrada, fecha_salida) VALUES (?, ?, ?, ?, ? ,?)';

            if (!is_array($this->pdo)) {

                $stmt = $this->pdo->prepare($sql);

                $stmt->execute(
                        array(
                            1,
                            $user->getId(),
                            $postValues['hotel_id'],
                            $postValues['room_id'],
                            $initDate,
                            $finalDate));

                $booking_id = $this->pdo->lastInsertId();
                return $booking_id;
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

    function deleteBooking($booking_id) {
        try {
            $sql = "DELETE FROM reservas WHERE id = ?";

            if (!is_array($this->pdo)) {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(array($booking_id));
                return $booking_id;
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

    function updateBooking($values) {
        //format date to mysql
        $fecha_entrada = date("Y-m-d", strtotime($values['fecha_entrada']));
        $fecha_salida = date("Y-m-d", strtotime($values['fecha_salida']));

        try {
            $sql = "UPDATE reservas SET id_habitacion = ?, fecha_entrada = ?,"
                    . "fecha_salida = ? WHERE id = ?";
            if (!is_array($this->pdo)) {

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(
                        array($values['room_id'],
                            $fecha_entrada,
                            $fecha_salida,
                            $values['booking_id']
                        )
                );
                return $values['room_id'];
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
}


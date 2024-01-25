<?php

require_once './db/Db.php';
require_once 'objects/Reserva.php';

/**
 * Class to represent reverva model object to fetch info from database
 */
class ReservaModel {

    /**
     * 
     * @var Database object database to manage interaction to database
     */
    private $db;

    /**
     * 
     * @var PDO PDO object to storage dtabase connection obsject
     */
    private $pdo;

    /**
     * Funtion to construct object
     */
    function __construct() {
        $this->db = new Db();
        $this->pdo = $this->db->getConnection();
    }

    /**
     * 
     * @param number $user_id
     * @return Array[Usuario] or Array with error information
     */
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

    /**
     * Function to insert a new Reserva into database
     * 
     * @global Usuario $user
     * @param $_POST $postValues
     * @return Array[Usuario] or Array with error information
     */
    function insertReserva($postValues) {
        global $user;
        $initDate = date("Y-m-d", strtotime($postValues['fecha_entrada']));
        $finalDate = date("Y-m-d", strtotime($postValues['fecha_salida']));
        $sql = 'INSERT INTO Reservas (id_usuario, id_hotel, id_habitacion, fecha_entrada, fecha_salida) VALUES (?, ?, ?, ? ,?)';

        try {

            if (!is_array($this->pdo)) {

                $stmt = $this->pdo->prepare($sql);

                $stmt->execute(
                        array(
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



    /**
     * Function to delete a specific Reserva from databse take bookin_id given as keyword
     * 
     * @param number $booking_id
     * @return Array[Usuario] or Array with error information
     */
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

    /**
     * Function to modifiy data for a specific reserva object take %Values as keyword
     * 
     * @param Array $values
     * @return Array[Usuario] or Array with error information
     */
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

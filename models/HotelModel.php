<?php

require_once './db/Db.php';
require_once 'objects/Hotel.php';

/**
 * Class to represent hotel model object to fetch data from database
 */
class HotelModel {

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
     * Function to fetch all hotels from database
     * 
     * @return Array[Usuario] or Array with error information
     */
    function getHotels() {

        try {
            $sql = "SELECT * FROM hoteles";
            if (!is_array($this->pdo)) {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Hotel');
                $allHotels = $stmt->fetchAll();
                $this->db->disconnection();
                return $allHotels;
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
     * Function to fetch information about a specific hotel from databse take hotel_id as keyword
     * 
     * @param number $hotel_id
     * @return Array[Usuario] or Array with error information
     */
    function getHotel($hotel_id) {

        try {
            if (!is_array($this->pdo)) {
                $sql = "SELECT * FROM hoteles WHERE id = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(array($hotel_id));
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Hotel');
                $hotel = $stmt->fetch();
                $this->db->disconnection();
                return $hotel;
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

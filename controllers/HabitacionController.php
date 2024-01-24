<?php

require_once "./views/HabitacionView.php";
require_once "./models/HabitacionModel.php";
require_once './logs/models/LogUserAction.php';

/**
 * Class to represent habitacion controller to take app control
 */
class HabitacionController {

    /**
     * Fucntion to cnotruct a new object
     */
    function __construct() {
        $this->habitacionView = new HabitacionView();
        $this->habitacionModel = new HabitacionModel();
        $username = isset($user) ? $user->getNombre() : null;
        $this->log = new LogUserAction($username);
    }

    /**
     * Funtion to take control about fetch and show Habitacion objects
     * 
     * @param string $hotel_id
     * @return Array[Habitacion]
     */
    function listHabitaciones($hotel_id) {
        $allRooms = $this->habitacionModel->getHabitaciones($hotel_id);
        if (!isset($allRooms['error'])) {
            $this->log->loadUserAction('SELECT', 'YES');
            return $allRooms;
        } else {
            $this->log->loadUserAction('SELECT', 'NO');
        }
    }

    /**
     * Fucntion to fetch and show all Habitacion objects for a espedific Reserva obsject
     * 
     * @param Array[Habitacion] $rooms
     * @return Array[Habitacion]
     */
    function getHabitacionesByBooking($bookings) {
        $rooms = $this->habitacionModel->getHabitacionesByBooking($bookings);
        if (!isset($bookings['error'])) {
            $this->log->loadUserAction('SELECT', 'YES');
            return $rooms;
        } else {
            $this->log->loadUserAction('SELECT', 'NO');
            $this->habitacionView->showError($rooms);
        }
    }

    /**
     * Function to fecth and show all Habitacion object for a specific Hotel
     */
    function listHabitacionesByHotel() {
        $hotel_id = isset($_POST['hotel_id']) ? htmlspecialchars(($_POST['hotel_id'])) : null;
        $hotel_name = isset($_POST['hotel_name']) ? htmlspecialchars(($_POST['hotel_name'])) : null;
        $rooms = $this->habitacionModel->getHabitaciones($hotel_id);
        if (!isset($rooms['error'])) {
            $this->log->loadUserAction('SELECT', 'YES');
            $this->habitacionView->showHabitaciones($hotel_name, $hotel_id, $rooms);
        } else {
            $this->log->loadUserAction('SELECT', 'NO');
            $this->habitacionView->showError($rooms);
        }
    }
}

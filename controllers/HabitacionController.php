<?php

require_once "./views/HabitacionView.php";
require_once "./models/HabitacionModel.php";
require_once './logs/models/LogUserAction.php';

class HabitacionController {

    function __construct() {
        $this->habitacionView = new HabitacionView();
        $this->habitacionModel = new HabitacionModel();
        $username = isset($user) ? $user->getNombre() : null;
        $this->log = new LogUserAction($username);
    }

    function listHabitaciones($hotel_id) {
        $allRooms = $this->habitacionModel->getHabitaciones($hotel_id);
        if ($allRooms) {
            $this->log->loadUserAction('SELECT', 'YES');
            return $allRooms;
        } else {
            $this->log->loadUserAction('SELECT', 'NO');
        }
    }

    function getHabitacionesByBooking($bookings) {
        $bookings = $this->habitacionModel->getHabitacionesByBooking($bookings);
        if ($bookings) {
            $this->log->loadUserAction('SELECT', 'YES');
            return $bookings;
        } else {
            $this->log->loadUserAction('SELECT', 'YES');
        }
    }

    function listHabitacionesByHotel() {
        $hotel_id = isset($_POST['hotel_id']) ? htmlspecialchars(($_POST['hotel_id'])) : null;
        $hotel_name = isset($_POST['hotel_name']) ? htmlspecialchars(($_POST['hotel_name'])) : null;
        $rooms = $this->habitacionModel->getHabitaciones($hotel_id);
        if ($rooms) {
            $this->log->loadUserAction('SELECT', 'YES');
            $this->habitacionView->showHabitaciones($hotel_name, $hotel_id, $rooms);
        } else {
            $this->log->loadUserAction('SELECT', 'YES');
        }
        
    }
}

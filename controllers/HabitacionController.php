<?php

require_once "./views/HabitacionView.php";
require_once "./models/HabitacionModel.php";

class HabitacionController {

    function __construct() {
        $this->habitacionView = new HabitacionView();
        $this->habitacionModel = new HabitacionModel();
    }

    function listHabitaciones($hotel_id) {
        $allRooms = $this->habitacionModel->getHabitaciones($hotel_id);
        return $allRooms;
    }

    function getHabitacionesByBooking($bookings) {
        return $this->habitacionModel->getHabitacionesByBooking($bookings);
    }

    function listHabitacionesByHotel() {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        $hotel_id = isset($_POST['hotel_id']) ? htmlspecialchars(($_POST['hotel_id'])) : null;
        $hotel_name = isset($_POST['hotel_name']) ? htmlspecialchars(($_POST['hotel_name'])) : null;
        $rooms = $this->habitacionModel->getHabitaciones($hotel_id);
        $this->habitacionView->showHabitaciones($hotel_name, $hotel_id, $rooms);
    }
}

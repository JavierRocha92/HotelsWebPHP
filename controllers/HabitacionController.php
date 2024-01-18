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
    function getHabitacionesByBooking($bookings){
        return $this->habitacionModel->getHabitacionesByBooking($bookings);
    }
}

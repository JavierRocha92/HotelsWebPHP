<?php

require_once "./views/HabitacionView.php";
require_once "./models/HabitacionModel.php";

class HabitacionController {

    function __construct() {
        $this->habitacionView = new HabitacionView();
        $this->habitacionModel = new HabitacionModel();
    }

    function listHabitaciones($hotel_id) {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';

        $allRooms = $this->habitacionModel->getHabitaciones($hotel_id);
        return $allRooms;
    }
}

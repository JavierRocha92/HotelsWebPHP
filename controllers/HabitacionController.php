<?php
require "./views/HabitacionView.php";
require "./models/HabitacionModel.php";

class HabitacionController{
    function __construct(){
        $this->habitacionView = new HabitacionView();
        $this->habitacionModel = new HabitacionModel();
    }
    function listHabitaciones(){
        $allRooms = $this->habitacionModel->getHabitaciones();
        $this->habitacionView->showHabitaciones($allRooms);
    }
}


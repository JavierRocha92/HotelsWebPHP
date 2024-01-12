<?php
require "./views/HabitacionView.php";
require "./models/HabitacionModel.php";

class HabitacionController{
    function __construct(){
        $this->habitacionView = new HabitacionView();
        $this->habitacionModel = new HabitacionModel();
    }
    function listHabitaciones(){
        if($_POST['hotel_id']){
            $hotel_id = htmlspecialchars($_POST['hotel_id']);
        }
        $allRooms = $this->habitacionModel->getHabitaciones($hotel_id);
        $this->habitacionView->showHabitaciones($allRooms);
    }
}


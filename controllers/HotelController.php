<?php
use '../view/HabitacionView.php';
use '../view/HabitacionModel.php';

class HotelController{
    
    
    function __construct() {
        $this->hotelView = new HotelView();
        $this->hotelModel = new HotelModel();
    }
    
    
}


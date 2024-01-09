<?php
require './views/HotelView.php';
require './models/HotelModel.php';

class HotelController{
    function __construct() {
        $this->hotelView = new HotelView();
        $this->hotelModel = new HotelModel();
    }
    
    function listHotels(){
        $allHotels = $this->hotelModel->getHotels();
        $this->hotelView->showHotels($allHotels);
    }
    
    
}


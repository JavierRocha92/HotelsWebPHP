<?php

require_once './views/HotelView.php';
require_once './models/HotelModel.php';
require_once 'HabitacionController.php';


class HotelController {

    function __construct() {
        $this->hotelView = new HotelView();
        $this->hotelModel = new HotelModel();
    }

    function listHotels() {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';

        $allHotels = $this->hotelModel->getHotels();
        $this->hotelView->showHotels($allHotels);
    }
    
    function displayExtendedHotelInfo(){
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        if(isset($_POST['hotel_id'])){
            $hotel_id = htmlspecialchars($_POST['hotel_id']);
        }
        $hotel = $this->hotelModel->getHotel($hotel_id);
        $habitacionController = new HabitacionController(); 
        $rooms = $habitacionController->listHabitaciones($hotel_id);
        $this->hotelView->showEspecificHotel([$hotel,$rooms]);
    }
}

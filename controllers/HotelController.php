<?php

require './views/HotelView.php';
require './models/HotelModel.php';

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
}

<?php

require_once './views/HotelView.php';
require_once './models/HotelModel.php';
require_once 'HabitacionController.php';
require_once './logs/models/LogUserAction.php';

class HotelController {

    function __construct() {
        global $user;
        $this->hotelView = new HotelView();
        $this->hotelModel = new HotelModel();
        $username = isset($user) ? $user->getNombre() : null;
        $this->log = new LogUserAction($username);
    }

    function listHotels() {
        $allHotels = $this->hotelModel->getHotels();
        if ($allHotels) {
            $this->hotelView->showHotels($allHotels);
            $this->log->loadUserAction('SELECT', 'YES');
        } else {
            $this->log->loadUserAction('SELECT', 'NO');
        }
    }
}

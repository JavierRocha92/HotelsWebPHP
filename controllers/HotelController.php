<?php

require_once './views/HotelView.php';
require_once './models/HotelModel.php';
require_once 'HabitacionController.php';
require_once './logs/models/LogUserAction.php';

/**
 * Class to represent hotel controller to take app control
 */
class HotelController {

    /**
     * Function to construct a new object
     * 
     * @global Usuario $user
     */
    function __construct() {
        global $user;
        $this->hotelView = new HotelView();
        $this->hotelModel = new HotelModel();
        $username = isset($user) ? $user->getNombre() : null;
        $this->log = new LogUserAction($username);
    }

    /**
     * Function to take control about fetch and show hotel objects
     */
    function listHotels() {
        $allHotels = $this->hotelModel->getHotels();
        if (!isset($allHotels['error'])) {
            $this->hotelView->showHotels($allHotels);
            $this->log->loadUserAction('SELECT', 'YES');
        } else {
            $this->log->loadUserAction('SELECT', 'NO');
            $this->hotelView->showError($allHotels);
        }
    }
}

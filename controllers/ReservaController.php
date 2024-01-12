<?php

require './views/ReservaView.php';
require './models/ReservaModel.php';

class ReservaController {

    function __construct() {
        $this->reservaView = new ReservaView();
        $this->reservaModel = new ReservaModel();
    }

    function listReservas() {
        $allBookings = $this->reservaModel->getReservas();
        $this->reservaView->showReservas($allBookings);
    }

    function makeBooking() {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        $room_id = isset($_POST['room_id']) ? htmlspecialchars($_POST['room_id']) : null;
        $hotel_id = isset($_POST['hotel_id']) ? htmlspecialchars($_POST['hotel_id']) : null;

        if (isset($room_id) && isset($user)) {
            $result = $this->reservaModel->insertReserva(array($user, $room_id,$hotel_id));
            $this->reservaView->showMessage($result);
        }
    }
}

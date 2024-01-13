<?php

require './views/ReservaView.php';
require './models/ReservaModel.php';

class ReservaController {

    function __construct() {
        $this->reservaView = new ReservaView();
        $this->reservaModel = new ReservaModel();
    }

    function listReservas() {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        $allBookings = $this->reservaModel->getReservas($user->getId());
        $this->reservaView->showReservas($allBookings,$user);
    }

    function confirmForm() {
        $this->reservaView->showConfirmationForm();
    }

    function makeBooking($room_id, $hotel_id, $user) {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
//        $room_id = isset($_POST['room_id']) ? htmlspecialchars($_POST['room_id']) : null;
//        $hotel_id = isset($_POST['hotel_id']) ? htmlspecialchars($_POST['hotel_id']) : null;

        if (isset($room_id) && isset($user)) {
            $result = $this->reservaModel->insertReserva(array($user, $room_id, $hotel_id));
            $this->reservaView->showMessage($result);
        }
    }

    function handleUserResponse() {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        $room_id = isset($_POST['room_id']) ? htmlspecialchars($_POST['room_id']) : null;
        $hotel_id = isset($_POST['hotel_id']) ? htmlspecialchars($_POST['hotel_id']) : null;
        $response = isset($_POST['option']) ? htmlspecialchars($_POST['option']) : null;

        if (isset($room_id) && isset($user) && isset($response)) {
            if ($response) {
                if ($response == 'yes') {
                    $this->makeBooking($room_id, $hotel_id, $user);
                } else {
                    header('Location:' . $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels');
                }
            }
        }
    }
}

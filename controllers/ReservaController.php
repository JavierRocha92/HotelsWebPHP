<?php

require_once './views/ReservaView.php';
require_once './models/ReservaModel.php';
require_once 'habitacionController.php';

class ReservaController {

    function __construct() {
        $this->reservaView = new ReservaView();
        $this->reservaModel = new ReservaModel();
    }

    function listReservas() {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        $allBookings = $this->reservaModel->getReservas($user->getId());
        $this->reservaView->showReservas($allBookings, $user);
    }

    function confirmForm() {
        $this->reservaView->showConfirmationForm();
    }

    function reservaConfirmForm() {
        $booking = isset($_POST['booking']) ? unserialize(base64_decode($_POST['booking'])) : null;
        $this->reservaView->showReservaConfirmationForm($booking);
    }

    function modifyForm() {
        $booking = isset($_POST['booking']) ? unserialize(base64_decode($_POST['booking'])) : null;
        $habitacionController = new HabitacionController();
        $rooms = $habitacionController->listHabitaciones($booking->getId_hotel());
        $this->reservaView->showReservaUpdatingForm($booking, $rooms);
    }

    function makeBooking($room_id, $hotel_id, $user) {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';

        if (isset($room_id) && isset($user)) {
            $result = $this->reservaModel->insertReserva(array($user, $room_id, $hotel_id));
            $this->reservaView->showMessage('insert', $result);
        }
    }

    function deleteBooking($booking_id) {
        if (isset($booking_id)) {
            $result = $this->reservaModel->deleteBooking($booking_id);
            if ($result)
                $this->reservaView->showMessage('delete', $result);
        }
    }

    function updateBooking($values) {
        if (isset($values)) {
            $result = $this->reservaModel->updateBooking($values);
            if ($result) {
                $this->reservaView->showMessage('update', $result);
            }
        }
    }

    function handleReserva() {
        if (isset($_POST['option'])) {
            $option = htmlspecialchars($_POST['option']);
            if ($option == 'delete') {
                $this->reservaModel->deleteReserva($reserva_id);
            }
            if ($option == 'update') {
                //Logica para la modificacion de una reserva
            }
        }
    }

    function handleUserResponse() {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        $room_id = isset($_POST['room_id']) ? htmlspecialchars($_POST['room_id']) : null;
        $postValues = isset($_POST) ? filter_input_array(INPUT_POST, $_POST) : null;
        //Conditional to check if $user and $response variables has value
        if (isset($user) && isset($postValues['response'])) {
            //Conditional to check if user response is afirmative
            if ($postValues['response'] == 'yes') {//Conditinal to check if $Booking_id exist to delete a booking
                switch ($postValues['option']) {
                    case 'delete':
                        $this->deleteBooking($postValues['booking_id']);
                        break;
                    case 'insert':
                        $this->makeBooking($postValues['room_id'], $postValues['hotel_id'], $user);
                        break;
                    case 'update':
                        $this->updateBooking($postValues);
                        break;
                }

                //Conditional to redirecting to index if response is negative
            } else {
                header('Location:' . $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels');
            }
        }
    }
}

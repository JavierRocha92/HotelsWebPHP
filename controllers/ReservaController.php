<?php

require_once './views/ReservaView.php';
require_once './models/ReservaModel.php';
require_once 'habitacionController.php';

class ReservaController {

    function __construct() {
        $this->reservaView = new ReservaView();
        $this->reservaModel = new ReservaModel();
    }

    function listReservas($user = false, $alert = false) {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        $allBookings = $this->reservaModel->getReservas($user->getId());
        $habitacionController = new HabitacionController();
        $rooms = $habitacionController->getHabitacionesByBooking($allBookings);
        $this->reservaView->showReservas($allBookings, $rooms, $user, $alert);
    }

    function confirmForm() {
        $postValues = filter_input_array(INPUT_POST, $_POST);
        switch ($postValues['option']) {
            case 'delete':
                $this->reservaView->showConfirmationDeleteForm($postValues);
                break;
            case 'update':
                $this->reservaView->showConfirmationUpdateForm($postValues);
                break;
            case 'insert':
                $this->reservaView->showConfirmationInsertForm($postValues);
                break;
        }
    }

    function insertForm() {
        $postValues = filter_input_array(INPUT_POST, $_POST);
        $this->reservaView->showInsertForm($postValues);
    }

    function modifyForm() {

        $booking = isset($_POST['booking']) ? unserialize(base64_decode($_POST['booking'])) : null;
        print_r($booking);
        exit;
        $habitacionController = new HabitacionController();
        $rooms = $habitacionController->listHabitaciones($booking->getId_hotel());
        //hay que meter un objeto para hacer sonsulta sobre hoteles
        $this->reservaView->showUpdatingForm($booking, $rooms);
    }

    function insertBooking($user, $postValues) {
        $values = unserialize(base64_decode($postValues['values']));

        if (isset($values) && isset($user)) {
            $result = $this->reservaModel->insertReserva($user, $values);
            if ($result) {
                $this->listReservas($user, array(
                    'option' => 'insert',
                    'result' => $result,)
                );
            }
        }
    }

    function deleteBooking($user, $booking_id) {
        if (isset($booking_id)) {
            $result = $this->reservaModel->deleteBooking($booking_id);
            if ($result) {
                $this->listReservas($user, array(
                    'option' => 'delete',
                    'result' => $result));
            }
        }
    }

    function updateBooking($user, $postValues) {
        $values = unserialize(base64_decode($postValues['values']));
        if (isset($values)) {
            $result = $this->reservaModel->updateBooking($values);
            if ($result) {
                $this->listReservas($user, array(
                    'option' => 'update',
                    'result' => $result));
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
                        $this->deleteBooking($user, $postValues['booking_id']);
                        break;
                    case 'insert':
                        $this->insertBooking($user, $postValues);
                        break;
                    case 'update':
                        $this->updateBooking($user, $postValues);
                        break;
                }

                //Conditional to redirecting to index if response is negative
            } else {
                header('Location:' . $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels');
            }
        }
    }
}

<?php

require_once './views/ReservaView.php';
require_once './models/ReservaModel.php';
require_once 'habitacionController.php';
require_once './logs/models/LogUserAction.php';

/**
 * Class to represent a reserva controller oboject to take app control
 */
class ReservaController {

    /**
     * Fucntion to construct a new object
     */
    function __construct() {
        $this->reservaView = new ReservaView();
        $this->reservaModel = new ReservaModel();
        $username = isset($user) ? $user->getNombre() : null;
        $this->log = new LogUserAction($username);
    }

    /**
     * Function to take control about fetch and show all user from database
     * 
     * @global Usuario $user
     * @param Array $alert
     */
    function listReservas($alert = false) {
        global $user;
        $allBookings = $this->reservaModel->getReservas($user->getId());
        $habitacionController = new HabitacionController();
        $rooms = $habitacionController->getHabitacionesByBooking($allBookings);
        if (!isset($rooms['error'])) {
            if ($rooms != null) {
                $this->log->loadUserAction('SELECT', 'YES');
                $this->reservaView->showReservas($allBookings, $rooms, $alert);
            }
        } else {
            $this->log->loadUserAction('SELECT', 'NO');
            $this->reservaView->showError($rooms);
        }
    }

    /**
     * Funnction to take control about handle confimation action from user
     */
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

    /**
     * Function to take control to show insertion form
     */
    function insertForm() {
        $postValues = filter_input_array(INPUT_POST, $_POST);
        $this->reservaView->showInsertForm($postValues);
    }

    /**
     * Function to take control to show updating form
     */
    function modifyForm() {
        $booking = isset($_POST['booking']) ? unserialize(base64_decode($_POST['booking'])) : null;
        $habitacionController = new HabitacionController();
        $rooms = $habitacionController->listHabitaciones($booking->getId_hotel());
        if (!isset($rooms['eroror'])) {
            $this->log->loadUserAction('SELECT', 'YES');
            $this->reservaView->showUpdatingForm($booking, $rooms);
        } else {
            $this->log->loadUserAction('SELECT', 'NO');
            $this->reservaView->showError($rooms);
        }
    }

    /**
     * Function to take control to insert a new reserva into database
     */
    function insertBooking($postValues) {
        global $user;
        $values = unserialize(base64_decode($postValues['values']));
        if (isset($values) && isset($user)) {

            $result = $this->reservaModel->insertReserva($values);

            if (!isset($result['error'])) {
                $this->log->loadUserAction('INSERT', 'YES');
                $this->listReservas(array(
                    'option' => 'insert',
                    'result' => $result,)
                );
            } else {
                $this->log->loadUserAction('INSERT', 'NO');
                $this->reservaView->showError($result);
            }
        }
    }

    /**
     * Function to take control to delete a new reserva into database
     */
    function deleteBooking($booking_id) {
        if (isset($booking_id)) {
            $result = $this->reservaModel->deleteBooking($booking_id);
            if (!isset($result['error'])) {
                $this->log->loadUserAction('DELETE', 'YES');
                $this->listReservas(array(
                    'option' => 'delete',
                    'result' => $result,)
                );
            } else {
                $this->log->loadUserAction('DELETE', 'NO');
                $this->reservaView->showError($result);
            }
        }
    }

    /**
     * Function to take control to update a new reserva into database
     */
    function updateBooking($postValues) {
        $values = unserialize(base64_decode($postValues['values']));
        if (isset($values)) {
            $result = $this->reservaModel->updateBooking($values);
            if (!isset($result['error'])) {
                $this->log->loadUserAction('UPDATE', 'YES');
                $this->listReservas(array(
                    'option' => 'update',
                    'result' => $result,)
                );
            } else {
                $this->log->loadUserAction('UPDATE', 'NO');
                $this->reservaView->showError($result);
            }
        }
    }

    /**
     * Function to handle user response about confirma action
     * 
     * @global Usuario $user
     */
    function handleUserResponse() {
        global $user;
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
                        $this->insertBooking($postValues);
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

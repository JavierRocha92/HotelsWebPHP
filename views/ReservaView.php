<?php

/**
 * Claas to represent a reserva view object to chow information
 */
class ReservaView {

    /**
     * Fucntion to show all reservas into a html element and call other function to show if an error has occured
     * 
     * @global Usuario $user
     * @param Array[Reserva] $allBookings
     * @param Array[Habitacion] $rooms
     * @param array $alert
     */
    function showReservas($allBookings, $rooms, $alert) {
        global $user;
        //Declare counter to get all rooms from $rooms array
        $count = 0;
        if ($alert) {
            $this->showMessage($alert);
        }
        ?>
        <h2 class="cards__title">Estas son tus reservas, <?= $user->getNombre() ?> </h2>
        <!--container reservas cards-->
        <div class="cards d-flex justify-content-around w-100">
            <?php
            foreach ($allBookings as $booking) {
                ?>
                <!--reservas card-->
                <div class="card border" style="width: 18rem;">
                    <img src="data:image/png;base64,<?= base64_encode($rooms[$count]->getFoto()) ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Habitacion: <?= $rooms[$count]->getTipo() ?></h5>
                        <p class="card-text"><?= $rooms[$count]->getDescripcion() ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Check in :<?= $booking->getFecha_Entrada() ?></li>
                        <li class="list-group-item">Check out :<?= $booking->getFecha_Salida() ?></li>

                    </ul>
                    <div class="container p-2 d-flex justify-content-around">
                        <form class="d-flex justify-content-between" action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=confirmForm' ?>" method="post">
                            <input type="hidden" name="booking" value="<?= base64_encode(serialize($booking)) ?>">
                            <button class="btn bg-primary text-light" name="option" value="delete">Delete</button>
                        </form>
                        <form class="d-flex justify-content-between" action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=modifyForm' ?>" method="post">
                            <input type="hidden" name="booking" value="<?= base64_encode(serialize($booking)) ?>">
                            <button class="btn bg-primary text-light" name="option" value="update">Modify</button>
                        </form>
                    </div> 

                    <!--close reservas card-->
                </div>

                <?php
                //Increment count variable
                $count++;
            }
            ?>

            <!--close reservas cards-->
        </div>
        <?php
    }

    /**
     * Function to show information about action user did
     * 
     * @param Array $alert
     */
    function showMessage($alert) {
        $option = $alert['option'];
        $result = $alert['result'];
        $message;
        if ($result) {
            switch ($option) {
                case 'delete':
                    $message = "Tu reserva, numero $result se ha eliminado con exito";
                    break;
                case 'update':
                    $message = "La reserva se ha modificado con exito";
                    break;
                case 'insert':
                    $message = "Tu reserva con Numero: $result , se ha realizado con exito";
                    break;
            }
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $message ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        } else {
            ?>
            }
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= 'Vaya, parece que algo salió mal, intentelo de nuevo' ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }
    }

    /**
     * Function to show inserting new reserva form
     * 
     * @param $_POST $postValues
     */
    function showInsertForm($postValues) {
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Hotel</th>
                    <th>Habitación</th>
                    <th>Check in</th>
                    <th>Check out</th>
                </tr>
            </thead>
            <tbody>
                <tr>
            <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=confirmForm' ?>" method="post">
                <td><input disabled type="text" value="<?= $postValues['hotel_name'] ?>"></td>
                <td><input disabled type="text" value="<?= $postValues['room_type'] ?>"></td>
                <td><input type="date" name="fecha_entrada"></td>
                <td><input type="date" name="fecha_salida"></td>
                <td><input type="hidden" name="hotel_id" value="<?= $postValues['hotel_id'] ?>"></td>
                <td><input type="hidden" name="room_id" value="<?= $postValues['room_id'] ?>"></td>
                <td><input type="hidden" name="hotel_name" value="<?= $postValues['hotel_name'] ?>"></td>
                <td><input type="hidden" name="room_type" value="<?= $postValues['room_type'] ?>"></td>
                <td><button class="btn bg-primary text-light" name="option" value="insert">To Book</button></td>
            </form>

            <td></td>
        </tr>
        </tbody>
        </table>

        <?php
    }

    /**
     * Funtion to show confiramtion forma about a delete user did
     * 
     * @param Array $values
     */
    function showConfirmationDeleteForm($values) {

        $booking = unserialize(base64_decode($values['booking']));
        ?>
        <h2>Haz click aquí para confirmar la eliminación de tu reserva</h2>
        <div class="data">
            <p>Reserva para habitacion con id: <?= $booking->getId() ?></p>
            <p>Con fecha de entrada en : <?= $booking->getFecha_entrada() ?> y con fecha de salida en : <?= $booking->getFecha_salida() ?></p>
        </div>
        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=handleUserResponse' ?>" method="post">
            <input type="hidden" name="booking_id" value="<?= $booking->getId() ?>">
            <button class="btn bg-primary text-light" name="response" value="yes"> Delete </button>
            <button class="btn bg-primary text-light" name="response" value="no"> Back </button>
            <input type="hidden" name="option" value="delete">
        </form>
        <?php
    }

    /**
     * Funtion to show confiramtion forma about a update user did
     * 
     * @param Array $values
     */
    function showConfirmationUpdateForm($values) {
        ?>
        <h2>Haz click aquí para confirmar la modificación de tu reserva</h2>
        <div class="data">
            <p>Reserva para habitacion con id: <?= $values['room_id'] ?></p>
            <p>Con fecha de entrada en : <?= $values['fecha_entrada'] ?> y con fecha de salida en : <?= $values['fecha_salida'] ?></p>
        </div>
        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=handleUserResponse' ?>" method="post">
            <input type="hidden" name="values" value="<?= base64_encode(serialize($values)) ?>">
            <button class="btn bg-primary text-light" name="response" value="yes"> Modify </button>
            <button class="btn bg-primary text-light" name="response" value="no"> Back </button>
            <input type="hidden" name="option" value="update">
        </form>
        <?php
    }

    /**
     * Funtion to show confiramtion forma about a insertion user did
     * 
     * @param Array $values
     */
    function showConfirmationInsertForm($values) {
        ?>
        <h2>Haz click aquí para confirmar la  reserva</h2>
        <div class="data">
            <p>Reserva para habitacion con id: <?= $values['room_id'] ?></p>
            <p>Con fecha de entrada en : <?= $values['fecha_entrada'] ?> y con fecha de salida en : <?= $values['fecha_salida'] ?></p>
        </div>
        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=handleUserResponse' ?>" method="post">
            <button class="btn bg-primary text-light" name="response" value="yes"> To Book </button>
            <button class="btn bg-primary text-light" name="response" value="no"> Back </button>
            <input type="hidden" name="option" value="insert">
            <input type="hidden" name="values" value="<?= base64_encode(serialize($values)) ?>">

        </form>
        <?php
    }

    /**
     * Function to show a form to updating a reserva for user
     * 
     * @param Reserva $booking
     * @param Array[Habitacion] $rooms
     */
    function showUpdatingForm($booking, $rooms) {
        ?>
        <h2>Indica los cambios que quieres realizar en tu reserva</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Habitaciones</th>
                <th>Check in</th>
                <th>Check out</th>
            </tr>
            <tr>
            <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=confirmForm' ?>" method="post">
                <td>
                    <input type="text" selected name="booking_id" value="<?= $booking->getId() ?>">
                </td>
                <td>
                    <select name="room_id">
        <?php
        foreach ($rooms as $room) {
            ?>
                            <option name="room_id" value="<?= $room->getId() ?>"><?= $room->getTipo() ?></option>
            <?php
        }
        ?>
                    </select>
                </td>
                <td>
                    <input type="date" name="fecha_entrada" value="<?= $booking->getFecha_entrada() ?>">
                </td>
                <td>
                    <input type="date" name="fecha_salida" value="<?= $booking->getFecha_salida() ?>">
                </td>
                <td>
                    <button class="btn bg-primary text-light" name="response" value="yes"> Modificar </button>
                </td>
                <td>
                    <button class="btn bg-primary text-light" name="response" value="no"> Back </button>
                </td>
                <input type="hidden" name="booking_id" value="<?= $booking->getId() ?>">
                <input type="hidden" name="option" value="update">


            </form>
        </tr>
        </table>

        <?php
    }

    /**
     * Fucntion to catch type of error given as prameter and return a properly message error
     * 
     * @param number $code error code
     * @return string error message to show to user
     */
    function getErrorMessage($code) {
        switch ($code) {

            case 1049 : //error databse attributes are wrong
                return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
            case 42000://sintaxis sql error
                return "Lo sentimos, ocurrió un error al procesar tu solicitud. Por favor, contacta al soporte técnico para obtener ayuda.";
            case 23000://violation key
                return "Error al recuperar la información de las reservas. Por favor, intenta nuevamente más tarde.";
            case 2002 ://error connection databse
                return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
        }
    }

    /**
     * Function to print a card out screen to shoe information abour any problem occured
     * 
     * @param array $data contains error = true and code error number
     */
    function showError($data) {
        ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Disculpe las molestias.</h5>
            </div>
            <div class="card-body">
                <p class="card-text"><?= getErrorMessage($data['code']) ?>.</p>
                <a href="<?= $_SERVER['PHP_SELF'] . '?controller=Usuario&action=logOut' ?>" class="btn btn-primary">Volver</a>
            </div>
        </div>
        <?php
    }
}

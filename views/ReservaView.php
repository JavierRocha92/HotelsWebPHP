<?php

class ReservaView {

    function showReservas($allBookings, $user) {
        ?>
        <h2>Estas son tus reservas, <?= $user->getNombre() ?> </h2>
        <!--container reservas cards-->
        <div class="cards d-flex justify-content-around w-100 border">
            <?php
            foreach ($allBookings as $booking) {
                ?>
                <!--reservas card-->
                <div class="card border" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Id de la reserva: <?= $booking->getId() ?></h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Check in :<?= $booking->getFecha_Entrada() ?></li>
                        <li class="list-group-item">Check out :<?= $booking->getFecha_Salida() ?></li>

                    </ul>
                    <div class="container p-2 d-flex justify-content-around">
                        <form class="d-flex justify-content-between" action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=reservaConfirmForm' ?>" method="post">
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
            }
            ?>

            <!--close reservas cards-->
        </div>
        <?php
    }

    function showMessage($option, $result) {
        if ($result) {
            switch ($option) {
                case 'delete':
                    echo "Tu reserva, se ha eliminado con exito";
                    break;
                case 'update':
                    echo "La reserva se ha modificado con exito";
                    break;
                case 'insert':
                    echo "Tu reserva con Numero: $result , se ha realizado con exito";
                    break;
            }
        } else {
            echo 'Parece que algo salio mal, intentelo de nuevo';
        }
        ?>
        <a href="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels' ?>">Go to Hotels</a>
        <?php
    }

    function showConfirmationForm() {
        ?>
        <h2>Haz click aquí para confimrar la reserva de la habitación</h2>

        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=handleUserResponse' ?>" method="post">
            <input type="hidden" name="room_id" value="<?= htmlspecialchars($_POST['room_id']) ?>">
            <input type="hidden" name="hotel_id" value="<?= htmlspecialchars($_POST['hotel_id']) ?>">
            <button name="response" value="yes"> Reservar </button>
            <button name="response" value="no"> Volver </button>
            <input type="hidden" name="option" value="insert">

        </form>
        <?php
    }

    function showReservaConfirmationForm($booking) {
        ?>
        <h2>Haz click aquí para confirmar la eliminación de tu reserva</h2>
        <div class="data">
            <p>Reserva para habitacion con id: <?= $booking->getId_habitacion() ?></p>
            <p>Con fecha de entrada en : <?= $booking->getFecha_entrada() ?> y con fecha de salida en : <?= $booking->getFecha_salida() ?></p>
        </div>
        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=handleUserResponse' ?>" method="post">
            <input type="hidden" name="booking_id" value="<?= $booking->getId() ?>">
            <button name="response" value="yes"> Eliminar </button>
            <button name="response" value="no"> Volver </button>
            <input type="hidden" name="option" value="delete">

        </form>
        <?php
    }

    function showReservaUpdatingForm($booking, $rooms) {
        ?>
        <h2>Indica los cambios que quieres realizar en tu reserva</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Check in</th>
                <th>Check out</th>
                <th>Habitaciones</th>
            </tr>
            <tr>
            <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=handleUserResponse' ?>" method="post">
                <td>
                    <input type="text" selected name="booking_id" value="<?= $booking->getId() ?>">
                </td>
                <td>
                    <select name="room_id">
                       <!--<option name="room_id" selected value="">Choose type</option>-->
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
                    <button name="response" value="yes"> Modificar </button>
                </td>
                <td>
                    <button name="response" value="no"> Volver </button>
                </td>
                <input type="hidden" name="booking_id" value="<?= $booking->getId() ?>">
                <input type="hidden" name="option" value="update">


            </form>
        </tr>
        </table>

        <?php
    }
}

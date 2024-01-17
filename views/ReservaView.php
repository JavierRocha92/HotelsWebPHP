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
                    echo "Tu reserva, numero $result se ha eliminado con exito";
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

    function showInsertForm($postValues) {
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Id Hotel</th>
                    <th>Id Habitación</th>
                    <th>Check in</th>
                    <th>Check out</th>
                </tr>
            </thead>
            <tbody>
                <tr>
            <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=confirmForm' ?>" method="post">
                <td><input type="text" name="hotel_id" value="<?= $postValues['hotel_id'] ?>"></td>
                <td><input type="text" name="room_id" value="<?= $postValues['room_id'] ?>"></td>
                <td><input type="date" name="fecha_entrada"></td>
                <td><input type="date" name="fecha_salida"></td>
                <td><button class="btn bg-primary text-light" name="option" value="insert">Reservar</button></td>
            </form>

            <td></td>
        </tr>
        </tbody>
        </table>

        <?php
    }

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
            <button class="btn bg-primary text-light" name="response" value="yes"> Eliminar </button>
            <button class="btn bg-primary text-light" name="response" value="no"> Volver </button>
            <input type="hidden" name="option" value="delete">
        </form>
        <?php
    }

    function showConfirmationUpdateForm($values) {
        ?>
        <h2>Haz click aquí para confirmar la modificación de tu reserva</h2>
        <div class="data">
            <p>Reserva para habitacion con id: <?= $values['room_id'] ?></p>
            <p>Con fecha de entrada en : <?= $values['fecha_entrada'] ?> y con fecha de salida en : <?= $values['fecha_salida'] ?></p>
        </div>
        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=handleUserResponse' ?>" method="post">
            <input type="hidden" name="values" value="<?= base64_encode(serialize($values)) ?>">
            <button name="response" value="yes"> Modificar </button>
            <button name="response" value="no"> Volver </button>
            <input type="hidden" name="option" value="update">
        </form>
        <?php
    }

    function showConfirmationInsertForm($values) {
        ?>
        <h2>Haz click aquí para confirmar la  reserva</h2>
        <div class="data">
            <p>Reserva para habitacion con id: <?= $values['room_id'] ?></p>
            <p>Con fecha de entrada en : <?= $values['fecha_entrada'] ?> y con fecha de salida en : <?= $values['fecha_salida'] ?></p>
        </div>
        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=handleUserResponse' ?>" method="post">
            <button class="btn bg-primary text-light" name="response" value="yes"> Reservar </button>
            <button class="btn bg-primary text-light" name="response" value="no"> Volver </button>
            <input type="hidden" name="option" value="insert">
            <input type="hidden" name="values" value="<?= base64_encode(serialize($values)) ?>">

        </form>
        <?php
    }

    function showUpdatingForm($booking, $rooms) {
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

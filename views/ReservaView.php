<?php

class ReservaView {

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
            <button class="btn bg-primary text-light" name="response" value="yes"> Modificar </button>
            <button class="btn bg-primary text-light" name="response" value="no"> Volver </button>
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
        //TENEMOS QUE HACER UNA CONSULTA PARA MOSTAR EL NOMBRE DE LA HABITACION Y DEL HOTEL DE LA RESERVA PARA MOSTARSELO A UL USUAIRO,
        //LO MISMO HAY QUE HACER EN LSO DEMAS METODOS PARA BORRAR UNA RESERVA O PARA INSERTARLA
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
                    <button class="btn bg-primary text-light" name="response" value="no"> Volver </button>
                </td>
                <input type="hidden" name="booking_id" value="<?= $booking->getId() ?>">
                <input type="hidden" name="option" value="update">


            </form>
        </tr>
        </table>

        <?php
    }
}

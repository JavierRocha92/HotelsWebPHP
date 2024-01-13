<?php

class ReservaView {

    function showReservas($allBookings, $user) {
        ?>
        <h2>Estas son tus reservas, <?= $user->getNombre() ?> </h2>
        <?php
        foreach ($allBookings as $booking) {
            ?>
                <p><?= $booking ?></p>
            <?php
        }
        ?>
        <a href="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels' ?>">Go to hotels</a>
        <?php
    }

    function showMessage($result) {
        if ($result) {
            echo "Tu reserva con Numero: $result , se ha realizado con sxito";
        } else {
            echo 'Parece que algo salio mal, intentelo de nuevo';
        }
        ?>
        <a href="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels' ?>"></a>
        <?php
    }

    function showConfirmationForm() {
        ?>
        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=handleUserResponse' ?>" method="post">
            <h2>Haz click aquí para confimrar la reserva de la habitación</h2>
            <input type="hidden" name="room_id" value="<?= htmlspecialchars($_POST['room_id']) ?>">
            <input type="hidden" name="hotel_id" value="<?= htmlspecialchars($_POST['hotel_id']) ?>">
            <button name="option" value="yes"> Reservar </button>
            <button name="option" value="no"> Volver </button>
        </form>
        <?php
    }
}

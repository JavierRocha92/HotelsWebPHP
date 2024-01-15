<?php

class ReservaView {

    function showReservas($allBookings, $user) {
        ?>
        <h2>Estas son tus reservas, <?= $user->getNombre() ?> </h2>
        <!--container reservas cards-->
        <div class="cards d-flex w-100 border">
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
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                    <!--close reservas card-->
                </div>

                <?php
            }
            ?>

            <!--close reservas cards-->
        </div>
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

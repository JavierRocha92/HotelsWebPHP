<?php

class HabitacionView {

    function showHabitaciones($data) {
        $hotel = $data[0];
        $allRooms = $data[1];
        ?>
        <!--hotel title-->
        <h2 class="title">Estas son las habitaciones del Hotel <?= $hotel->getNombre() ?></h2>
        <!--container habitaciones cards-->
        <div class="cards d-flex">
            <?php
            foreach ($allRooms as $room) {
                ?>

                <div class="card" style="width: 18rem;">
                    <img src="<?= $room->getFoto() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$room->getTipo() ?></h5>
                        <p class="card-text"><?= $room->getDescripcion() ?></p>
                        <!--form for any hotel-->
                        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=insertForm' ?>" method="post">
                            <label for="campo"></label>
                            <input type="hidden" name="room_id" value="<?= $room->getId() ?>">
                            <input type="hidden" name="hotel_id" value="<?= $hotel->getId() ?>">
                            <button class="btn bg-primary text-light" type="submit">Reservar</button>
                        </form>
                        <!--final form hotel-->
                    </div>
                    <!--close card haitacion-->
                </div>

                <?php
            }
            ?>
            <!--close cards habitaciones-->
        </div>
        <!--Closing card hotel-->
        </div>
        <?php
    }
}

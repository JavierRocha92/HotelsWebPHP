<?php

class HabitacionView {

    function showHabitaciones($data) {
        $hotel_id = $data[0]->getId();
        $allRooms = $data[1];
        foreach ($allRooms as $room) {
            ?>

            <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=makeBooking' ?>" method="post">
                <label for="campo"><?= $room->getId() . ' ' . $room->getTipo() ?></label>
                <input type="hidden" name="room_id" value="<?= $room->getId() ?>">
                <input type="hidden" name="hotel_id" value="<?= $hotel_id ?>">
                <button type="submit">Reservar</button>
            </form>
            <?php
        }
        ?>
        <!--Closing card hotel-->
        </div>
        <?php
    }
}

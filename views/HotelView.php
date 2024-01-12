<?php
require_once 'HabitacionView.php';

class HotelView {

    function showHotels($allHotels) {

        for ($index = 0; $index < count($allHotels); $index++) {
            ?>
            <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=displayExtendedHotelInfo' ?>" method="post">
                <label for="nombre"><?= $allHotels[$index]->getNombre() ?>:</label>
                <input type="hidden" name="hotel_id" value="<?= $allHotels[$index]->getId() ?>">
                <button type="submit">Enviar</button>
            </form>
            <?php
        }
    }

    function showEspecificHotel($data) {
        $habitacionView = new HabitacionView();
        $hotel = $data[0];
        $rooms = $data[1];
        ?>
        <!--open hotel card-->
        <div>
            <h2><?= $hotel->getNombre() ?></h2>

            <?php
            $habitacionView->showHabitaciones(array($hotel,$rooms));
            ?>
        </div>
        <?php
    }
}

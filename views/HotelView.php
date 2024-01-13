<?php
require_once 'HabitacionView.php';

class HotelView {

    function showHotels($allHotels) {
        ?>
        <!--link show reservas container-->
        <div>
            <a href="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=listReservas' ?>">Mostrar resrvas</a>
        </div>
        <?php
        foreach ($allHotels as $hotel) {
            ?>
            <!--form for any hotel-->
            <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=displayExtendedHotelInfo' ?>" method="post">
                <label for="nombre"><?= $hotel->getNombre() ?>:</label>
                <input type="hidden" name="hotel_id" value="<?= $hotel->getId() ?>">
                <button type="submit">Enviar</button>
            </form>
            <!--final form hotel-->
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
            $habitacionView->showHabitaciones(array($hotel, $rooms));
            ?>
        </div>
        <?php
    }
}

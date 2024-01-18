<?php
require_once 'HabitacionView.php';

class HotelView {

    function showHotels($allHotels) {
        ?>
        <h2 class="title">Elige el hotel que mas te guste</h2>
        <!--container cards hotels-->
        <div class="cards d-flex">
            <?php
            foreach ($allHotels as $hotel) {
                ?>
                <div class="card" style="width: 18rem;">
                    <img src="<?= $hotel->getFoto() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $hotel->getNombre() ?></h5>
                        <h6>Habitaciones: <?= $hotel->getNum_habitaciones() ?></h6>
                        <p class="card-text"><?= $hotel->getDescripcion() ?>.</p>
                        <!--form for any hotel-->
                        <form class="" action="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=displayExtendedHotelInfo' ?>" method="post">
                            <input type="hidden" name="hotel_id" value="<?= $hotel->getId() ?>">
                            <button class="btn bg-primary text-light" type="submit">Show Rooms</button>
                        </form>
                        <!--final form hotel-->
                    </div>
                </div>
                <?php
            }
            ?>
            <!--final cards container-->
        </div>
        <?php
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

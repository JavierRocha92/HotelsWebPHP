<?php
require_once 'HabitacionView.php';
require_once 'lib/files/functions.php';

class HotelView {

    function showHotels($allHotels) {
        ?>
        <h2 class="cards__title">Elige el hotel que mas te guste</h2>
        <!--container cards hotels-->
        <div class="cards d-flex">

            <?php
            foreach ($allHotels as $hotel) {
                ?>
                <div class="card" style="width: 18rem;">
                    <img src="data:image/png;base64, <?= base64_encode($hotel->getFoto()) ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $hotel->getNombre() ?></h5>
                        <h6>Habitaciones: <?= $hotel->getNum_habitaciones() ?></h6>
                        <p class="card-text"><?= $hotel->getDescripcion() ?>.</p>
                        <!--form for any hotel-->
                        <form class="" action="<?= $_SERVER['PHP_SELF'] . '?controller=Habitacion&action=listHabitacionesByHotel' ?>" method="post">
                            <input type="hidden" name="hotel_id" value="<?= $hotel->getId() ?>">
                            <input type="hidden" name="hotel_name" value="<?= $hotel->getNombre() ?>">
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

    function getErrorMessage($code) {
        
        switch ($code) {
            case 1049 :
                return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
        }
    }

    function showError($data) {
        ?>
        <p><?= getErrorMessage($data['code']) ?></p>
        <?php
    }
}

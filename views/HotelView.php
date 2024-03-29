<?php
require_once 'HabitacionView.php';
require_once 'lib/files/functions.php';

class HotelView {

    /**
     * Fucntion to shoe all hotels available into html element
     * 
     * @param Array[Hotel] $allHotels
     */
    function showHotels($allHotels) {
        ?>
        <h2 class="cards__title">Elige el hotel que mas te guste</h2>
        <!--container cards hotels-->
        <div class="cards d-flex">

            <?php
            foreach ($allHotels as $hotel) {
                ?>
                <div class="card" style="width: 18rem;">
                    <img src="data:image/png;base64,<?= base64_encode($hotel->getFoto()) ?>" class="card-img-top" alt="...">
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

    /**
     * Funciton to show a especific hotel
     * 
     * @param Array[] $data
     */
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

    /**
     * Function to print a card out screen to shoe information abour any problem occured
     * 
     * @param array $data contains error = true and code error number
     */
    function showError($data) {
        showDatabaseError($data);
    }
}

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
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <!--form for any hotel-->
                        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=displayExtendedHotelInfo' ?>" method="post">
                            <label for="nombre"><?= $hotel->getNombre() ?>:</label>
                            <input type="hidden" name="hotel_id" value="<?= $hotel->getId() ?>">
                            <button class="btn bg-primary" type="submit">Enviar</button>
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

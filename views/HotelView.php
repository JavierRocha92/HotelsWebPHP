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
     * Fucntion to catch type of error given as prameter and return a properly message error
     * 
     * @param number $code error code
     * @return string error message to show to user
     */
    function getErrorMessage($code) {
        switch ($code) {

            case 1049 : //error databse attributes are wrong
                return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
            case 42000://sintaxis sql error
                return "Lo sentimos, ocurrió un error al procesar tu solicitud. Por favor, contacta al soporte técnico para obtener ayuda.";
            case 23000://violation key
                return "Error al recuperar la información de las reservas. Por favor, intenta nuevamente más tarde.";
            case 2002 ://error connection databse
                return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
        }
    }

    /**
     * Function to print a card out screen to shoe information abour any problem occured
     * 
     * @param array $data contains error = true and code error number
     */
    function showError($data) {
        ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Disculpe las molestias.</h5>
            </div>
            <div class="card-body">
                <p class="card-text"><?= getErrorMessage($data['code']) ?>.</p>
                <a href="<?= $_SERVER['PHP_SELF'] . '?controller=Usuario&action=logOut' ?>" class="btn btn-primary">Volver</a>
            </div>
        </div>
        <?php
    }
}

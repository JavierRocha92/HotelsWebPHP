<?php

class HabitacionView {

    /**
     * Function to show all habitaciones
     * 
     * @param string $hotel_name
     * @param number $hotel_id
     * @param Array[Habitacion] $allRooms
     */
    function showHabitaciones($hotel_name, $hotel_id, $allRooms) {
        ?>
        <!--hotel title-->
        <h2 class="cards__title">Estas son las habitaciones del Hotel <?= $hotel_name ?></h2>
        <!--container habitaciones cards-->
        <div class="cards d-flex">

            <?php
            foreach ($allRooms as $room) {
                ?>

                <div class="card" style="width: 18rem;">
                    <img src="data:image/png;base64, <?= base64_encode($room->getFoto()) ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $room->getTipo() ?></h5>
                        <p class="card-text"><?= $room->getDescripcion() ?></p>
                        <!--form for any hotel-->
                        <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Reserva&action=insertForm' ?>" method="post">
                            <input type="hidden" name="room_id" value="<?= $room->getId() ?>">
                            <input type="hidden" name="room_type" value="<?= $room->getTipo() ?>">

                            <input type="hidden" name="hotel_id" value="<?= $hotel_id ?>">
                            <input type="hidden" name="hotel_name" value="<?= $hotel_name ?>">

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

<?php

class HotelView {

  
    
        function showHotels($allHotels) {
            
            for ($index = 0; $index < count($allHotels); $index++) {
                 ?>
            <form action="<?= $_SERVER['PHP_SELF'] . '?controller=Habitacion&action=listHabitaciones' ?>" method="post">
                <label for="nombre"><?= $allHotels[$index]->getNombre() ?>:</label>
                <input type="hidden" name="hotel_id" value="<?= $allHotels[$index]->getId() ?>">
                <button type="submit">Enviar</button>
            </form>
            <?php
            }
            
        
           
        
    }
}

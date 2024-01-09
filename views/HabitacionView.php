<?php
class HabitacionView{
     function showHabitaciones($allRooms){
         foreach ($allRooms as $room) {
             echo "$room<br>";
         }
     }
}


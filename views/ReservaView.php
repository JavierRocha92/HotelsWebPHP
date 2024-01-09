<?php
class ReservaView{
    function showReservas($allBookings){
        foreach ($allBookings as $booking) {
            echo "$booking<br>";
        }
    }
}


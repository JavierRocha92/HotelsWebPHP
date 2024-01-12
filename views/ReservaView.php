<?php
class ReservaView{
    function showReservas($allBookings){
        foreach ($allBookings as $booking) {
            echo "$booking<br>";
        }
    }
    
    function showMessage($result){
        if($result){
            echo "Tu reserva con Numero: $result , se ha realizado con sxito";
        }
        else{
            echo 'Parece que algo salio mal, intentelo de nuevo';
        }
    }
}


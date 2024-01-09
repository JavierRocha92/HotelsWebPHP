<?php
class HotelView{
    function showHotels($allHotels){
        foreach ($allHotels as $hotel) {
            echo "$hotel<br>";
        }
    }
}

